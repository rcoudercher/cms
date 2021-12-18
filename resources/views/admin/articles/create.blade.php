@extends('layouts.admin')

@section('title', 'Create article')

@section('content')
  <x-admin-breadcrumb levels=2 label="Articles" label2="Create" link="{{ route('admin.articles.index') }}"/>
  <h1 class="h2">Create new article</h1>
  <div class="alert alert-primary my-4" role="alert">
    A slug based on the given title is automatically created when creating a new article. It can be edited afterwards.
  </div>
  <form action="{{ route('admin.articles.store') }}" method="POST">
    <div class="mb-3 row">
      <label for="key" class="col-sm-2 col-form-label">key</label>
      <div class="col-sm-10">
        <input name="key" type="text" readonly class="form-control-plaintext" id="key" value="{{ $key }}">
      </div>
    </div>
    @include('admin.articles.form')
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection