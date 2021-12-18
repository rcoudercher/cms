@extends('layouts.front')

@section('title', $tag->name)

@section('content')
  <h1>{{ $tag->name }}</h1>  
  @if ($articles->total() != 0)
    @foreach ($articles as $article)
      <x-post-block :article="$article"/>
    @endforeach
  @else
    <p class="my-4">Désolé, ce tag ne contient encore aucun article.</p>
  @endif
  @if ($articles->hasPages())
    <x-pagination-links :collection="$articles" origin="{{ route('tag.show', ['tag' => $tag]) }}"/>
  @endif
@endsection