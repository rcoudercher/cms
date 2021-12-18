@extends('layouts.admin')

@section('title', 'Create new page')

@section('content')
  <x-admin-breadcrumb levels=2 label="Pages" label2="Create" link="{{ route('admin.pages.index') }}"/>
  <h1 class="h2">Create new page</h1>
  <form action="{{ route('admin.pages.store') }}" method="POST">
    @include('admin.pages.form')
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection