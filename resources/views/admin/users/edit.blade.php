@extends('layouts.admin')

@section('title', 'Edit category')

@section('content')
  <x-admin-breadcrumb levels=2 label="Users" label2="Edit" link="{{ route('admin.users.index') }}"/>
  <h1 class="h2">Edit category</h1>
  <form action="{{ route('admin.users.update', $user) }}" method="POST">
    @method('PATCH')
    @include('admin.users.form')
  </form>
@endsection