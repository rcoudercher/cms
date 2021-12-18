@extends('layouts.admin')

@section('title', 'Edit role')

@section('content')
  <x-admin-breadcrumb levels=2 label="Roles" label2="Edit" link="{{ route('admin.roles.index') }}"/>
  <h1 class="h2">Edit role</h1>
  <form action="{{ route('admin.roles.update', ['role' => $role]) }}" method="POST">
    @method('PATCH')
    @include('admin.roles.form')
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection