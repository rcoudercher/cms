@extends('layouts.front')

@section('title', 'Dernières Nouvelles')

@section('content')
  <div id="river" class="mt-4 mt-md-0">
    <h1 id="river-title" class="h2">Dernières nouvelles</h2>
    <div>
      @foreach ($articles as $article)
        <x-post-block :article="$article"/>
      @endforeach
    </div>
  </div>
  @if ($articles->hasPages())
    <x-pagination-links :collection="$articles" origin="{{ route('latestNews') }}"/>
  @endif
@endsection