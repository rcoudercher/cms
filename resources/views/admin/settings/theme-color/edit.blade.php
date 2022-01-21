@extends('layouts.admin')

@section('title', 'Edit theme color')

@section('content')
    <h1>Settings</h1>
    <div class="row mt-4">
        <x-settings-nav/>
        <div class="col-10">
            <h2>Edit theme color</h2>
            <form action="{{ route('admin.settings.theme-color.update') }}" method="POST">
                @method('PATCH')
                @csrf
                <p>Input Hex Color Codes only without the # like 97bec4</p>
                <div class="mb-3">
                    <input type="text" class="form-control" name="color" value="{{ $config->value }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection