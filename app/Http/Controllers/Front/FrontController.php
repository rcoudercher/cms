<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Article;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Author;
use App\Models\Page;
use App\Models\Comment;
use App\Models\Image;

class FrontController extends Controller
{  
  public function homepage(Request $request)
  {
    // hero articles
    $heroArticles = Article::public()
                      ->orderByDesc('published_at')
                      ->take(8)
                      ->get();
    
    // feed articles
    if ($heroArticles->isNotEmpty()) {
      $articles = Article::public()
                      ->whereNotIn('id', $heroArticles->pluck('id')->toArray())
                      ->orderByDesc('published_at')
                      ->take(20)
                      ->get();
    } else {
      $articles = collect([]);
    }

    return view('front.home')->with([
      'heroArticles' => $heroArticles,
      'articles' => $articles,
      'blankArticle' => new Article(),
    ]);
  }
  
  public function article(Article $article)
  {
    // shows an error if the article is not public
    if (!$article->isPublic()) {
      abort(404);
    }
                          
    // replacing image markup in content
    $subject = $article->content;    
    
    // searching for something like '[[image=123]]'
    $pattern = '/\[\[.*?\]\]/';
    
    while (preg_match($pattern, $subject)) {
      // extract needle
      preg_match($pattern, $subject, $matches);
      $needle = $matches[0];
      // find needle position
      $pos = strpos($subject,$needle);
      // get needle id
      $id = substr($subject, $pos + 8, strlen($needle) - 10);
      // retrieve image from database
      $image = Image::find($id);
      // create HTML for the image
      $html = '<figure><img src="' . $image->url .'"><figcaption>' . $image->credit .'</figcaption></figure>';
      // replace needle by html
      $subject = Str::replaceFirst($needle, $html, $subject);
    }
        
    $recentArticles = Article::public()
                            ->where('id', '!=', $article->id)
                            ->latest()
                            ->take(3)
                            ->get();
                          
    return view('front.article')->with([
      'article' => $article,
      'content' => $subject,
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
