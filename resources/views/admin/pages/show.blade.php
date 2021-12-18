@extends('layouts.admin')

@section('title', 'Show page')

@section('content')
  <x-admin-breadcrumb levels=2 label="Pages" label2="Show" link="{{ route('admin.pages.index') }}"/>
  
  <h1 class="h2">{{ $page->title }}</h1>
  
  <div class="btn-group btn-group-lg my-4">
    <a href="{{ route('admin.pages.edit', ['page' => $page]) }}" type="button" class="btn btn-primary">EDIT</a>
    <a href="{{ route('admin.pages.destroy', ['page' => $page]) }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
      document.getElementById('destroy-form').submit();">DELETE</a>
  </div>
  <div class="hidden">
    <form id="destroy-form" action="{{ route('admin.pages.destroy', ['page' => $page]) }}" method="POST">
      @method('DELETE')
      @csrf
    </form>
  </div>
  
  <ul>
    <li><span class="fw-bold">title:</span> {{ $page->title }}</li>
    <li><span class="fw-bold">meta_title:</span> {{ $page->meta_title }}</li>
    <li><span class="fw-bold">meta_description:</span> {{ $page->meta_description }}</li>
    <li><span class="fw-bold">content:</span> {{ $page->content }}</li>
  </ul>
  
@endsection