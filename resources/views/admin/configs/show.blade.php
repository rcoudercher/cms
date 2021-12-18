@extends('layouts.admin')

@section('title', 'Show config')

@section('content')
  <x-admin-breadcrumb levels=2 label="Configs" label2="Show" link="{{ route('admin.configs.index') }}"/>
  <h1 class="h2">{{ $config->name }}</h1>
  
  <div class="btn-group btn-group-lg my-4">
    <a href="{{ route('admin.configs.edit', ['config' => $config]) }}" type="button" class="btn btn-primary">EDIT</a>
    <a href="{{ route('admin.configs.destroy', ['config' => $config]) }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
      document.getElementById('destroy-form').submit();">DELETE</a>
  </div>
  <div class="hidden">
    <form id="destroy-form" action="{{ route('admin.configs.destroy', ['config' => $config]) }}" method="POST">
      @method('DELETE')
      @csrf
    </form>
  </div>
  
  <ul>
    <li>Name: {{ $config->name }}</li>
    <li>Value: {{ $config->value }}</li>
  </ul>
@endsection
