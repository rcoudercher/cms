<?php

namespace App\Listeners;

use App\Events\UserDestroyedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserDestroyedMail;

class SendUserDestroyedEmailListener
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
     * @param  UserDestroyedEvent  $event
     * @return void
     */
    public function handle(UserDestroyedEvent $event)
    {
      Mail::to('admin@ledroitchemin.com')
          ->send(new UserDestroyedMail($event->user));
    }
}
