@extends('layouts.auth')

@section('title', 'Inscription')

@section('content')
  <form class="shadow bg-light rounded p-4 mb-4" action="{{ route('register') }}" method="POST">
    @csrf
    <h2 class="h3 text-center mb-4">Inscription</h2>
    <div class="mb-3">
      <label for="name" class="form-label">Pseudo</label>
      <input name="name" type="text" @class([
        'form-control',
        'is-invalid' => $errors->has('name'),
        ]) id="name" value="{{ old('name') }}">
      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
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
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
      <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
    </div>
    <button class="btn btn-primary w-100 mt-3" type="submit">Envoyer</button>
  </form>
  <div class="text-center">
    <a href="{{ route('login') }}">Vous avez déjà un compte ?</a>
  </div>
@endsection