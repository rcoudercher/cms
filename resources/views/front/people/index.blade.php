@extends('layouts.front')

@section('title', 'Qui?')

@section('content')
  <main>
    <ul>
      @foreach ($people as $person)
        <li>
          <a href="{{ route('front.person.show', ['person' => $person]) }}">{{ $person->name }}</a>
        </li>
      @endforeach
    </ul>
  </main>  
  
@endsection