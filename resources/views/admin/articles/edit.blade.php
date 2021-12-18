@extends('layouts.admin')

@section('title', 'Edit article')

@section('content')
  <x-admin-breadcrumb levels=2 label="Articles" label2="Edit" link="{{ route('admin.articles.index') }}"/>
  <h1 class="h2">Edit article</h1>
  <form action="{{ route('admin.articles.update', ['article' => $article]) }}" method="POST">
    @method('PATCH')
    @include('admin.articles.form')
    <div class="mb-3">
      <label for="slug" class="form-label">slug *</label>
      <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') ?? $article->slug }}">
      @error('slug')
        <small class="form-text text-muted">{{ $message }}</small>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection