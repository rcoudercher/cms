@extends('layouts.admin')

@section('title', 'Admin home')

@section('content')
  <h1>Settings</h1>
  <div class="row mt-4">
      <div class="col-2">
            <div class="list-group">
                <a href="{{ route('admin.settings.logo.index') }}" class="list-group-item list-group-item-action">Logo</a>
                <a href="#" class="list-group-item list-group-item-action">Main color</a>
            </div>
      </div>
      <div class="col-10">content</div>
  </div>




  
@endsection