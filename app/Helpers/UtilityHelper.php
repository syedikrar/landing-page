<?php

use App\Models\User;
use App\Models\Landing;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\Setting;


/**
 * Get logged in user role
 * @return object
 */
function getRole(User $user)
{
    return $user->roles ? $user->roles[0] : NULL;
}

/**
 * Get role permissions
 * @return object
 */
function getPermissionsName($role)
{
    return $role->permissions()->pluck('name')->toArray();
}

/**
 * stripePlanName
 *
 * @param $product
 * @return string
 */
function stripePlanName ($product) : string {
    $products = [
            config('services.stripe.bronze_plan_key') => 'Bronze',
            config('services.stripe.silver_plan_key')  => 'Silver',
            config('services.stripe.gold_plan_key')  => 'Gold'
        ];
    return isset($products[$product]) ? $products[$product] : '';
}

/**
 * latest subsription name
 *
 * @param $user
 * @return string
 */
function latestSubscriptionName($user)
{
    if(!$user->hasRole('admin'))
    {
        $subscription = DB::table('subscriptions')->select('*')->where('user_id',$user->id)->first();
        if ($subscription === null)
        abort(404);

        $subscriptionItem = DB::table('subscription_items')->where('subscription_id', $subscription->id)
        ->latest()->first();
        return strtolower(stripePlanName($subscriptionItem->stripe_product));
    }

    return strtolower('super');

    


    
}

/**
 * latest subsription setting
 *
 * @param $subscription
 * @return string
 */
function subscriptionSetting($user)
{
    $latestSubscriptionName = latestSubscriptionName($user);
    return \config('subscriptionSettings.' . $latestSubscriptionName);
}

/* get payment price id
 *
 * @param $productId
 * @return string
 */
function stripePriceId($productId)
{
    $name = strtolower(stripePlanName($productId));
    return config('subscriptionSettings.' . $name . '.price_key');
}

/**
 * check limit exceed
 *
 * @param $subscription
 * @return string
 */
function checkLimitExceed($model, $type, $limit)
{
    $response = false;

    switch ($type) {
        case 'campaign':
            $count = $model->campaigns()->active()->count();
            $response = $count >= $limit ?? true;
            break;
        
        case 'landing':
            $count = Landing::active()->whereHas('campaign', function ($query) use ($model) {
                $query->where('user_id', $model->id);
            })->count();
            $response = $count >= $limit ?? true;
            break;
    }

    return $response;
}

function checkTrailExpiration($user){

    $latestSubscriptionName = latestSubscriptionName($user);
    $subscription = DB::table('subscriptions')->select('*')->where('user_id',$user->id)->first();
    if($latestSubscriptionName == 'bronze')
    {
        $expirationDate = Carbon::parse($subscription->created_at)->addDays(7);
        return Carbon::now()->gt($expirationDate);
    }
    else
    return false;
}


function trailExpired(){

    $bronzePlan = config('services.stripe.bronze_plan_key');
    
    $subscriptions = DB::table('subscription_items')
        ->where('stripe_product', $bronzePlan)
        ->where( 'created_at', '<', Carbon::now()->subDays(7))
        ->latest()->get();

        foreach( $subscriptions as $sub){

            $subscription = DB::table('subscriptions')->select('*')->find($sub->subscription_id);
            $user = User::find($subscription->user_id);
            $campagins = $user->campaigns;
            foreach($campagins as $campagin){
                $campagin->update(['status' => 'inactive']);
                Landing::where('campaign_id', $campagin->id)->update(['status' => 'inactive']);
            }

        }

    }

    function getSocialLinks($link){
        if(str_contains($link, 'https://')){
            return $link;
        }
        return 'https://'.$link;
    }

    function getpages(){
        return Page::select('title', 'slug')->get();
    }

    function getSettings(){
        return Setting::pluck('value','key');
    }
    function getSiteEmail(){
        return Setting::where('key','contact_email')->first()->value;
    }

    function getLogo(){
        $settings = getSettings()->toArray();
        if(isset($settings['site_logo'])){
            //add admin base url on product;
            $url = 'https://admin.'.env('DOMAIN_URL').'/storage/'.$settings['site_logo'];
            if (strpos($url, 'storage/public') !== false) {
                return str_replace('storage/public', 'storage', $url);
            }else{
                return $url;
            }
        }
        return asset('images/logo.png');
    }


