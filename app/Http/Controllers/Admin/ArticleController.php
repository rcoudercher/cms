<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Carbon\Carbon;
use App\Events\ArticleDestroyedEvent;


class ArticleController extends Controller
{
  public function index()
  {
    return view('admin.articles.index')->with([
      'articles' => Article::orderByDesc('id')->paginate(40),
    ]);
  }

  public function create()
  {
    // generates a unique key for the article
    $key = Str::random(11);
    $picked = Article::all()->pluck('key')->toArray();
    while (in_array($key, $picked)) {
      $key = Str::random(11);
    }
    
    return view('admin.articles.create')->with([
      'key' => $key,
      'article' => new Article(),
      'authors' => Author::all(),
      'categories' => Category::all(),
      'tags' => Tag::all(),
    ]);
  }

  public function store(StoreArticleRequest $request)
  {
    $article = Article::create($request->validated()); // create new model with validated data
    $article->tags()->sync($request->input('tags')); // sync article's tags
    return redirect()->route('admin.articles.index')
    ->with('message', 'Article created successfully.'); // return view with message
  }

  public function show(Article $article)
  {
    return view('admin.articles.show')->with([
      'article' => $article,
    ]);
  }

  public function edit(Article $article)
  {
    return view('admin.articles.edit')->with([
      'article' => $article,
      'authors' => Author::all(),
      'categories' => Category::all(),
      'tags' => Tag::all(),
    ]);
  }

  public function update(UpdateArticleRequest $request, Article $article)
  {
    $article->update($request->validated()); // update model
    $article->tags()->sync($request->input('tags')); // sync article's tags
    return redirect()->route('admin.articles.show', ['article' => $article])
    ->with('message', 'Article updated successfully.'); // return view with message
  }

  public function destroy(Article $article)
  {
    $id = $article->id;
    
    $article->delete();
    
    ArticleDestroyedEvent::dispatch($id);
    
    return redirect()->route('admin.articles.index')
    ->with('message', 'Article deleted successfully.');
  }
  
  public function publish(Article $article)
  {
    $article->published_at = Carbon::now();
    $article->save();
    
    return redirect()->route('admin.articles.show', ['article' => $article])
    ->with('message', 'Article published successfully'); // return view with message
  }
  
  public function hide(Article $article)
  {
    $article->published_at = null;
    $article->save();
    
    return redirect()->route('admin.articles.show', ['article' => $article])
    ->with('message', 'Article hidden successfully'); // return view with message
  }

  public function editSchedule(Article $article)
  {
    if ($article->isPublic()) {
      return redirect()->route('admin.articles.index')
      ->with('message', 'This article is already published');
    }

    $dt = Carbon::now();
    $now = $dt->format('Y-m-d') . 'T' . $dt->format('H:i');

    return view('admin.articles.schedule')->with([
      'article' => $article,
      'now' => $now,
    ]);
  }
  
  public function updateSchedule(Request $request, Article $article)
  {
    // validate the form inputs
    $request->validate([
      'scheduled_at' => 'required|date|after:now',
    ]);

    // update config
    $article->scheduled_at = Carbon::parse($request->input('scheduled_at'))->format('Y-m-d H:i:s');
    $article->save();

    return redirect()->route('admin.articles.index')
    ->with('message', 'Article scheduled successfully'); // return view with message
  }
  
  
}
