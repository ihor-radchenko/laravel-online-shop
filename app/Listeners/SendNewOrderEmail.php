<?php

namespace AutoKit\Listeners;

use AutoKit\Events\NewOrder;
use AutoKit\Mail\NewOrder as NewOrderEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendNewOrderEmail
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
     * @param  NewOrder  $event
     * @return void
     */
    public function handle(NewOrder $event)
    {
        Mail::to($event->order->customer_email)->send(new NewOrderEmail($event->order));
    }
}
