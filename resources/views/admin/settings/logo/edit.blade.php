@extends('layouts.admin')

@section('title', 'Admin home')

@section('content')
  <h1>Settings</h1>
  <div class="row mt-4">
      <div class="col-2">
            <div class="list-group">
                <a href="{{ route('admin.settings.logo.index') }}" class="list-group-item list-group-item-action active">Logo</a>
                <a href="#" class="list-group-item list-group-item-action">Main color</a>
            </div>
      </div>
      <div class="col-10">
            <h2>Logo</h2>
            <h3>Upload a new logo</h3>
            <form action="{{ route('admin.settings.logo.update') }}" method="POST" enctype='multipart/form-data'>
                @method('PATCH')
                @csrf
                <div class="mb-3">
                    <label for="image" class="form-label">Image file *</label>
                    <input name="image" class="form-control" type="file" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
      </div>
  </div>




  
@endsection