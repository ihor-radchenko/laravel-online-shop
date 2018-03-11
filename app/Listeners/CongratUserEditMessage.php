<?php

namespace AutoKit\Listeners;

use AutoKit\Events\UserEditInfo;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Lang;

class CongratUserEditMessage
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
     * @param  UserEditInfo  $event
     * @return void
     */
    public function handle(UserEditInfo $event)
    {
        session()->flash('message', Lang::get('flash.user_edit', ['user' => $event->user->name]));
    }
}
