<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Subscription extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $message;
    public $subject;
    public $plan;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $message, $subject, $plan)
    {
        $this->user = $user;
        $this->message = $message;
        $this->subject = $subject;
        $this->plan = $plan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->markdown('emails.subscription')->with([
            'user' => $this->user,
            'message' => $this->message,
            'package_name' => $this->plan['name'],
            'active_campaigns' => $this->plan['active_campaigns'],
            'active_landings' => $this->plan['active_landings'],
            'price' => $this->plan['price'],
        ]);
    }
}
