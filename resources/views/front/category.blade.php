@extends('layouts.front')

@section('title', $category->name)

@section('content')
  <h1>{{ $category->name }}</h1>
  @if ($articles->total() != 0)
    @foreach ($articles as $article)
      <x-post-block :article="$article"/>
    @endforeach
  @else
    <p class="my-4">Désolé, cette catégorie ne contient encore aucun article.</p>
  @endif
  @if ($articles->hasPages())
    <x-pagination-links :collection="$articles" origin="{{ route('category.show', ['category' => $category]) }}"/>
  @endif
@endsection