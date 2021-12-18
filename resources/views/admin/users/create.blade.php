@extends('layouts.admin')

@section('title', 'Create user')

@section('content')
  <x-admin-breadcrumb levels=2 label="Users" label2="Create" link="{{ route('admin.users.index') }}"/>
  <h1 class="h2">Create new user</h1>
  <form action="{{ route('admin.users.store') }}" method="POST">
    @include('admin.users.form', ['create' => true])
  </form>
@endsection