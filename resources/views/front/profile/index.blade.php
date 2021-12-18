@extends('layouts.front')

@section('title', 'Mon compte')

@section('content')
  <h1 class="h2">Mon compte</h1>
  
  @if (!Auth::user()->hasVerifiedEmail())
    <div class="alert alert-warning" role="alert">
      Vous n'avez pas encore vérifié votre email. <a class="alert-link" href="{{ route('verification.send') }}" onclick="event.preventDefault(); document.getElementById('send-verification-link-form').submit();">Besoin d'un nouveau lien ?</a>
    </div>
    <form id="send-verification-link-form" action="{{ route('verification.send') }}" method="POST">
      @csrf
    </form>
  @endif
  
  <div class="row align-items-center mt-4">
    <div class="col-9">
      <h2 class="h3">Profil</h2>
    </div>
    <div class="col-3 text-end">
      <div class="">
        <a href="{{ route('profile.info.edit') }}" class="button">Modifier</a>
      </div>
      
    </div>
  </div>
  
  <ul>
    <li>Nom : {{ Auth::user()->name }}</li>
    <li>Email : {{ Auth::user()->email }}</li>
    <li>Compte créé le : {{ Auth::user()->created_at->format('d/m/Y') }}</li>
  </ul>
  
  <h2 class="h3">Compte</h2>
  <ul>
    <li><a class="link-primary" href="{{ route('profile.password.edit') }}">Modifier mon mot de passe</a></li>
    <li><a class="link-primary" href="{{ route('profile.delete') }}">Supprimer mon compte</a></li>
  </ul>
  
  <h2 class="h3">Commentaires</h2>
  <ul>
    <li><a class="link-primary" href="{{ route('profile.comments') }}">Liste de mes commentaires</a> <span>({{ Auth::user()->comments->count() }})</span></li>
  </ul>
  
@endsection