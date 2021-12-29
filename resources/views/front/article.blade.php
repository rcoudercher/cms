@extends('layouts.front')

@section('title', $article->title)

@section('metadata')
  <meta property="og:title" content="{{ $article->title }}">
  <meta property="og:description" content="{{ $article->description }}">
  <meta property="og:image" content="{{ config('app.url') . $article->image->url }}">
  <meta property="og:url" content="{{ $article->link() }}">
  <meta property="og:site_name" content="{{ config('app.name') }}">
  <meta property="og:type" content="article">
@endsection

@section('content')
  
    <article id="article">
      <h1 class="h2 mb-4">{{ $article->title }}</h1>
      <p class="mb-4">{{ $article->description }}</p>
      <div id="article-infos" class="mb-4 fs-6 d-flex">
        @if (!is_null($article->category))
          <div>
            <a class="text-uppercase" href="{{ route('category.show', ['category' => $article->category]) }}">{{ $article->category->name }}</a>
          </div>
          <div class="mx-2">|</div>
        @endif
        <div>
          <span>Par <a class="fw-bold" href="{{ route('author.show', ['author' => $article->author]) }}">{{ $article->author->name }}</a>, le {{ $article->postedAtInGoodFrench() }}</span>
        </div>
      </div>
      <figure id="article-image" class="mb-5">
        <img src="{{ $article->image->url }}" class="img-fluid rounded">
        <figcaption class="credit">{{ $article->image->credit }}</figcaption>
      </figure>
      <div id="article-content" class="mb-5">{!! $content !!}</div>
      <div id="article-tags" class="d-flex flex-row">
        <span>Mots-clés :</span>
        <ul class="d-flex flex-row p-0 ms-2">
          @foreach ($article->tags as $tag)
            <li>
              <a class="link-primary" href="{{ route('tag.show', ['tag' => $tag]) }}">#{{ $tag->name }}</a>
            </li>
          @endforeach
        </ul>
      </div>
    </article>
    <div class="mt-4">
      <h4 class="h4">Articles récents</h4>
      <div>
        @foreach ($recentArticles as $article)
          <x-post-block :article="$article"/>
        @endforeach
      </div>
    </div>
    <div class="border-top">
      <h5 class="h5 mt-4">
        {{ in_array($comments->count(), [0,1]) ? $comments->count() . ' commentaire' : $comments->count() . ' commentaires' }} 
      </h5>
      <div>
        @guest
          <p class="mt-4"><a class="text-decoration-underline" href="{{ route('login') }}">Connectez-vous</a> pour pouvoir commenter cet article.</p>
        @endguest
        @auth
          <div class="d-flex flex-row mt-4">
            <div class="comment-author-thumbnail">
              <img class="rounded-circle" src="https://via.placeholder.com/50" alt="">
            </div>
            <div class="comment-main flex-grow-1 ms-3">
              <form action="{{ route('comment.store', ['article' => $article]) }}" method="post">
                @csrf
                <div class="mb-3">
                  <textarea name="content" placeholder="Ajouter un commentaire..." @class([
                    'form-control',
                    'is-invalid' => $errors->has('content'),
                    ]) rows="3" style="resize: none;"></textarea>
                    @error('content')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="button">Ajouter un commentaire</button>
              </form>
            </div>
          </div>
        @endauth
      </div>      
      <div class="mt-4">
        @foreach ($comments as $comment)
          <div class="comment d-flex flex-row mt-4">
            <div class="comment-author-thumbnail">
              <img class="rounded-circle" src="https://via.placeholder.com/50" alt="">
            </div>
            <div class="comment-main flex-grow-1 ms-3">
              <div class="d-flex">
                <div class="comment-author-name fw-bold flex-shrink-1">{{ $comment->author->name }}</div>
                <div class="comment-created-at ms-2">{{ $comment->createdAtDifference() }}</div>
                @if ($comment->wasModified())
                  <div class="ms-2">(modifié)</div>
                @endif
                @can ('update', $comment)
                  <div class="ms-2">
                    <a class="link-primary" href="{{ route('comment.edit', ['comment' => $comment]) }}">modifier</a>
                  </div>
                @endcan
                @can ('delete', $comment)
                  <div class="ms-2">
                    <a class="link-primary" href="{{ route('comment.delete', ['comment' => $comment]) }}" onclick="event.preventDefault(); 
                      document.getElementById('destroy-form-{{ $comment->id }}').submit();">supprimer</a>
                    <form id="destroy-form-{{ $comment->id }}" action="{{ route('comment.delete', ['comment' => $comment]) }}" method="POST" class="hidden">
                      @method('DELETE')
                      @csrf
                    </form>
                  </div>
                @endcan
              </div>
              <div class="mt-2">{{ $comment->content }}</div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
@endsection