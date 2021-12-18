@extends('layouts.admin')

@section('title', 'Create new image')

@section('content')
  <x-admin-breadcrumb levels=2 label="Images" label2="Create" link="{{ route('admin.images.index') }}"/>
  <h1 class="h2">Create new image</h1>
  <form action="{{ route('admin.images.store') }}" method="POST" enctype='multipart/form-data'>
    @csrf

    <div class="mb-3">
      <label for="image" class="form-label">Image file *</label>
      <input name="image" class="form-control" type="file" id="image">
    </div>

    <div class="mb-3">
      <label for="credit" class="form-label">Credit</label>
      <input type="text" id="credit" name="credit" @class([
        'form-control',
        'is-invalid' => $errors->has('credit'),
        ]) value="{{ old('credit') ?? $image->credit }}">
      @error('credit')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection