@extends('layouts.admin')

@section('title', 'Edit image')

@section('content')
  <x-admin-breadcrumb levels=2 label="Images" label2="Edit" link="{{ route('admin.images.index') }}"/>
  <h1 class="h2">Edit image</h1>
  <form action="{{ route('admin.images.update', ['image' => $image]) }}" method="POST">
    @method('PATCH')
    @csrf
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
    
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection