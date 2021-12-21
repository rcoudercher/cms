@extends('layouts.front')

@section('title', $page->meta_title . ' | BRAND')

@section('content')
  <h1 class="h2">{{ $page->title }}</h1>
  <div class="mt-4">{!! $page->content !!}</div>
@endsection