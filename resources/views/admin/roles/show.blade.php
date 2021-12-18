@extends('layouts.admin')

@section('title', $role->name)

@section('content')
  <x-admin-breadcrumb levels=2 label="Roles" label2="Show" link="{{ route('admin.roles.index') }}"/>
  
  <h1 class="h2">{{ $role->name }}</h1>
  
  <div class="btn-group btn-group-lg my-4">
    <a href="{{ route('admin.roles.edit', ['role' => $role]) }}" type="button" class="btn btn-primary">EDIT</a>
    <a href="{{ route('admin.roles.destroy', ['role' => $role]) }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
      document.getElementById('destroy-form').submit();">DELETE</a>
  </div>
  <div class="hidden">
    <form id="destroy-form" action="{{ route('admin.roles.destroy', ['role' => $role]) }}" method="POST">
      @method('DELETE')
      @csrf
    </form>
  </div>
  
  <ul>
    <li><strong>Name:</strong> {{ $role->name }}</li>
  </ul>

@endsection