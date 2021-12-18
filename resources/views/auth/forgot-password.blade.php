@extends('layouts.auth')

@section('title', 'Mot de passe oublié')

@section('content')
  <form class="shadow bg-light rounded p-4 mb-4" action="{{ route('password.email') }}" method="POST">
    @csrf
    <h2 class="h3 text-center mb-4">Mot de passe oublié ?</h2>
    <p>Indiquez-nous votre email et nous vous enverrons un lien pour changer votre mot de passe.</p>
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
    <button class="button w-100 mt-3" type="submit">Envoyer</button>
  </form>
@endsection