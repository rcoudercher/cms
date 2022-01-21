@extends('layouts.front')

@section('title', 'Modifier mon mot de passe')

@section('content')
  
  @php
    $hasBagCurrentPassword = false;
    $hasBagPassword = false;
    
    if ($errors->hasBag('updatePassword')) {
      $hasBagCurrentPassword = !empty($errors->updatePassword->first('current_password')) ? true : false;
      $hasBagPassword = !empty($errors->updatePassword->first('password')) ? true : false;
    }
  @endphp
  
<div class="container mt-4">
  <h1 class="h2">Modifier mon mot de passe</h1>
  <form method="POST" action="{{ route('profile.password.update') }}">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
      <label for="current_password" class="form-label">Mot de passe actuel</label>
      <input name="current_password" type="password" @class([
        'form-control',
        'is-invalid' => $hasBagCurrentPassword,
        ]) id="current_password">
      @error('current_password', 'updatePassword')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="password" class="form-label">Nouveau mot de passe</label>
      <input name="password" type="password" @class([
        'form-control',
        'is-invalid' => $hasBagPassword,
        ]) id="password">
      @error('password', 'updatePassword')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
      <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
    </div>
    
    <button type="submit" class="btn btn-primary">Envoyer</button>
  </form>
</div>

@endsection