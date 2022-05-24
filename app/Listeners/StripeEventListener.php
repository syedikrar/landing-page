<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\Subscription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(WebhookReceived $event)
    {
        // Handle the event
        try {
            switch ($event->payload['type']) {
                case 'customer.subscription.created':
                    Log::info("Received callback type", ['data' => $event->payload['type']]);
                    $user = User::where('stripe_id', $event->payload['data']['object']['customer'])
                        ->first();
                    if ($event->payload['data']['object']['customer']) {
                        $user = User::where('stripe_id', $event->payload['data']['object']['customer'])
                            ->first();
                        if ($user) {
                            $message = 'You have activated a new package';
                            $plan = $this->planData($event->payload['data']['object']['plan']);
                            $subject = 'New Subscription';
                            Mail::to($user->email)
                                ->send(new Subscription($user, $message, $subject, $plan));
                        }
                    }
                    break;
                case 'customer.subscription.updated':
                    Log::info("Received callback type", ['data' => $event->payload['type']]);
                    if ($event->payload['data']['object']['customer']) {
                        $user = User::where('stripe_id', $event->payload['data']['object']['customer'])
                            ->first();
                        if ($user) {
                            $message = 'You have activated a new package';
                            $plan = $this->planData($event->payload['data']['object']['plan']);
                            $subject = 'Subscription Changed';
                            Mail::to($user->email)
                                ->send(new Subscription($user, $message, $subject, $plan));
                        }
                    }
                    break;
            }
        } catch (\Exception $e) {
            Log::info("Exception", ['data' => $e->getMessage()]);
        }
        
    }

    public function planData($plan)
    {
        $name = stripePlanName($plan['product']);
        return [
            'name' => $name,
            'active_campaigns' => \config('subscriptionSettings.' . strtolower($name) . '.allowed_campaings' ),
            'active_landings' => \config('subscriptionSettings.' . strtolower($name) . '.allowed_landings' ),
            'price' => $plan['amount'] / 100
        ];
    }
}
