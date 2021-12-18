@extends('layouts.auth')

@section('title', 'Changer le mot de passe')

@section('content')
  <form class="shadow bg-light rounded p-4 mb-4" action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ request()->route('token') }}">
    <h2 class="h3 text-center mb-4">Nouveau mot de passe</h2>
    <p>Indiquez votre email et choisissez un nouveau mot de passe.</p>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input name="email" type="email" @class([
        'form-control',
        'is-invalid' => $errors->has('email'),
        ]) id="email" value="{{ request()->email }}">
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
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
      <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
    </div>
    <button class="button w-100 mt-3" type="submit">Envoyer</button>
  </form>
@endsection