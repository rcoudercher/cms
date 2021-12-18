@csrf

<div class="mb-3">
  <label for="name" class="form-label">Name</label>
  <input type="text" id="name" name="name" @class([
    'form-control',
    'is-invalid' => $errors->has('name'),
    ]) value="{{ old('name') ?? $config->name }}">
  @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="name" class="form-label">Value</label>
  <input type="text" id="value" name="value" @class([
    'form-control',
    'is-invalid' => $errors->has('value'),
    ]) value="{{ old('value') ?? $config->value }}">
  @error('value')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>