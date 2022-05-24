<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Plan;
use Stripe\Stripe;
use Carbon\Carbon;
use App\Models\Testimonial;
use App\Models\Page;

class PagesController extends Controller
{

    public function __construct() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function home(){

        $stripePlans = Plan::all();

        $plans = [
            'bronze' => [
                'instance' => null,
                // 'allowed_campagins' => "Allowed Active Campaign: " . \config('subscriptionSettings.bronze.allowed_campaings'),
                'allowed_landing' => "Allowed Active Landing pages: " . \config('subscriptionSettings.bronze.allowed_landings'),                
                'allowed_time' => "Allowed Time: " . \config('subscriptionSettings.bronze.allowed_time'),                
                'templates_available' => "Available Templates: " . \config('subscriptionSettings.bronze.templates_available'), 
                'personlized_templates' => "Personalized Templates: " . \config('subscriptionSettings.bronze.personlized_templates'),            
            ],
            'silver' => [
                'instance' => null,
                // 'allowed_campagins' => "Allowed Active Campaign: " . \config('subscriptionSettings.silver.allowed_campaings'),
                'allowed_landing' => "Allowed Active Landing pages: " . \config('subscriptionSettings.silver.allowed_landings'),
                'allowed_time' => "Allowed Time: " . \config('subscriptionSettings.silver.allowed_time'),                
                'templates_available' => "Available Templates: " . \config('subscriptionSettings.silver.templates_available'),                
                'personlized_templates' => "Personalized Templates: " . \config('subscriptionSettings.silver.personlized_templates'),                
            ],
            'gold' => [
                'instance' => null,
                // 'allowed_campagins' => "Allowed Active Campaign: " . \config('subscriptionSettings.gold.allowed_campaings'),
                'allowed_landing' => "Allowed Active Landing pages: " . \config('subscriptionSettings.gold.allowed_landings'),
                'allowed_time' => "Allowed Time: " . \config('subscriptionSettings.gold.allowed_time'),                
                'templates_available' => "Available Templates: " . \config('subscriptionSettings.gold.templates_available'),                
                'personlized_templates' => "Personalized Templates: " . \config('subscriptionSettings.gold.personlized_templates'),                
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
        
        $testimonials = Testimonial::where('status',Testimonial::STATUS['approved'])->inRandomOrder()->limit(3)->get();
        
        return view('frontend.home',compact('plans', 'testimonials'));
    }

    public function pages($slug){
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('frontend.pages', compact('page'));
    }
}
