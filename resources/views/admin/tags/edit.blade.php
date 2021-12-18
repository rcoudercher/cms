@extends('layouts.admin')

@section('title', 'Edit tag')

@section('content')
  <x-admin-breadcrumb levels=2 label="Tags" label2="Edit" link="{{ route('admin.tags.index') }}"/>
  <h1 class="h2">Edit tag</h1>
  <form action="{{ route('admin.tags.update', ['tag' => $tag]) }}" method="POST">
    @method('PATCH')
    @include('admin.tags.form')
    <div class="mb-3">
      <label for="slug" class="form-label">Slug</label>
      <input type="text" id="slug" name="slug" @class([
        'form-control',
        'is-invalid' => $errors->has('slug'),
        ]) value="{{ old('slug') ?? $tag->slug }}">
      @error('slug')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection