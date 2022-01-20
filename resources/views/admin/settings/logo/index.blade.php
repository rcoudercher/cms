@extends('layouts.admin')

@section('title', 'Admin home')

@section('content')
  <h1>Settings</h1>
  <div class="row mt-4">
    <x-settings-nav/>
      <div class="col-10">
            <h2>Logo</h2>
            @if (is_null($logo))
                <p>No logo found</p>
                <h3>Upload a logo</h3>
                <form action="{{ route('admin.settings.logo.store') }}" method="POST" enctype='multipart/form-data'>
                    @csrf
                
                    <div class="mb-3">
                      <label for="image" class="form-label">Image file *</label>
                      <input name="image" class="form-control" type="file" id="image">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            @else
                <div class="btn-group btn-group-lg my-4">
                    <a href="{{ route('admin.settings.logo.edit') }}" type="button" class="btn btn-primary">EDIT</a>
                    <a href="{{ route('admin.settings.logo.delete') }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
                    document.getElementById('destroy-form').submit();">DELETE</a>
                </div>
                <div class="hidden">
                    <form id="destroy-form" action="{{ route('admin.settings.logo.delete') }}" method="POST">
                        @method('DELETE')
                        @csrf
                    </form>
                </div>
    
                <div>
                    <p>Your current logo is :</p>
                    <img class="img-fluid" src="{{ $logo->value }}" alt="">
                </div>
            @endif
      </div>
  </div>




  
@endsection