@extends('layouts.front')

@section('title', 'Home')

@section('content')

<div id="headline">
  <div class="row">
    <div id="headline-main" class="col-md-8 mb-3 pb-2">
      <h2 id="hm-title" class="h2">
        <a href="{{ route('article.show', ['article' => $hmArticle]) }}">{{ $hmArticle->title }}</a>
      </h2>
      <div id="hm-figure" class="mt-3 pb-2 border-bottom">
        <a href="{{ route('article.show', ['article' => $hmArticle]) }}">
          <figure>
            <img class="img-fluid rounded" src="{{ $hmArticle->image->url }}">
            <figcaption class="credit">{{ $hmArticle->image->credit }}</figcaption>
          </figure>
        </a>
      </div>
    </div>
    <div id="headline-side" class="col-md-4">
      @foreach ($headlineSideArticles as $article)
        <article class="hs-item mb-3 pb-2 border-bottom">
          <div class="meta d-flex mb-2">
            @if (!is_null($article->category))
              <div class="text-uppercase">{{ $article->category->name }}</div>
              <div class="mx-1">|</div>
            @endif
            <div>{{ $article->postedAtDifference() }}</div>
          </div>
          <h3 class="h6">
            <a href="{{ route('article.show', ['article' => $article]) }}">{{ $article->title }}</a>
          </h3>
        </article>
      @endforeach
    </div>
  </div>
</div>

<div id="river" class="mt-4 mt-md-0">
  <h2 id="river-title" class="h5">Derniers articles</h2>
  <div>
    @foreach ($articles as $article)
      <x-post-block :article="$article"/>
    @endforeach
  </div>
</div>

<div class="pt-5 pb-4 text-center">
  <a class="button w-100" href="{{ route('latestNews') }}">Plus d'articles</a>
</div>
  
@endsection