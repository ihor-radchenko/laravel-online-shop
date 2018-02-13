<?php

namespace AutoKit\Listeners;

use AutoKit\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Lang;

class CongratRegisteredUserMessage
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
        session()->flash('message', Lang::get('flash.confirm_email', ['user' => $event->user->name]));
    }
}
