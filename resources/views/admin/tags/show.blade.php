@extends('layouts.admin')

@section('title', 'Show tag')

@section('content')
  <x-admin-breadcrumb levels=2 label="Tags" label2="Show" link="{{ route('admin.tags.index') }}"/>
  
  <h1 class="h2">{{ $tag->name }}</h1>
  
  <div class="btn-group btn-group-lg my-4">
    <a href="{{ route('admin.tags.edit', ['tag' => $tag]) }}" type="button" class="btn btn-primary">EDIT</a>
    <a href="{{ route('admin.tags.destroy', ['tag' => $tag]) }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
      document.getElementById('destroy-form').submit();">DELETE</a>
    <a href="{{ route('tag.show', ['tag' => $tag]) }}" type="button" class="btn btn-primary">FRONT</a>
  </div>
  <div class="hidden">
    <form id="destroy-form" action="{{ route('admin.tags.destroy', ['tag' => $tag]) }}" method="POST">
      @method('DELETE')
      @csrf
    </form>
  </div>
  
  <ul>
    <li>Name: {{ $tag->name }}</li>
    <li>Slug: {{ $tag->slug }}</li>
  </ul>
  
  <h4>Articles:</h4>
  <ul>
    @foreach ($articles as $article)
      <li><a href="{{ route('admin.articles.show', ['article' => $article]) }}">{{ $article->title }}</a></li>
    @endforeach
  </ul>
@endsection