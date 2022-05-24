<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Campaign;
use App\Models\Landing;
use App\Observers\UserObserver;
use App\Observers\CampaignObserver;
use App\Observers\LandingObserver;
use Illuminate\Support\Facades\Event;
use App\Listeners\StripeEventListener;
use Illuminate\Auth\Events\Registered;
use Laravel\Cashier\Events\WebhookReceived;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        WebhookReceived::class => [
            StripeEventListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Campaign::observe(CampaignObserver::class);
        User::observe(UserObserver::class);
        Landing::observe(LandingObserver::class);
    }
}
