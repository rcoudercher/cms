@extends('layouts.auth')

@section('title', 'Connexion')

@section('content')
  <form class="shadow bg-light rounded p-4 mb-4" action="{{ route('login') }}" method="POST">
    @csrf
    <h2 class="h3 text-center mb-4">Connexion</h2>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input name="email" type="email" @class([
        'form-control',
        'is-invalid' => $errors->has('email'),
        ]) id="email" value="{{ old('email') }}">
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Mot de passe</label>
      <input name="password" type="password" @class([
        'form-control',
        'is-invalid' => $errors->has('password'),
        ]) id="password">
      @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <button class="btn btn-primary w-100 mt-3" type="submit">Envoyer</button>
  </form>
  <div class="text-center">
    <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
  </div>
  <div class="text-center">
    <a href="{{ route('register') }}">Créer un compte</a>
  </div>
@endsection