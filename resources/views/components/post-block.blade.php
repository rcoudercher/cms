<article class="post-block my-4 pt-4 border-top">
  <div class="row">
    <div class="col-8 col-md-4">
      <h2 class="h5">
        <a href="{{ route('article.show', ['article' => $article]) }}">{{ $article->title }}</a>
      </h2>
      <div class="meta d-flex">
        @if (!is_null($article->category))
          <div class="text-uppercase">{{ $article->category->name }}</div>
          <div class="mx-1">|</div>
        @endif
        <div>{{ $article->postedAtDifference() }}</div>
      </div>
    </div>
    <div class="col-md-4 d-none d-md-block">{{ $article->description }}</div>
    <div class="col-4">
      <a href="{{ route('article.show', ['article' => $article]) }}">
        <figure class="mb-0">
          <img class="img-fluid rounded" src="{{ $article->image->url }}">
          <figcaption class="credit">{{ $article->image->credit }}</figcaption>
        </figure>
      </a>
    </div>
  </div>
</article>