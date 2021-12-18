@extends('layouts.admin')

@section('title', 'Create new category')

@section('content')
  <x-admin-breadcrumb levels=2 label="Categories" label2="Create" link="{{ route('admin.categories.index') }}"/>
  
  <h1 class="h2">Create new category</h1>
  <div class="alert alert-primary my-4" role="alert">
    A slug based on the given name is automatically added. It can be edited afterwards.
  </div>
  <form action="{{ route('admin.categories.store') }}" method="POST">
    @include('admin.categories.form')
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection