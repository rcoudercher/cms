@extends('layouts.admin')

@section('title', 'Edit category')

@section('content')
  <x-admin-breadcrumb levels=2 label="Categories" label2="Edit" link="{{ route('admin.categories.index') }}"/>
  <h1 class="h2">Edit category</h1>
  <form action="{{ route('admin.categories.update', ['category' => $category]) }}" method="POST">
    @method('PATCH')
    @include('admin.categories.form')
    <div class="mb-3">
      <label for="slug" class="form-label">Slug</label>
      <input type="text" id="slug" name="slug" @class([
        'form-control',
        'is-invalid' => $errors->has('slug'),
        ]) value="{{ old('slug') ?? $category->slug }}">
      @error('slug')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection