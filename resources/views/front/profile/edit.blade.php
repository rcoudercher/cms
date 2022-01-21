@extends('layouts.front')

@section('title', 'Modifier mon profil')

@section('content')
  
  @php
    $hasBagName = false;
    $hasBagEmail = false;
    
    if ($errors->hasBag('updateProfileInformation')) {
      $hasBagName = !empty($errors->updateProfileInformation->first('name')) ? true : false;
      $hasBagEmail = !empty($errors->updateProfileInformation->first('email')) ? true : false;
    }
  @endphp
  
  <div class="container mt-4">
    <h1 class="h2">Modifier mon profil</h1>
    <form method="POST" action="{{ route('profile.info.update') }}">
      @csrf
      @method('PUT')

      <div class="mb-3">
      <label for="name" class="form-label">Nom</label>
      <input name="name" type="text" @class([
      'form-control',
      'is-invalid' => $errors->has('name') || $hasBagName,
      ]) id="name" value="{{ auth()->user()->name }}">
      @error ('name', 'updateProfileInformation')
      <div class="invalid-feedback">{{ $errors->updateProfileInformation->first('name') }}</div>
      @enderror
      </div>

      <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input name="email" type="email" @class([
      'form-control',
      'is-invalid' => $errors->has('email') || $hasBagEmail,
      ]) id="email" value="{{ auth()->user()->email }}">
      @error ('email', 'updateProfileInformation')
      <div class="invalid-feedback">{{ $errors->updateProfileInformation->first('email') }}</div>
      @enderror
      </div>

      <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
  </div>

@endsection