<?php

namespace App\Listeners;

use App\Events\CommentRejectedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\CommentRejectedMail;

class SendCommentRejectedEmailListener
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
     * @param  CommentRejectedEvent  $event
     * @return void
     */
    public function handle(CommentRejectedEvent $event)
    {
      Mail::to($event->comment->author)->send(new CommentRejectedMail($event->comment));
    }
}
