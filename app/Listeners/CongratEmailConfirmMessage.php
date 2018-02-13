<?php

namespace AutoKit\Listeners;

use AutoKit\Events\ConfirmEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Lang;

class CongratEmailConfirmMessage
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
     * @param  ConfirmEmail  $event
     * @return void
     */
    public function handle(ConfirmEmail $event)
    {
        session()->flash('message', Lang::get('flash.confirm_success', ['user' => $event->user->name]));
    }
}
