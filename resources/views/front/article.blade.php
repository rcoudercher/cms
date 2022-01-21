@extends('layouts.front')

@section('title', $article->title)

@section('metadata')
  <meta property="og:title" content="{{ $article->title }}">
  <meta property="og:description" content="{{ $article->description }}">
  <meta property="og:image" content="{{ config('app.url') . $article->image->url }}">
  <meta property="og:url" content="{{ route('article.show', ['article' => $article]) }}">
  <meta property="og:site_name" content="{{ config('app.name') }}">
  <meta property="og:type" content="article">
@endsection

@section('content')

  <div id="article" class="l-wrapper mt-4">
    <div id="article-head" class="mx-3">
      <div class="d-flex">
        <div>
          <a href="{{ route('category.show', ['category' => $article->category]) }}">{{ $article->category->name }}</a>
        </div>
        <div class="ms-auto">{{ in_array($comments->count(), [0,1]) ? $comments->count() . ' commentaire' : $comments->count() . ' commentaires' }}</div>
      </div>
      <div class="mt-3">
        <h1>{{ $article->title }}</h1>
      </div>
      <div class="mt-3">
        <p>{{ $article->description }}</p>
      </div>
      <div class="d-flex mt-3">
        <div>Par <a href="{{ route('author.show', ['author' => $article->author]) }}">{{ $article->author->name }}</a></div>
        <div class="mx-2">|</div>
        <div>Le {{ $article->postedAtInGoodFrench() }}</div>
      </div>
      <div class="d-flex mt-3">
        <div>Facebook</div>
        <div class="ms-2">Twitter</div>
        <div class="ms-2">Share</div>
      </div>
    </div>
    <div class="d-flex mt-3">
      <div id="article-main" class="mx-lg-3">
        <div id="article-image">
          <figure>
            <img src="{{ $article->image->url }}" class="img-fluid">
            <figcaption class="mx-3 mx-lg-0">{{ $article->image->credit }}</figcaption>
          </figure>
        </div>
        <div id="article-body" class="mx-3 mx-lg-0">{!! $content !!}</div>
        <div id="article-comments" class="mt-5 mx-3 mx-lg-0">
          <h5>
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
                    <button class="btn btn-primary" type="submit" class="button">Ajouter un commentaire</button>
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
        <div id="article-related" class="mt-5 mx-3 mx-lg-0">
          <h4>Articles récents</h4>
          <div>
            @foreach ($recentArticles as $article)
              <x-post-block :article="$article"/>
            @endforeach
          </div>
        </div>
      </div>
      <div id="article-side" class="d-none d-lg-block">
        {{-- <h3>Most read articles</h3> --}}
      </div>
    </div>
  </div>

@endsection