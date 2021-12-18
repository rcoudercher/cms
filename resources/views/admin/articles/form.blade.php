@csrf

@error('slug')
  <div class="alert alert-danger mt-3" role="alert">
    <strong>{{ $message }}</strong>
  </div>
@enderror

<div class="mb-3">
  <label class="form-label">author *</label>
  <select @class([
    'form-select',
    'is-invalid' => $errors->has('author_id'),
    ]) name="author_id">
    <option>select author</option>
    @foreach ($authors as $author)
      <option value="{{ $author->id }}" {{ old('author_id') == $author->id || $article->author == $author ? 'selected' : '' }}>{{ $author->name }}</option>
    @endforeach
  </select>
  @error('author_id')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label">category *</label>
  <select @class([
    'form-select',
    'is-invalid' => $errors->has('category_id'),
    ]) name="category_id">
    <option>select category</option>
    @foreach ($categories as $category)
      <option value="{{ $category->id }}" {{ old('category_id') == $category->id || $article->category == $category ? 'selected' : '' }}>{{ $category->name }}</option>
    @endforeach
  </select>
  @error('category_id')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="image_id" class="form-label">image_id *</label>
  <input type="text" id="image_id" name="image_id" @class([
    'form-control',
    'is-invalid' => $errors->has('image_id'),
    ]) value="{{ old('image_id') ?? $article->image_id }}">
  @error('image_id')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label">tags</label>
  <select @class([
    'form-select',
    'is-invalid' => $errors->has('tags'),
    ]) multiple name="tags[]">
    @foreach ($tags as $tag)
      <option 
      value="{{ $tag->id }}"
      {{ !is_null(old('tags')) && in_array($tag->id, old('tags')) || $article->tags->contains($tag) ? 'selected' : '' }}
      >{{ $tag->name }}</option>
    @endforeach
  </select>
  @error('tags')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="name" class="form-label">title *</label>
  <input type="text" id="title" name="title" @class([
    'form-control',
    'is-invalid' => $errors->has('title'),
    ]) value="{{ old('title') ?? $article->title }}">
  @error('title')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="description" class="form-label">description *</label>
  <textarea @class([
    'form-control',
    'is-invalid' => $errors->has('description'),
    ]) id="description" rows="5" name="description">{{ old('description') ?? $article->description }}</textarea>
  @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="content" class="form-label">content *</label>
  <textarea @class([
    'form-control',
    'is-invalid' => $errors->has('content'),
    ]) id="content" rows="10" name="content">{{ old('content') ?? $article->content }}</textarea>
  @error('content')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>
