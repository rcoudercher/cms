<?php

namespace App\Listeners;

use App\Events\CategoryDestroyedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\Article;

class NullCategoryIdForArticlesListener
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
     * @param  CategoryDestroyedEvent  $event
     * @return void
     */
    public function handle(CategoryDestroyedEvent $event)
    {
      Article::where('category_id', $event->id)->update([
        'category_id' => null,
      ]);
    }
}
