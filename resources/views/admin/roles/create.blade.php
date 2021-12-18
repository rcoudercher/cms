@extends('layouts.admin')

@section('title', 'Create new role')

@section('content')
  <x-admin-breadcrumb levels=2 label="Roles" label2="Create" link="{{ route('admin.roles.index') }}"/>
  <h1 class="h2">Create new role</h1>
  <form action="{{ route('admin.roles.store') }}" method="POST">
    @include('admin.roles.form')
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection