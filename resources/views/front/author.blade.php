@extends('layouts.front')

@section('title', $author->name)

@section('content')
  <h1>{{ $author->name }}</h1>
  @if ($articles->total() != 0)
    @foreach ($articles as $article)
      <x-post-block :article="$article"/>
    @endforeach
  @else
    <p class="my-4">Désolé, cet auteur n'a encore écrit aucun article.</p>
  @endif
  @if ($articles->hasPages())
    <x-pagination-links :collection="$articles" origin="{{ route('author.show', ['author' => $author]) }}"/>
  @endif
@endsection
