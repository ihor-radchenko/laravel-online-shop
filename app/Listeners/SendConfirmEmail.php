<?php

namespace AutoKit\Listeners;

use AutoKit\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use AutoKit\Mail\UserRegistered as EmailToUser;
use Mail;

class SendConfirmEmail
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        Mail::to($event->user)->send(new EmailToUser($event->user));
    }
}
