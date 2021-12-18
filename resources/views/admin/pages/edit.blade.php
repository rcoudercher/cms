@extends('layouts.admin')

@section('title', 'Edit page')

@section('content')
  <x-admin-breadcrumb levels=2 label="Pages" label2="Edit" link="{{ route('admin.pages.index') }}"/>
  <h1 class="h2">Edit page</h1>
  <form action="{{ route('admin.pages.update', ['page' => $page]) }}" method="POST">
    @method('PATCH')
    @include('admin.pages.form')
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection