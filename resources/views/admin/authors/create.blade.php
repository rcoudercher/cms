@extends('layouts.admin')

@section('title', 'Create new author')

@section('content')
  <x-admin-breadcrumb levels=2 label="Authors" label2="Create" link="{{ route('admin.authors.index') }}"/>
  <h1 class="h2">Create new author</h1>
  <div class="alert alert-primary my-4" role="alert">
    A slug based on the given name is automatically added. It can be edited afterwards.
  </div>
  <form action="{{ route('admin.authors.store') }}" method="POST">
    @include('admin.authors.form')
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection