@extends('layouts.front')

@section('title', 'Mon compte')

@section('content')
  <h1 class="h2 mb-5">Supprimer mon compte</h1>
  
  <div class="alert alert-danger" role="alert">
    <div>
      Attention, cette action est irréversible ! Êtes-vous certain de vouloir supprimer votre compte ?
    </div>
    <div class="text-center">
      <a class="" href="{{ route('profile.delete') }}" onclick="event.preventDefault(); 
        document.getElementById('destroy-form').submit();">SUPPRIMER MON COMPTE</a>
    </div>
    
  </div>
  
  
  <form id="destroy-form" action="{{ route('profile.delete') }}" method="POST" class="hidden alert-link">
    @method('DELETE')
    @csrf
  </form>
  
@endsection