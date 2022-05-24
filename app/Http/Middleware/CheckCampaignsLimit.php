<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCampaignsLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authUser = auth()->user();
        $packageLimit = subscriptionSetting($authUser);
        $trialExpired = checkTrailExpiration($authUser);
        // $limitExceed = \checkLimitExceed($authUser, 'campaign', $packageLimit['allowed_campaings']);
        
        // if ($limitExceed && $request[0] == 'active') {
        //     return \redirect()->back()->with('error', 'Your account limit exceed. To active campagin upgrade your subscription.');
        // }

        if ($trialExpired && $request[0] == 'active') {
            return \redirect()->back()->with('error', 'Your free trial has been expired. Please upgrade your subscription.');
        }
        return $next($request);
    }
}
