<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Comment;


class CommentApprovedEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;
  
  // make this variable public to be accessible in listeners
  public $comment;

  public function __construct(Comment $comment)
  {
    $this->comment = $comment;
  }
}
