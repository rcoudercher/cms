@extends('layouts.admin')

@section('title', $person->name)

@section('content')
  <x-admin-breadcrumb levels=2 label="People" label2="Show" link="{{ route('admin.people.index') }}"/>
  
  <h1 class="h2">{{ $person->name }}</h1>
  
  <div class="btn-group btn-group-lg my-4">
    <a href="{{ route('admin.people.edit', ['person' => $person]) }}" type="button" class="btn btn-primary">EDIT</a>
    <a href="{{ route('admin.people.destroy', ['person' => $person]) }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
      document.getElementById('destroy-form').submit();">DELETE</a>
    <a href="{{ route('people.show', ['person' => $person]) }}" type="button" class="btn btn-primary">FRONT</a>
  </div>
  <div class="hidden">
    <form id="destroy-form" action="{{ route('admin.people.destroy', ['person' => $person]) }}" method="POST">
      @method('DELETE')
      @csrf
    </form>
  </div>
  
  <ul>
    <li><strong>Name:</strong> {{ $person->name }}</li>
    <li><strong>Slug:</strong> {{ $person->slug }}</li>
    <li><strong>date of birth:</strong> {{ $person->date_of_birth }}</li>
    <li><strong>place of birth:</strong> {{ $person->place_of_birth }}</li>
    <li><strong>date of death:</strong> {{ $person->date_of_death }}</li>
    <li><strong>place of death:</strong> {{ $person->place_of_death }}</li>
    <li><strong>description:</strong> {{ $person->description }}</li>
    <li><strong>content:</strong> {{ $person->content }}</li>
  </ul>

@endsection