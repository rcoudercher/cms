@extends('layouts.front')

@section('title', 'Commentaires')

@section('content')
<div class="container mt-4">
  <h1 class="h2 mb-3">Commentaires</h1>
  @php
    $count = Auth::user()->comments->count();
  @endphp
  
  @if ($count == 0)
    <p>Vous n'avez encore publié aucun commentaire</p>
  @else
    <div class="mb-3">{{ $count }} commentaires</div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Commentaire</th>
          <th scope="col">Date</th>
          <th scope="col">Statut</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($comments as $comment)
          <tr>
            <td>
              <div class="mb-2">
                {{ $comment->content }}
              </div>
              <div class="">
                sur l'article <a class="link-primary" href="{{ route('article.show', ['year' => $comment->article->created_at->year, 'month' => $comment->article->created_at->month, 'day' => $comment->article->created_at->day, 'slug' => $comment->article->slug]) }}">{{ $comment->article->title }}</a>
              </div>
            </td>
            <td>{{ $comment->created_at }}</td>
            <td>@php
                switch ($comment->status) {
                  case 'pending':
                    echo 'en attente de validation';
                    break;
                  case 'approved':
                    echo 'approuvé';
                    break;
                  case 'rejected':
                    echo 'refusé';
                    break;
                }
              @endphp</td>
            <td>
              <ul>
                <li><a class="link-primary" href="{{ route('comment.edit', ['comment' => $comment]) }}">Modifier</a></li>
                <li><a class="link-primary" href="{{ route('comment.delete', ['comment' => $comment]) }}" onclick="event.preventDefault(); 
                  document.getElementById('destroy-form-{{ $comment->id }}').submit();">Supprimer</a></li>
                <form id="destroy-form-{{ $comment->id }}" action="{{ route('comment.delete', ['comment' => $comment]) }}" method="POST" class="hidden">
                  @method('DELETE')
                  @csrf
                </form>
              </ul>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{ $comments->links() }}
  @endif
</div>  
@endsection