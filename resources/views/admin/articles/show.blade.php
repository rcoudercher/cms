@extends('layouts.admin')

@section('title', 'Show article')

@section('content')
  <x-admin-breadcrumb levels=2 label="Articles" label2="Show" link="{{ route('admin.articles.index') }}"/>
  
  <h1 class="h2">{{ $article->title }}</h1>
  
  <div class="btn-group btn-group-lg my-4">
    <a href="{{ route('admin.articles.edit', ['article' => $article]) }}" type="button" class="btn btn-primary">EDIT</a>
    @if ($article->isPublic())
      <a href="{{ route('admin.articles.hide', ['article' => $article]) }}" type="button" class="btn btn-warning" onclick="event.preventDefault(); 
        document.getElementById('hide-form').submit();">HIDE</a>
    @else
      <a href="{{ route('admin.articles.publish', ['article' => $article]) }}" type="button" class="btn btn-success" onclick="event.preventDefault(); 
        document.getElementById('publish-form').submit();">PUBLISH</a>
    @endif
    <a href="{{ route('admin.articles.destroy', ['article' => $article]) }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
      document.getElementById('destroy-form').submit();">DELETE</a>
    <a href="{{ route('article.show', ['year' => $article->created_at->year, 'month' => $article->created_at->month, 'day' => $article->created_at->day, 'slug' => $article->slug]) }}" type="button" class="btn btn-primary">FRONT</a>
  </div>
  
  <div class="hidden">
    <form id="publish-form" action="{{ route('admin.articles.publish', ['article' => $article]) }}" method="POST">
      @method('PATCH')
      @csrf
    </form>
    <form id="hide-form" action="{{ route('admin.articles.hide', ['article' => $article]) }}" method="POST">
      @method('PATCH')
      @csrf
    </form>
    <form id="destroy-form" action="{{ route('admin.articles.destroy', ['article' => $article]) }}" method="POST">
      @method('DELETE')
      @csrf
    </form>
  </div>
    
  <ul>
    <li><strong>id:</strong> {{ $article->id }}</li>
    <li><strong>key:</strong> {{ $article->key }}</li>
    <li><strong>created_at:</strong> {{ $article->created_at }}</li>
    <li><strong>updated_at:</strong> {{ $article->updated_at }}</li>
    <li><strong>Public:</strong> {{ $article->public }}</li>
    <li><strong>published_at:</strong> {{ $article->published_at }}</li>
    <li><strong>Author:</strong> <a href="{{ route('admin.authors.show', ['author' => $article->author]) }}">{{ $article->author->name }}</a></li>
    <li>
      @if (is_null($article->category))
        <strong>Category:</strong> <span class="fw-bold fst-italic">NULL</span>
      @else
        <strong>Category:</strong> <a href="{{ route('admin.categories.show', ['category' => $article->category]) }}">{{ $article->category->name }}</a>
      @endif
    </li>
    <li><strong>Title:</strong> {{ $article->title }}</li>
    <li><strong>Slug:</strong> {{ $article->slug }}</li>
    <li><strong>Tags:</strong>
      <ul>
        @foreach ($article->tags as $tag)
          <li><a href="{{ route('admin.tags.show', ['tag' => $tag]) }}">{{ $tag->name }}</a></li>
        @endforeach
      </ul>
    </li>
  </ul>
  
  <figure class="figure">
    <img class="figure-img img-fluid rounded" src="{{ $article->image->url }}">
    <figcaption class="figure-caption">{{ $article->image->credit }}</figcaption>
  </figure>
  <div>{!! $article->content !!}</div>
  
  <div class="border-top pt-4">
    <h3 class="h3">
      <span>{{ $article->comments->count() }}</span> comments
    </h3>
    <div class="">
      @foreach ($article->comments as $comment)
        <div class="d-flex flex-row mt-3">
          <div class="comment-author-thumbnail">
            <a href="{{ route('admin.users.show', ['user' => $comment->author]) }}">
              <img class="rounded-circle" src="https://via.placeholder.com/50" alt="">
            </a>
          </div>
          <div class="comment-main flex-grow-1 ms-3">
            <div class="d-flex">
              <div class="flex-shrink-1">
                <a href="{{ route('admin.users.show', ['user' => $comment->author]) }}">{{ $comment->author->name }}</a>
              </div>
              <div class="ms-3">{{ $comment->created_at }}</div>
            </div>
            <div class="">
              {{ $comment->content }}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
