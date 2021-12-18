@extends('layouts.admin')

@section('title', 'Show category')

@section('content')
  <x-admin-breadcrumb levels=2 label="Categories" label2="Show" link="{{ route('admin.categories.index') }}"/>
  
  <h1 class="h2">{{ $category->name }}</h1>
  
  <div class="btn-group btn-group-lg my-4">
    <a href="{{ route('admin.categories.edit', ['category' => $category]) }}" type="button" class="btn btn-primary">EDIT</a>
    <a href="{{ route('admin.categories.destroy', ['category' => $category]) }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
      document.getElementById('destroy-form').submit();">DELETE</a>
    <a href="{{ route('category.show', ['category' => $category]) }}" type="button" class="btn btn-primary">FRONT</a>
  </div>
  <div class="hidden">
    <form id="destroy-form" action="{{ route('admin.categories.destroy', ['category' => $category]) }}" method="POST">
      @method('DELETE')
      @csrf
    </form>
  </div>
  
  <ul>
    <li>Name: {{ $category->name }}</li>
    <li>Slug: {{ $category->slug }}</li>
  </ul>
  
  <h4>Articles:</h4>
  <ul>
    @foreach ($category->articles as $article)
      <li><a href="{{ route('admin.articles.show', ['article' => $article]) }}">{{ $article->title }}</a></li>
    @endforeach
  </ul>
@endsection