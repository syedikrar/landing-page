<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Country;
use App\Models\Form;
use App\Models\Landing;
use App\Models\LandingParam;
use App\Models\LandingScript;
use App\Models\LandingTemplateData;
use App\Models\LandingThankYouPageData;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $landings = request()->query('campaign')
        ? auth()->user()->landings()->where('campaign_id', request()->query('campaign'))->latest()->paginate(15)
        : auth()->user()->landings()->latest()->paginate(15);

        return Inertia::render('Landing/Index', [
            'landings' => $landings->through(fn($landing) => [
                'id' => $landing->id,
                'name' => ucfirst($landing->name) ?? '',
                'campaign' => $landing->campaign->name ?? '',
                'country' => $landing->country->name ?? '',
                'template_id' => $landing->template_id,
                'template' => $landing->template->name ?? '',
                'template_preview_url' => $landing->template->preview_url ?? '',
                'type' => $landing->type,
                'domain' => $landing->domain,
                'links' => $landing->links,
                'status' => $landing->status,
                'uuid' => $landing->uuid,
                'form_id' => $landing->form->id ?? null,
                'form_step' => $landing->form->submission_link != '#' ? true : false,
                'page_template_updated' => $landing->landingTemplateData ? true : false,
                'thankyou_page_updated' => $landing->thankYouPageData ? true : false,
                'rejection_reason' => $landing->rejection_reason,
            ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Landing/Create', [
            'campaigns' => Campaign::where(['user_id' => auth()->user()->id, 'status' => 'active'])->latest()->get(),
            'templates' => Template::latest()->get(),
            'countries' => Country::where('status', 'active')->latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'campaign_id' => ['required'],
            'country_id' => ['required'],
            'type' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $landing = Landing::create($request->all() + ['uuid' => Str::uuid()]);

        return redirect()->route('client.landing.select_template', $landing->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $uuid)
    {
        try {
            $queryParams = $request->query();
            $landing = Landing::whereUuid($uuid)->firstOrFail();
            // if ($landing->status == 'inactive') {
            //     return view('landings.inactive');
            // }
            $template = $landing->template;
            $landingTemplate = $landing->landingTemplateData;
            $templateName = str_replace('_', ' ', strtolower($template->name));
            return view('landingPages.' . $templateName . '.index', compact('landingTemplate', 'landing', 'queryParams'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $landing = auth()->user()->landings()->findOrFail($id);
        return Inertia::render('Landing/Edit', [
            'campaigns' => Campaign::where('user_id', auth()->user()->id)->latest()->get(),
            'templates' => Template::latest()->get(),
            'countries' => Country::latest()->get(),
            'landing' => $landing,
            'selectedTemplate' => $landing->template,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $landing = auth()->user()->landings()->findOrFail($id);
        $landing->update($request->all());
        return redirect()->route('client.landing.select_template', $landing->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $landing = auth()->user()->landings()->findOrFail($id);
        $landing->delete();
        return redirect()->route('client.landing.index');
    }

    /*
     * Select template for landing page.
     */

    public function selectTemplate($id)
    {
        $landing = Landing::findOrFail($id);
        return Inertia::render('Landing/Templates', [
            'templates' => Template::latest()->get(),
            'landing' => $landing,
        ]);
    }

    /*
     * Store selected template for landing page.
     */

    public function saveTemplate(Request $request)
    {
        $landing = Landing::findOrFail($request->landing_id);
        if ($landing->template_id != $request->template_id && $landing->landingTemplateData) {
            $landing->landingTemplateData->delete();
        }
        $landing->update(['template_id' => $request->template_id]);
        return redirect()->route('client.forms.show', $landing->form_id);
    }

    /*
     * Edit selected page template with visual page editor.
     */
    public function editTemplate($id)
    {
        $landing = auth()->user()->landings()->findOrFail($id);
        $template = $landing->template;
        $landingTemplate = $landing->landingTemplateData;
        $templateName = str_replace('_', ' ', strtolower($template->name));
        return view('editor.' . $templateName . '.index', compact('landing', 'landingTemplate'));
    }

    /*
     * Save landing page edited with visual editor in DB
     */
    public function saveTemplateData(Request $request)
    {
        $templeData = LandingTemplateData::updateOrCreate([
            'landing_id' => $request->landing_id,
        ], ['landing_id' => $request->landing_id,
            'html_data' => $request->{'gjs-html'},
            'css_data' => $request->{'gjs-css'},
            'styles_data' => $request->{'gjs-styles'},
            'assets_data' => $request->{'gjs-assets'},
        ]);
        return true;
    }

    /*
     * Update landing page status
     */
    public function updateStatus(Request $request, $id)
    {
        $landing = Landing::findOrFail($id);
        if ($landing->campaign->status != 'active') {
            return \redirect()->back()->withErrors("Can't change the status of landing until campaign is active");
        }
        if (!$landing->template_id || $landing->form->submission_link == '#' || !$landing->landingTemplateData) {
            return \redirect()->back()->with('error', "Please complete all the steps to publish the landing. ");
        }
        $landing->update(['status' => $request[0], 'previous_status' => $request[0]]);
        return redirect()->back();
    }

    /*
     * Inactive or Maintenance mode page
     */
    public function inactivePage()
    {
        return view('landings.inactive');
    }

    // view page for setting up domain
    public function getDomainPage($id)
    {
        $landing = Landing::findOrFail($id);
        return Inertia::render('Landing/Domain', [
            'landing' => $landing,
            'url' => $landing->uuid . '.' . env('DOMAIN_URL'),
        ]);
    }

    // save domain information
    public function saveDomainInformation(Request $request, $id)
    {
        $landing = Landing::findOrFail($id);
        $landing->update($request->all());
        return redirect()->route('client.landing.publish', $landing->id);
    }

    // view page for setting up pixel and GA
    public function getTrackingPage($id)
    {
        $landing = Landing::with('staticParams')->findOrFail($id);
        return Inertia::render('Landing/Tracking',[
            'landing' => $landing,
        ]);
    }

    // save domain information
    public function saveTrackingInformation(Request $request, $id)
    {
        $landing = Landing::findOrFail($id);
        if ($request->input('google_analytics')) {
            $script = LandingScript::updateOrCreate([
                'landing_id' => $id,
                'title' => 'google_analytics',

            ], [
                'value' => $request->input('google_analytics'),
            ]);
        }
        if ($request->input('pixel')) {

            $script = LandingScript::updateOrCreate([
                'landing_id' => $id,
                'title' => 'pixel',

            ], [
                'value' => $request->input('pixel'),
                'type' => $request->input('pixel_type'),
            ]);
        }
        $landing->params()->delete();
        $landing->staticParams()->delete();

        foreach ($request->params as $param) {
            LandingParam::Create([
                'landing_id' => $id,
                'key' => $param['key'],
                'value' => $param['value'], 
                'type' => $param['type'], 
            ]);
        }
        foreach($request->static_params as $static_param){
            LandingParam::Create([
                'landing_id' => $id,
                'key' => $static_param['key'],
                'value' => $static_param['value'], 
                'type' => $static_param['type'], 
            ]);
        }
        return redirect()->route('client.landing.domain', $landing->id);
    }

    public function sendRequest(Request $request, $id)
    {
        $landing = Landing::findOrFail($id);
        $landing->update(['status' => 'requested']);
        return redirect()->route('client.landing.index');
    }
    public function publish($id)
    {
        $landing = Landing::findOrFail($id);
        return Inertia::render('Landing/Publish', [
            'landing' => $landing,
            'url' => $landing->uuid . '.' . env('DOMAIN_URL'),
            'form' => $landing->form->submission_link != '#' ? true : false,
            'page_template_updated' => $landing->landingTemplateData ? true : false,
            'thankyou_page_updated' => $landing->thankYouPageData ? true : false,

        ]);
    }
    public function publishLanding(Request $request, $id)
    {
        $landing = Landing::findOrFail($id);

        $authUser = auth()->user();
        if (!auth()->user()->hasRole('admin')) {
            $packageLimit = subscriptionSetting($authUser);

            $limitExceed = \checkLimitExceed($authUser, 'landing', $packageLimit['allowed_landings']);
            $trialExpired = checkTrailExpiration($authUser);

            if ($trialExpired) {
                return \redirect()->back()->with('error', 'Your free trial has been expired. Please upgrade your subscription.');
            }
            if ($limitExceed) {
                return \redirect()->back()->with('error', 'Your account limit exceed. To active landing page upgrade your subscription.');
            }
        }

        if ($landing->campaign->status != 'active') {
            return \redirect()->back()->with('error', "Can't change the status of landing until campaign is active. ");
        }

        if (!$landing->template_id || $landing->form->submission_link == '#' || !$landing->landingTemplateData || !$landing->thankYouPageData) {
            return \redirect()->back()->with('error', "Please complete all the steps to publish the landing. ");
        }
        $landing->update(['status' => 'active', 'previous_status' => 'active']);
        return redirect()->back();
    }

    /*
     * Edit selected page template with visual page editor.
     */
    public function editThankYouPage($id)
    {
        $landing = auth()->user()->landings()->findOrFail($id);
        $pageData = $landing->thankYouPageData;
        return view('editor.thankyou.thankyou', compact('landing','pageData'));
    }
    /*
     * Save landing thank you page edited with visual editor in DB
     */
    public function saveThankYouPageData(Request $request)
    {
        $templeData = LandingThankYouPageData::updateOrCreate([
            'landing_id' => $request->landing_id,
        ], ['landing_id' => $request->landing_id,
            'html_data' => $request->{'gjs-html'},
            'css_data' => $request->{'gjs-css'},
            'styles_data' => $request->{'gjs-styles'},
            'assets_data' => $request->{'gjs-assets'},
        ]);
        return true;
    }

}
