@extends('layouts.admin')

@section('title', 'Show author')

@section('content')
  <x-admin-breadcrumb levels=2 label="Authors" label2="Show" link="{{ route('admin.authors.index') }}"/>
  
  <h1 class="h2">{{ $author->name }}</h1>
  
  <div class="btn-group btn-group-lg my-4">
    <a href="{{ route('admin.authors.edit', ['author' => $author]) }}" type="button" class="btn btn-primary">EDIT</a>
    <a href="{{ route('admin.authors.destroy', ['author' => $author]) }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
      document.getElementById('destroy-form').submit();">DELETE</a>
    <a href="{{ route('author.show', ['author' => $author]) }}" type="button" class="btn btn-primary">FRONT</a>
  </div>
  <div class="hidden">
    <form id="destroy-form" action="{{ route('admin.authors.destroy', ['author' => $author]) }}" method="POST">
      @method('DELETE')
      @csrf
    </form>
  </div>
  
  <ul>
    <li>Name: {{ $author->name }}</li>
    <li>Slug: {{ $author->slug }}</li>
  </ul>
  
  <h4>Articles</h4>
  <ul>
    @foreach ($articles as $article)
      <li><a href="{{ route('admin.articles.show', ['article' => $article]) }}">{{ $article->title }}</a></li>
    @endforeach
  </ul>
@endsection