@extends('layouts.admin')

@section('title', 'Show user')

@section('content')
  <x-admin-breadcrumb levels=2 label="Users" label2="Show" link="{{ route('admin.users.index') }}"/>
  
  <h1 class="h2">{{ $user->name }}</h1>
  
  <div class="btn-group btn-group-lg my-4">
    <a href="{{ route('admin.users.edit', ['user' => $user]) }}" type="button" class="btn btn-primary">EDIT</a>
    <a href="{{ route('admin.users.destroy', ['user' => $user]) }}" type="button" class="btn btn-warning" onclick="event.preventDefault(); 
      document.getElementById('destroy-form').submit();">SOFT DELETE</a>
  </div>
  <div class="hidden">
    <form id="destroy-form" action="{{ route('admin.users.destroy', ['user' => $user]) }}" method="POST">
      @method('DELETE')
      @csrf
    </form>
  </div>
  
  <ul>
    <li>name: {{ $user->name }}</li>
    <li>email: {{ $user->email }}</li>
    <li>created_at: {{ $user->created_at }}</li>
    <li>updated_at: {{ $user->updated_at }}</li>
    <li>email_verified_at: {{ $user->email_verified_at }}</li>
    <li>Roles:
      <ul>
        @foreach ($user->roles as $role)
          <li>{{ $role->name }}</li>
        @endforeach
      </ul>
    </li>
    <li>Comments:
      <ul>
        @foreach ($user->comments as $comment)
          <li>
            <span class="fw-bold">
              <a href="{{ route('admin.comments.show', ['comment' => $comment]) }}">{{ $comment->id }}</a>:
            </span>
             {{ $comment->content }}
           </li>
        @endforeach
      </ul>
    </li>
  </ul>

@endsection