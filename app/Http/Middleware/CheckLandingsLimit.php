<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLandingsLimit
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
        if(!auth()->user()->hasRole('admin'))
        {
            $authUser = auth()->user();
            $packageLimit = subscriptionSetting($authUser);
            $limitExceed = \checkLimitExceed($authUser, 'landing', $packageLimit['allowed_landings']);
            $trialExpired = checkTrailExpiration($authUser);
            
            if ($trialExpired && $request[0] == 'active') {
                return \redirect()->back()->with('error', 'Your free trial has been expired. Please upgrade your subscription.');
            }
            if ($limitExceed && $request[0] == 'active') {
                return \redirect()->back()->with('error', 'Your account limit exceed. To active landing page upgrade your subscription.');
            }
            
        }
        return $next($request);
    }
}
