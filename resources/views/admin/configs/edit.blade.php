@extends('layouts.admin')

@section('title', 'Edit config')

@section('content')
  <x-admin-breadcrumb levels=2 label="Configs" label2="Edit" link="{{ route('admin.configs.index') }}"/>
  <h1 class="h2">Edit config</h1>
  <form action="{{ route('admin.configs.update', ['config' => $config]) }}" method="POST">
    @method('PATCH')
    @include('admin.configs.form')
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection