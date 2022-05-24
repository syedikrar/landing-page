<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{

    public function __construct() {

        $this->middleware('checkCampaignsLimit', ['only' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Campaigns/Index', [
            'testimonial_count' => Testimonial::where('user_id', auth()->user()->id)->count(),
            'campaigns' => Campaign::where('user_id', auth()->user()->id)->paginate(15)->through(fn ($campaign) => [
                'id' => $campaign->id,
                'name' => $campaign->name,
                'code' => $campaign->code,
                'landings' => $campaign->landings ? count($campaign->landings) : 0,
                'status' => $campaign->status,
                'rejection_reason' => $campaign->rejection_reason,
                'created_at' => Carbon::parse($campaign->created_at)->format('d M Y'),
                'links'=>$campaign->links,
                

            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Campaigns/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
        ])->validateWithBag('campaignErrors');

        $authUser = auth()->user();

        $packageLimit = subscriptionSetting($authUser);

        // $limitExceed = \checkLimitExceed($authUser, 'campaign', $packageLimit['allowed_campaings']);

        $authUser->campaigns()->create([
            'name' => $request->name,
            'uuid' => Str::uuid(),
            // 'status' => $limitExceed ? 'inactive' : 'active'
            'status' =>'active'
        ]);

        return redirect()->route('client.campaigns.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        Validator::make($request->all(), [
            'name' => ['required'],
        ])->validateWithBag('campaignErrors');

        $campaign = auth()->user()->campaigns()->findorFail($id);
        $campaign->update([
            'name' => $request->name,
            'status' => $campaign->status == 'rejected' ? 'requested' : $campaign->status
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       auth()->user()->campaigns()->findorFail($id)->delete();

        return redirect()->route('client.campaigns.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function campaignsList()
    {
        $campaigns = Campaign::latest()->get()->transform(fn ($campaign) => [
            'id' => $campaign->id,
            'name' => $campaign->name,
            'code' => $campaign->code,
            'status' => $campaign->status,
            'created_at' => Carbon::parse($campaign->created_at)->format('d M Y')
        ]);
        return \response()->json($campaigns);
    }

    /**
     * Change status.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->update(['status' => $request[0], 'previous_status' => $request[0]]);
        return redirect()->back();
    }
}