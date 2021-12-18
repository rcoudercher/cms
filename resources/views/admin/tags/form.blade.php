@csrf

<div class="mb-3">
  <label for="name" class="form-label">Name</label>
  <input type="text" id="name" name="name" @class([
    'form-control',
    'is-invalid' => $errors->has('name'),
    ]) value="{{ old('name') ?? $tag->name }}">
  @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>