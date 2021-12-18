<?php

namespace App\Listeners;

use App\Events\UserDestroyedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Comment;

class NullUserIdForCommentsListener
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
      Comment::where('user_id', $event->user->id)->update([
        'user_id' => null,
      ]);
    }
}
