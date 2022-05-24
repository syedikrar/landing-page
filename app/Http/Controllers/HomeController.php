<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Landing;
use App\Models\LandingView;
use App\Models\Campaign;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $campaigns = User::withCount([
            'campaigns',
            'campaigns as active_campaigns' => function ($query) {
                $query->where('status', 'active');
            },
            'campaigns as inactive_campaigns' => function ($query) {
                $query->where('status', 'inactive');
            }
        ])->find(auth()->user()->id);
        $activeLandings = Landing::whereHas('campaign', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->where('status', 'active')->count();
        
        $inActiveLandings = Landing::whereHas('campaign', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->where('status', 'inactive')->count();
        

        return Inertia::render('Dashboards/Dashboard1', [
            'activeCampaigns' => $campaigns->active_campaigns,
            'inActiveCampaigns' => $campaigns->inactive_campaigns,
            'activeLandings' => $activeLandings,
            'inActiveLandings' =>$inActiveLandings,
        ]);
    }

    public function showLandingPage(Request $request, $uuid)
    {
        
    
        try {
            $queryParams = $request->query();
            $landing = Landing::whereUuid($uuid)->firstOrFail();
            if ($landing->status != 'active' && !request()->token) {
                return view('landings.inactive');
            }

            if (request()->has('token')) {
                $token = request()->token;
                $sessionId = Crypt::decryptString($token);
                $session = DB::table('sessions')->find($sessionId);
                $user = $session
                    ? User::where('id', $session->user_id)->where('user_type', 'admin')->first()
                    : NULL;
                if (!$session || !$user) {
                    return view('landings.inactive');
                }
            }
            $template = $landing->template;
            $landingTemplate = $landing->landingTemplateData;
            $templateName = str_replace('_', ' ', strtolower($template->name));

            return view('landingPages.' . $templateName.'.index', compact('landingTemplate', 'landing', 'queryParams'));
        } catch (\Exception $e) {
            abort(404);
        }
    }
    public function landingPageVisited($uuid){

        $landing = Landing::whereUuid($uuid)->firstOrFail();
        $click = LandingView::create(['landing_id'=>$landing->id]);
        return $click->id;
    }

    public function landingForm(Request $request, $uuid){

        $queryParams = $request->queryParams;
        $landing = Landing::whereUuid($uuid)->firstOrFail();
        $form = Form::where('landing_id',$landing->id)->first();
        $template = $landing->template;
        $landingTemplate = $landing->landingTemplateData;
        $templateName = str_replace('_', ' ', strtolower($template->name));
        return view('landingPages.form.form', compact('form','queryParams'))->render();

    }

    public function contact(){
        return view('contact');
    }

    public function contactFormSubmit(Request $request){

        $entry = $request->all();
        \Mail::to(getSiteEmail())->send(new \App\Mail\ContactMail($entry));
        return redirect()->back();
    }
}
