@extends('layouts.admin')

@section('title', 'Show comment')

@section('content')
  <x-admin-breadcrumb levels=2 label="Comments" label2="Show" link="{{ route('admin.comments.index') }}"/>
  <h1 class="h2">Comment id° {{ $comment->id }}</h1>
  
  <div class="btn-group btn-group-lg my-4">
    <a href="{{ route('admin.comments.edit', ['comment' => $comment]) }}" type="button" class="btn btn-primary">EDIT</a>
    @if (is_null($comment->deleted_at))
      <a href="{{ route('admin.comments.destroy', ['comment' => $comment]) }}" type="button" class="btn btn-warning" onclick="event.preventDefault(); 
        document.getElementById('soft-delete-form').submit();">SOFT DELETE</a>
    @endif
    <a href="{{ route('admin.comments.force-delete', ['id' => $comment->id]) }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
      document.getElementById('force-delete-form').submit();">FORCE DELETE</a>
  </div>
  <div class="hidden">
    <form id="soft-delete-form" action="{{ route('admin.comments.destroy', ['comment' => $comment]) }}" method="POST">
      @method('DELETE')
      @csrf
    </form>
    <form id="force-delete-form" action="{{ route('admin.comments.force-delete', ['id' => $comment->id]) }}" method="POST">
      @method('DELETE')
      @csrf
    </form>
  </div>
    
  <ul>
    <li><strong>Key:</strong> {{ $comment->key }}</li>
    <li><strong>Status:</strong> {{ $comment->status }}</li>
    <li><strong>created_at:</strong> {{ $comment->created_at }}</li>
    <li><strong>updated_at:</strong> {{ $comment->updated_at }}</li>
    <li><strong>deleted_at:</strong> {{ $comment->deleted_at }}</li>
    <li>
      @if (is_null($comment->author))
        <strong>Author:</strong> <span class="fw-bold fst-italic">NULL</span>
      @else
        <strong>Author:</strong> <a href="{{ route('admin.users.show', ['user' => $comment->author]) }}">{{ $comment->author->name }}</a>
      @endif
    </li>
    <li>
      @if (is_null($comment->article))
        <strong>Article:</strong> <span class="fw-bold fst-italic">NULL</span>
      @else
        <strong>Article:</strong> <a href="{{ route('admin.articles.show', ['article' => $comment->article]) }}">{{ $comment->article->title }}</a>
      @endif
    </li>
    <li><strong>Content:</strong> {{ $comment->content }}</li>
  </ul>
@endsection
