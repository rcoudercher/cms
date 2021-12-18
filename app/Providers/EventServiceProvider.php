<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\CommentApprovedEvent;
use App\Events\CommentRejectedEvent;
use App\Events\ArticleDestroyedEvent;
use App\Events\CategoryDestroyedEvent;
use App\Events\CommentDestroyedEvent;
use App\Events\ConfigDestroyedEvent;
use App\Events\ImageDestroyedEvent;
use App\Events\PageDestroyedEvent;
use App\Events\PersonDestroyedEvent;
use App\Events\RoleDestroyedEvent;
use App\Events\TagDestroyedEvent;
use App\Events\UserDestroyedEvent;
use App\Events\UserRegisteredEvent;


use App\Listeners\SendCommentApprovedEmailListener;
use App\Listeners\SendCommentRejectedEmailListener;
use App\Listeners\SendAccountDeletionConfirmationEmailListener;
use App\Listeners\SendUserDestroyedEmailListener;
use App\Listeners\NullArticleIdForCommentsListener;
use App\Listeners\NullUserIdForCommentsListener;
use App\Listeners\NullCategoryIdForArticlesListener;
use App\Listeners\SendEmailVerificationNotificationListener;



class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserRegisteredEvent::class => [
          SendEmailVerificationNotificationListener::class,
        ],
        CommentApprovedEvent::class => [
          SendCommentApprovedEmailListener::class,
        ],
        CommentRejectedEvent::class => [
          SendCommentRejectedEmailListener::class,
        ],
        ArticleDestroyedEvent::class => [
          NullArticleIdForCommentsListener::class,
        ],
        CategoryDestroyedEvent::class => [
          NullCategoryIdForArticlesListener::class,
        ],
        CommentDestroyedEvent::class => [
          
        ],
        ConfigDestroyedEvent::class => [
          
        ],
        ImageDestroyedEvent::class => [
          
        ],
        PageDestroyedEvent::class => [
          
        ],
        PersonDestroyedEvent::class => [
          
        ],
        RoleDestroyedEvent::class => [
          
        ],
        TagDestroyedEvent::class => [
          
        ],
        UserDestroyedEvent::class => [
          SendAccountDeletionConfirmationEmailListener::class,
          SendUserDestroyedEmailListener::class,
          NullUserIdForCommentsListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
