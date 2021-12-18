@extends('layouts.admin')

@section('title', 'Show image')

@section('content')
  <x-admin-breadcrumb levels=2 label="Images" label2="Show" link="{{ route('admin.images.index') }}"/>
  
  <div class="btn-group btn-group-lg my-4">
    <a href="{{ route('admin.images.edit', ['image' => $image]) }}" type="button" class="btn btn-primary">EDIT</a>
    <a href="{{ route('admin.images.destroy', ['image' => $image]) }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
      document.getElementById('destroy-form').submit();">DELETE</a>
  </div>
  <div class="hidden">
    <form id="destroy-form" action="{{ route('admin.images.destroy', ['image' => $image]) }}" method="POST">
      @method('DELETE')
      @csrf
    </form>
  </div>
  
  <ul>
    <li>path: {{ $image->path }}</li>
    <li>url: {{ $image->url }}</li>
    <li>credit: {{ $image->credit }}</li>
    <li>original_name: {{ $image->original_name }}</li>
    <li>extension: {{ $image->extension }}</li>
    <li>created_at: {{ $image->created_at }}</li>
    <li>updated_at: {{ $image->updated_at }}</li>
  </ul>
  
  <img class="img-fluid" src="{{ $image->url }}">
  
@endsection