@csrf

<div class="mb-3">
  <label for="meta_title" class="form-label">meta_title *</label>
  <input type="text" id="meta_title" name="meta_title" @class([
    'form-control',
    'is-invalid' => $errors->has('meta_title'),
    ]) value="{{ old('meta_title') ?? $page->meta_title }}">
  @error('meta_title')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="meta_description" class="form-label">meta_description *</label>
  <textarea id="meta_description" rows="4" @class([
    'form-control',
    'is-invalid' => $errors->has('meta_description'),
    ]) name="meta_description">{{ old('meta_description') ?? $page->meta_description }}</textarea>
  @error('meta_description')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="title" class="form-label">title *</label>
  <input type="text" id="title" name="title" @class([
    'form-control',
    'is-invalid' => $errors->has('title'),
    ]) value="{{ old('title') ?? $page->title }}">
  @error('title')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="content" class="form-label">content *</label>
  <textarea id="content" rows="10" @class([
    'form-control',
    'is-invalid' => $errors->has('content'),
    ]) name="content">{{ old('content') ?? $page->content }}</textarea>
  @error('content')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
