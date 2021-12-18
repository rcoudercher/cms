@csrf

@error('slug')
  <div class="alert alert-danger mt-3" role="alert">
    <strong>{{ $message }}</strong>
  </div>
@enderror

<div class="mb-3">
  <label for="name" class="form-label">Name</label>
  <input type="text" id="name" name="name" @class([
    'form-control',
    'is-invalid' => $errors->has('name'),
    ]) value="{{ old('name') ?? $person->name }}">
  @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="date_of_birth" class="form-label">Date of Birth</label>
  <input type="date" id="date_of_birth" name="date_of_birth" @class([
    'form-control',
    'is-invalid' => $errors->has('date_of_birth'),
    ]) value="{{ old('date_of_birth') ?? $person->date_of_birth }}">
  @error('date_of_birth')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="place_of_birth" class="form-label">Place of Birth</label>
  <input type="text" id="place_of_birth" name="place_of_birth" @class([
    'form-control',
    'is-invalid' => $errors->has('place_of_birth'),
    ]) value="{{ old('place_of_birth') ?? $person->place_of_birth }}">
  @error('place_of_birth')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="date_of_death" class="form-label">Date of Death</label>
  <input type="date" id="date_of_death" name="date_of_death" @class([
    'form-control',
    'is-invalid' => $errors->has('date_of_death'),
    ]) value="{{ old('date_of_death') ?? $person->date_of_death }}">
  @error('date_of_death')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="place_of_death" class="form-label">Place of Death</label>
  <input type="text" id="place_of_death" name="place_of_death" @class([
    'form-control',
    'is-invalid' => $errors->has('place_of_death'),
    ]) value="{{ old('place_of_death') ?? $person->place_of_death }}">
  @error('place_of_death')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="description" class="form-label">Description</label>
  <textarea id="description" name="description" @class([
    'form-control',
    'is-invalid' => $errors->has('description'),
    ]) rows="5">{{ old('description') ?? $person->description }}</textarea>
  @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="content" class="form-label">Content</label>
  <textarea id="content" name="content" @class([
    'form-control',
    'is-invalid' => $errors->has('content'),
    ]) rows="5">{{ old('content') ?? $person->content }}</textarea>
  @error('content')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
