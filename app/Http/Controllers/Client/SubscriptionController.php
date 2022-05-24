<?php

namespace App\Http\Controllers\Client;

use Stripe\Plan;
use Carbon\Carbon;
use Stripe\Stripe;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function __construct() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = auth()->user();
        $latestSubscriptionName = \latestSubscriptionName($authUser);
        $subscription = DB::table('subscriptions')->select('*')->where('user_id',$authUser->id)->first();
        $stripePlans = Plan::all();
        $plans = [
            'bronze' => [
                'instance' => null,
                'allowed_landing' => "Allowed Active Landing pages: " . \config('subscriptionSettings.bronze.allowed_landings'),                
                'allowed_time' => "Allowed Time: " . \config('subscriptionSettings.bronze.allowed_time'),                
                'templates_available' => "Available Templates: " . \config('subscriptionSettings.bronze.templates_available'),  
                'personlized_templates' => "Personalized Templates: " . \config('subscriptionSettings.bronze.personlized_templates'), 
                'package_purchased' => $latestSubscriptionName == 'bronze' ? true : false,
                'new_subscription_date' => $latestSubscriptionName == 'bronze'
                    ? Carbon::parse($subscription->created_at)->addWeeks(1)->format('d M Y') : NULL
            ],
            'silver' => [
                'instance' => null,
                'allowed_landing' => "Allowed Active Landing pages: " . \config('subscriptionSettings.silver.allowed_landings'),
                'allowed_time' => "Allowed Time: " . \config('subscriptionSettings.silver.allowed_time'),                
                'templates_available' => "Available Templates: " . \config('subscriptionSettings.silver.templates_available'),                
                'personlized_templates' => "Personalized Templates: " . \config('subscriptionSettings.silver.personlized_templates'),                
                'package_purchased' => $latestSubscriptionName == 'silver' ? true : false,
                'new_subscription_date' => $latestSubscriptionName == 'silver'
                    ? Carbon::parse($subscription->updated_at)->addMonths(1)->format('d M Y') : NULL
            ],
            'gold' => [
                'instance' => null,
                'allowed_landing' => "Allowed Active Landing pages: " . \config('subscriptionSettings.gold.allowed_landings'),
                'allowed_time' => "Allowed Time: " . \config('subscriptionSettings.gold.allowed_time'),                
                'templates_available' => "Available Templates: " . \config('subscriptionSettings.gold.templates_available'),                
                'personlized_templates' => "Personalized Templates: " . \config('subscriptionSettings.gold.personlized_templates'),                
                'package_purchased' => $latestSubscriptionName == 'gold' ? true : false,
                'new_subscription_date' => $latestSubscriptionName == 'gold'
                    ? Carbon::parse($subscription->updated_at)->addMonths(1)->format('d M Y') : NULL
            ],
        ];

        $products = [
            config('services.stripe.bronze_plan_key') => 'bronze',
            config('services.stripe.silver_plan_key') => 'silver',
            config('services.stripe.gold_plan_key') => 'gold'
        ];

        foreach($stripePlans->data as $plan) {
            if (isset($products[$plan->product])) {
                $plans[$products[$plan->product]]['instance'] = $plan;
            }
        }
        return Inertia::render('Subscriptions/Index', ['plans' => $plans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $packagePriceKey = stripePriceId($request->plan_id);
        
        if ($user->defaultPaymentMethod()) {
            if ($user->subscribed('default')) {
                $user->subscription('default')->swap($packagePriceKey);
                return \redirect()->back();
            }
        } else {
            return \redirect()->route('client.cards.index');
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Check user have card or not.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkCardDetails()
    {
        $user = auth()->user();
        return $user->defaultPaymentMethod()
            ? \response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'Card exist'
            ])
            : \response()->json([
                'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                'route' => route('client.cards.index')
            ]);
    }
}
