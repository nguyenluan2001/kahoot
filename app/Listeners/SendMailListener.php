<?php

namespace App\Listeners;

use App\Mail\RegisterSuccessMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\RegisterSuccessEvent;
class SendMailListener
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
    public function handle(RegisterSuccessEvent $event)
    {
        Mail::to($event->user['email'])->send(new RegisterSuccessMail());
    }
}
