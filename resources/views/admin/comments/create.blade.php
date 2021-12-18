@extends('layouts.admin')

@section('title', 'Create comment')

@section('content')
  <x-admin-breadcrumb levels=2 label="Comments" label2="Create" link="{{ route('admin.comments.index') }}"/>
  <h1 class="h2">Create new comment</h1>
  <form action="{{ route('admin.comments.store') }}" method="POST">
    <div class="mb-3 row">
      <label for="key" class="col-sm-2 col-form-label">key</label>
      <div class="col-sm-10">
        <input name="key" type="text" readonly class="form-control-plaintext" id="key" value="{{ $key }}">
      </div>
    </div>
    @include('admin.comments.form')
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection