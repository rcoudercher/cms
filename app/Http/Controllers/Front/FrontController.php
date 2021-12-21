<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Author;
use App\Models\Config;
use App\Models\Person;
use App\Models\Page;
use App\Models\Comment;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



use Illuminate\Support\Facades\Config as Config2;
use Illuminate\Support\Facades\URL;

class FrontController extends Controller
{  
  public function homepage(Request $request)
  {
    // hmArticle = Headline Main Article
    $mainBlockArticleId = Config::where('name', 'main-block-article')->firstOrFail();
    $hmArticle = Article::where('id', $mainBlockArticleId->value)->firstOrFail();
    
    $miniViewArticle1Id = Config::where('name', 'mini-view-article-1')->firstOrFail();
    $headlineSideArticle1 = Article::where('id', $miniViewArticle1Id->value)->firstOrFail();
    
    $miniViewArticle2Id = Config::where('name', 'mini-view-article-2')->firstOrFail();
    $headlineSideArticle2 = Article::where('id', $miniViewArticle2Id->value)->firstOrFail();
    
    $miniViewArticle3Id = Config::where('name', 'mini-view-article-3')->firstOrFail();
    $headlineSideArticle3 = Article::where('id', $miniViewArticle3Id->value)->firstOrFail();
    
    $miniViewArticle4Id = Config::where('name', 'mini-view-article-4')->firstOrFail();
    $headlineSideArticle4 = Article::where('id', $miniViewArticle4Id->value)->firstOrFail();
    
    $headlineSideArticles = collect([
      $headlineSideArticle1,
      $headlineSideArticle2,
      $headlineSideArticle3,
      $headlineSideArticle4
    ]);
    
    $headlineArticleIds = [
      $mainBlockArticleId->value,
      $miniViewArticle1Id->value,
      $miniViewArticle2Id->value,
      $miniViewArticle3Id->value,
      $miniViewArticle4Id->value,
    ];
            
    return view('front.home')->with([
      'hmArticle' => $hmArticle,
      'headlineSideArticles' => $headlineSideArticles,
      'articles' => Article::public()
                              ->whereNotIn('id', $headlineArticleIds)
                              ->orderByDesc('published_at')
                              ->take(10)
                              ->get(),
    ]);
  }
  
  public function article($year, $month, $day, $slug)
  {
    $article = Article::where('slug', $slug)
                          ->whereYear('published_at', $year)
                          ->whereMonth('published_at', $month)
                          ->whereDay('published_at', $day)
                          ->firstOrFail();
    
    $recentArticles = Article::public()
                            ->where('id', '!=', $article->id)
                            ->latest()
                            ->take(3)
                            ->get();
                          
    return view('front.article')->with([
      'article' => $article,
      'recentArticles' => $recentArticles,
      'comments' => Comment::where('article_id', $article->id)
                                ->approved()
                                ->orderByDesc('updated_at')
                                ->get(),
    ]);
  }
  
  public function tag(Tag $tag)
  {
    return view('front.tag')->with([
      'tag' => $tag,
      'articles' => $tag->publicArticles()->paginate(10),
    ]);
  }
  
  public function category(Category $category)
  {
    return view('front.category')->with([
      'category' => $category,
      'articles' => $category->publicArticles()->paginate(10),
    ]);
  }
  
  public function author(Author $author)
  {
    return view('front.author')->with([
      'author' => $author,
      'articles' => $author->publicArticles()->paginate(10),
    ]);
  }
  
  public function peopleIndex()
  {
    return view('front.people.index')->with([
      'people' => Person::all(),
    ]);
  }
  
  public function peopleShow(Person $person)
  {
    return view('front.people.show')->with([
      'person' => $person
    ]);
  }
  
  public function latestNews()
  {
    return view('front.latest-news')->with([
      'articles' => Article::public()->orderByDesc('created_at')->paginate(15),
    ]);
  }
  
  public function about()
  {
    return view('front.page')->with([
      'page' => Page::where('id', 1)->first(),
    ]);
  }
  
  public function contact()
  {
    return view('front.page')->with([
      'page' => Page::where('id', 2)->first(),
    ]);
  }
  
  public function legal()
  {
    return view('front.page')->with([
      'page' => Page::where('id', 3)->first(),
    ]);
  }
  
  public function privacy()
  {
    return view('front.page')->with([
      'page' => Page::where('id', 4)->first(),
    ]);
  }
  
  public function commentRules()
  {
    return view('front.page')->with([
      'page' => Page::where('id', 5)->first(),
    ]);
  }
  
  public function donation()
  {
    return view('front.page')->with([
      'page' => Page::where('id', 6)->first(),
    ]);
  }
  
  public function contribute()
  {
    return view('front.page')->with([
      'page' => Page::where('id', 7)->first(),
    ]);
  }
}
