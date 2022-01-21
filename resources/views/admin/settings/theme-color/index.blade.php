@extends('layouts.admin')

@section('title', 'Theme Color')

@section('content')
  <h1>Settings</h1>
    <div class="row mt-4">
    <x-settings-nav/>
    <div class="col-10">
      <h2>Theme Color</h2>
      @if (is_null($data))
                <p>No Theme Color found</p>
                <h3>Choose a Theme Color</h3>
                <form action="{{ route('admin.settings.theme-color.store') }}" method="POST">
                    @csrf
                    <p>Input Hex Color Codes only without the # like 97bec4</p>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="color" placeholder="97bec4">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            @else
                <div class="btn-group btn-group-lg my-4">
                    <a href="{{ route('admin.settings.theme-color.edit') }}" type="button" class="btn btn-primary">EDIT</a>
                    <a href="{{ route('admin.settings.theme-color.delete') }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
                    document.getElementById('destroy-form').submit();">DELETE</a>
                </div>
                <div class="hidden">
                    <form id="destroy-form" action="{{ route('admin.settings.theme-color.delete') }}" method="POST">
                        @method('DELETE')
                        @csrf
                    </form>
                </div>
                <div>
                    <p>Your current Theme Color is:</p>
                    <div class="p-5 text-center fs-1" style="background-color: {{ $data->value }};">{{ $data->value }}</div>
                </div>
            @endif
    </div>
  </div>
@endsection