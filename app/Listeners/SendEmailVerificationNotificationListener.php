<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\UserRegisteredEvent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailMail;

class SendEmailVerificationNotificationListener
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
    public function handle(UserRegisteredEvent $event)
    {
      if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {        
          Mail::to($event->user->email)
                ->queue(new VerifyEmailMail($event->user));
      }
    }
}
