@extends('layouts.admin')

@section('title', 'Create new tag')

@section('content')
  <x-admin-breadcrumb levels=2 label="Tags" label2="Create" link="{{ route('admin.tags.index') }}"/>
  <h1 class="h2">Create new tag</h1>
  <div class="alert alert-primary my-4" role="alert">
    A slug based on the given name is automatically added. It can be edited afterwards.
  </div>
  <form action="{{ route('admin.tags.store') }}" method="POST">
    @include('admin.tags.form')
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection