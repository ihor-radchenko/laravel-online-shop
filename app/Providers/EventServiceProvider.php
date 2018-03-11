<?php

namespace AutoKit\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'AutoKit\Events\UserRegistered' => [
            'AutoKit\Listeners\SendConfirmEmail',
            'AutoKit\Listeners\CongratRegisteredUserMessage'
        ],
        'AutoKit\Events\ConfirmEmail' => [
            'AutoKit\Listeners\CongratEmailConfirmMessage'
        ],
        'AutoKit\Events\NewOrder' => [
            'AutoKit\Listeners\SendNewOrderEmail'
        ],
        'AutoKit\Events\UserEditInfo' => [
            'AutoKit\Listeners\CongratUserEditMessage'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
