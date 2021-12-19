<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\PasswordResetEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetConfirmationMail;

class SendPasswordResetConfirmationEmailListener
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
    public function handle(PasswordResetEvent $event)
    {
      Mail::to($event->user->email)
            ->queue(new PasswordResetConfirmationMail($event->user));
    }
}
