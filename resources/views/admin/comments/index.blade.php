@extends('layouts.admin')

@section('title', 'Comments index')

@section('content')
  <x-admin-breadcrumb levels=1 label="Comments" link="{{ route('admin.comments.index') }}"/>
  <x-admin-resource-index-header 
  title="Comments index" 
  route="{{ route('admin.comments.create') }}" 
  btn-text="create new comment"/>
  
  <h2 class="h3 mt-4">Pending comments</h2>
  <table class="table table-hover my-4">
    <thead>
      <tr>
        <th scope="col">User</th>
        <th scope="col">Article</th>
        <th scope="col">Content</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($pending as $comment)
      <tr>
        <td>
          @if (is_null($comment->author))
            <span class="fw-bold fst-italic">NULL</span>
          @else
            <a href="{{ route('admin.users.show', ['user' => $comment->author]) }}">{{ $comment->author->name }}</a>
          @endif
        </td>
        <td>
          @if (is_null($comment->article))
            <span class="fw-bold fst-italic">NULL</span>
          @else
            <a href="{{ route('admin.articles.show', ['article' => $comment->article]) }}">{{ $comment->article->title }}</a>
          @endif
        </td>
        <td>{{ $comment->content }}</td>
        <td>
          <div class="mb-2">
            <a class="btn btn-success" href="{{ route('admin.comments.approve', ['comment' => $comment]) }}" onclick="event.preventDefault(); 
              document.getElementById('approve-comment-{{ $comment->id }}-form').submit();">approve</a>
            <form id="approve-comment-{{ $comment->id }}-form" action="{{ route('admin.comments.approve', ['comment' => $comment]) }}" method="POST" class="hidden">
              @csrf
              @method('PATCH')
            </form>
          </div>
          <div class="">
            <a class="btn btn-danger" href="{{ route('admin.comments.reject', ['comment' => $comment]) }}" onclick="event.preventDefault(); 
              document.getElementById('reject-comment-{{ $comment->id }}-form').submit();">reject</a>
            <form id="reject-comment-{{ $comment->id }}-form" action="{{ route('admin.comments.reject', ['comment' => $comment]) }}" method="POST" class="hidden">
              @csrf
              @method('PATCH')
            </form>
          </div>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  
  
  <h2 class="h3">All comments</h2>
  <table class="table table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">User</th>
        <th scope="col">Article</th>
        <th scope="col">Content</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($comments as $comment)
      <tr>
        <td>{{ $comment->id }}</td>
        <td>
          @if (is_null($comment->author))
            <span class="fw-bold fst-italic">NULL</span>
          @else
            <a href="{{ route('admin.users.show', ['user' => $comment->author]) }}">{{ $comment->author->name }}</a>
          @endif
        </td>
        <td>
          @if (is_null($comment->article))
            <span class="fw-bold fst-italic">NULL</span>
          @else
            <a href="{{ route('admin.articles.show', ['article' => $comment->article]) }}">{{ $comment->article->title }}</a>
          @endif
        </td>
        <td>{{ $comment->content }}</td>
        <td>{{ $comment->status }}</td>
        <td>
          <a class="btn btn-primary" href="@if (is_null($comment->deleted_at))
            {{ route('admin.comments.show', ['comment' => $comment]) }}
          @else
            {{ route('admin.comments.soft-deleted.show', ['id' => $comment->id]) }}
          @endif">show</a>
          <a class="btn btn-primary" href="{{ route('admin.comments.edit', ['comment' => $comment]) }}">edit</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $comments->links() }}
@endsection