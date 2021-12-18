<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Support\Str;
use App\Events\CommentApprovedEvent;
use App\Events\CommentRejectedEvent;
use App\Events\CommentDestroyedEvent;


class CommentController extends Controller
{
  public function index()
  {
    return view('admin.comments.index')->with([
      'pending' => Comment::pending()->orderByDesc('updated_at')->get(),
      'comments' => Comment::withTrashed()->orderByDesc('id')->paginate(20),
    ]);
  }

  public function create()
  {
    // generates a unique key for the comment
    $key = Str::random(11);
    $picked = Comment::all()->pluck('key')->toArray();
    while (in_array($key, $picked)) {
      $key = Str::random(11);
    }
    
    return view('admin.comments.create')->with([
      'key' => $key,
      'comment' => new Comment(), // passes an empty model to the view
    ]);
  }

  public function store(StoreCommentRequest $request)
  {
    $validatedData = array_merge($request->validated(), [
      'status' => 'pending',
    ]);
    
    Comment::create($validatedData);
    
    return redirect()->route('admin.comments.index')
    ->with('message', 'Comment created successfully.');
  }

  public function show(Comment $comment)
  {
    return view('admin.comments.show')->with([
      'comment' => $comment,
    ]);
  }

  public function edit(Comment $comment)
  {
    return view('admin.comments.edit')->with([
      'comment' => $comment,
    ]);
  }

  public function update(UpdateCommentRequest $request, Comment $comment)
  {
    $comment->update($request->validated()); // update model
    return redirect()->route('admin.comments.show', ['comment' => $comment])
    ->with('message', 'Comment updated successfully.'); // return view with message
  }

  public function destroy(Comment $comment)
  {
    $id = $comment->id;
    
    // update resource status
    $comment->status = 'deleted';
    $comment->save();
    
    $comment->delete();
    
    CommentDestroyedEvent::dispatch($id);
    
    return redirect()->route('admin.comments.index')
    ->with('message', 'Comment SOFT deleted successfully.');
  }
  
  public function showSoftDeleted($id)
  {
    $comment = Comment::withTrashed()
                    ->where('id', $id)
                    ->firstOrFail();
    
    return view('admin.comments.show')->with([
      'comment' => $comment,
    ]);
  }
  
   public function forceDelete($id)
   {     
     $comment = Comment::withTrashed()
                     ->where('id', $id)
                     ->firstOrFail();
     
     $comment->forceDelete();
     return redirect()->route('admin.comments.index')
     ->with('message', 'Comment FORCE deleted successfully.');
   }
   
   public function approve(Comment $comment)
   {
     $comment->status = 'approved';
     $comment->save();
     
     // send a email to notify the user
     CommentApprovedEvent::dispatch($comment);
     
     return redirect()->route('admin.comments.index')
     ->with('message', 'Comment approved');
   }
   
   public function reject(Comment $comment)
   {
     $comment->status = 'rejected';
     $comment->save();
     
     // send a email to notify the user
     CommentRejectedEvent::dispatch($comment);
     
     return redirect()->route('admin.comments.index')
     ->with('message', 'Comment rejected');
   }
}
