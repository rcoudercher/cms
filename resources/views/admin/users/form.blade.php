@csrf

@php
  $hasBagName = false;
  $hasBagEmail = false;
  
  if ($errors->hasBag('updateProfileInformation')) {
    $hasBagName = !empty($errors->updateProfileInformation->first('name')) ? true : false;
    $hasBagEmail = !empty($errors->updateProfileInformation->first('email')) ? true : false;
  }
@endphp

<div class="mb-3">
  <label class="form-label" for="name">name</label>
  <input type="text" id="name" @class([
    'form-control',
    'is-invalid' => $errors->has('name') || $hasBagName,
    ]) value="{{ old('name') ?? $user->name }}" name="name"/>
  @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
  @error ('name', 'updateProfileInformation')
    <div class="invalid-feedback">{{ $errors->updateProfileInformation->first('name') }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label" for="email">email</label>
  <input type="email" id="email" @class([
    'form-control',
    'is-invalid' => $errors->has('email') || $hasBagEmail,
    ]) value="{{ old('email') ?? $user->email }}" name="email"/>
  @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
  @error ('email', 'updateProfileInformation')
    <div class="invalid-feedback">{{ $errors->updateProfileInformation->first('email') }}</div>
  @enderror
</div>

@isset($create)
  <div class="mb-3">
    <label class="form-label" for="password">password</label>
    <input type="password" id="password" @class([
      'form-control',
      'is-invalid' => $errors->has('password'),
      ]) name="password"/>
    @error('password')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror  
  </div>
  
  <div class="mb-3">
    <label class="form-label" for="password_confirmation">password_confirmation</label>
    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"/>
  </div>
@endisset

<div class="mb-3">
  @foreach ($roles as $role)
    <div class="form-check">
      <input class="form-check-input" type="checkbox" 
      name="roles[]" value="{{ $role->id }}" id="{{ $role->name }}"
      @isset($user)
        @if (in_array($role->id, $user->roles->pluck('id')->toArray()))
          checked
        @endif
      @endisset>
      <label class="form-check-label" for="{{ $role->name }}">{{ $role->name }}</label>
    </div>
  @endforeach
</div>

<button type="submit" class="btn btn-primary">Submit</button>