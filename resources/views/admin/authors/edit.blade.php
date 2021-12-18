@extends('layouts.admin')

@section('title', 'Edit author')

@section('content')
  <x-admin-breadcrumb levels=2 label="Authors" label2="Edit" link="{{ route('admin.authors.index') }}"/>
  <h1 class="h2">Edit author</h1>
  <form action="{{ route('admin.authors.update', ['author' => $author]) }}" method="POST">
    @method('PATCH')
    @include('admin.authors.form')
    <div class="mb-3">
      <label for="slug" class="form-label">Slug</label>
      <input type="text" id="slug" name="slug" @class([
        'form-control',
        'is-invalid' => $errors->has('slug'),
        ]) value="{{ old('slug') ?? $author->slug }}">
      @error('slug')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection