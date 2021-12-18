@csrf

<div class="mb-3">
  <label for="user_id" class="form-label">user_id *</label>
  <input type="text" id="user_id" name="user_id" @class([
    'form-control',
    'is-invalid' => $errors->has('user_id'),
    ]) value="{{ old('user_id') ?? $comment->user_id }}">
  @error('user_id')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="article_id" class="form-label">article_id *</label>
  <input type="text" id="article_id" name="article_id" @class([
    'form-control',
    'is-invalid' => $errors->has('article_id'),
    ]) value="{{ old('article_id') ?? $comment->article_id }}">
  @error('article_id')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="content" class="form-label">content *</label>
  <textarea @class([
    'form-control',
    'is-invalid' => $errors->has('content'),
    ]) id="content" rows="5" name="content">{{ old('content') ?? $comment->content }}</textarea>
  @error('content')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
