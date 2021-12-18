@extends('layouts.admin')

@section('title', 'Create new config')

@section('content')
  <x-admin-breadcrumb levels=2 label="Configs" label2="Create" link="{{ route('admin.configs.index') }}"/>
  <h1 class="h2">Create new config</h1>
  <form action="{{ route('admin.configs.store') }}" method="POST">
    @include('admin.configs.form')
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection