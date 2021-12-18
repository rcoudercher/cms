@extends('layouts.admin')

@section('title', 'Create new person')

@section('content')
  <x-admin-breadcrumb levels=2 label="People" label2="Create" link="{{ route('admin.people.index') }}"/>
  <h1 class="h2">Create new person</h1>
  <form action="{{ route('admin.people.store') }}" method="POST">
    @include('admin.people.form')
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection