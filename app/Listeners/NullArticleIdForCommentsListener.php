<?php

namespace App\Listeners;

use App\Events\ArticleDestroyedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Comment;

class NullArticleIdForCommentsListener
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
     * @param  ArticleDestroyedEvent  $event
     * @return void
     */
    public function handle(ArticleDestroyedEvent $event)
    {
        Comment::where('article_id', $event->id)->update([
          'article_id' => null,
        ]);
    }
}
