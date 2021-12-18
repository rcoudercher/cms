@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
  <div class="mt-5">
    <p>Vous devez avoir vérifié votre email pour accéder à cette page.</p>
    <p>Nous vous avons envoyé un lien de vérification lors de la création de votre compte.</p>
    <p>Vous avez perdu ce message ?</p>
    <form action="{{ route('verification.send') }}" method="POST">
      @csrf
      <button type="submit" class="button">Obtenir un nouveau lien</button>
    </form>
  </div>
@endsection