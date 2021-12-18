<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CommentController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
  //
  }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
  //
  }

 /**
  * Store a newly created resource in storage.
  *
  * @param  \App\Models\Article  $article
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Article $article, Request $request)
  {  
    $request->validate([
      'content' => 'required|string|max:10000',
    ]);
    
    // generates a unique key for the comment
    $key = Str::random(11);
    $picked = Comment::all()->pluck('key')->toArray();
    while (in_array($key, $picked)) {
      $key = Str::random(11);
    }
    
    Comment::create([
      'key' => $key,
      'user_id' => Auth::id(),
      'article_id' => $article->id,
      'content' => $request->input('content'),
      'status' => 'pending',
    ]);
    
    return back()->with('notification', 'Commentaire en attente de modération');
  }

 /**
  * Display the specified resource.
  *
  * @param  \App\Models\Comment  $comment
  * @return \Illuminate\Http\Response
  */
  public function show(Comment $comment)
  {
  //
  }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Models\Comment  $comment
  * @return \Illuminate\Http\Response
  */
  public function edit(Comment $comment)
  {
    // a middleware already checked if the authenticated user can edit this comment
    
    return view('front.comment.edit')->with([
      'comment' => $comment,
    ]);
  }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Models\Comment  $comment
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Comment $comment)
  {
    // a middleware already checked if the authenticated user can update this comment
      
    $request->validate([
      'content' => 'required|string|max:10000',
    ]);
    
    $comment->update([
      'status' => 'pending',
      'content' => $request->input('content'),
    ]);
    
    return redirect()->route('article.show', ['year' => $comment->article->created_at->year, 'month' => $comment->article->created_at->month, 'day' => $comment->article->created_at->day, 'slug' => $comment->article->slug])
    ->with('notification', 'Commentaire en attente de modération'); // return view with message
  }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Models\Comment  $comment
  * @return \Illuminate\Http\Response
  */
  public function destroy(Comment $comment)
  {
    // update resource status
    $comment->status = 'deleted';
    $comment->save();
    
    $comment->delete();
    return redirect()->route('article.show', ['year' => $comment->article->created_at->year, 'month' => $comment->article->created_at->month, 'day' => $comment->article->created_at->day, 'slug' => $comment->article->slug])
    ->with('notification', 'Commentaire supprimé');
  }
}
