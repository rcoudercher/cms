@extends('layouts.admin')

@section('title', 'Google Analytics')

@section('content')
  <h1>Settings</h1>
    <div class="row mt-4">
    <x-settings-nav/>
    <div class="col-10">
      <h2>Google Analytics</h2>
      @if (is_null($data))
                <p>No tracking found</p>
                <h3>Upload a Google Analytics tracking code</h3>
                <form action="{{ route('admin.settings.ga.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <textarea class="form-control" name="ga-tracking-code" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            @else
                <div class="btn-group btn-group-lg my-4">
                    <a href="{{ route('admin.settings.ga.edit') }}" type="button" class="btn btn-primary">EDIT</a>
                    <a href="{{ route('admin.settings.ga.delete') }}" type="button" class="btn btn-danger" onclick="event.preventDefault(); 
                    document.getElementById('destroy-form').submit();">DELETE</a>
                </div>
                <div class="hidden">
                    <form id="destroy-form" action="{{ route('admin.settings.ga.delete') }}" method="POST">
                        @method('DELETE')
                        @csrf
                    </form>
                </div>
                <div>
                    <p>Your current Google Analytics tracking code is :</p>
                    <div>{{ $data->value }}</div>
                </div>
            @endif
    </div>
  </div>
@endsection