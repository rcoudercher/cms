@extends('layouts.admin')

@section('title', 'Google Analytics')

@section('content')
    <h1>Settings</h1>
    <div class="row mt-4">
        <x-settings-nav/>
        <div class="col-10">
            <h2>Google Analytics</h2>
            <h3>Upload a new Google Analytics tracking code</h3>
            <form action="{{ route('admin.settings.ga.update') }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="mb-3">
                    <textarea class="form-control" name="ga-tracking-code" rows="3">{{ $config->value }}</textarea>
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection