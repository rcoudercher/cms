@extends('layouts.front')

@section('title', $person->name)

@section('content')
  <main>
    <h1>{{ $person->name }}</h1>
    
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
  </main>  
  
@endsection