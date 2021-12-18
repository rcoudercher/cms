<?php

namespace App\Listeners;

use App\Events\CommentApprovedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\CommentApprovedMail;

class SendCommentApprovedEmailListener
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
     * @param  CommentApprovedEvent  $event
     * @return void
     */
    public function handle(CommentApprovedEvent $event)
    {  
      Mail::to($event->comment->author)
          ->send(new CommentApprovedMail($event->comment));
    }
}
