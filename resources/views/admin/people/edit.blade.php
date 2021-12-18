@extends('layouts.admin')

@section('title', 'Edit person')

@section('content')
  <x-admin-breadcrumb levels=2 label="People" label2="Edit" link="{{ route('admin.people.index') }}"/>
  <h1 class="h2">Edit person</h1>
  <form action="{{ route('admin.people.update', ['person' => $person]) }}" method="POST">
    @method('PATCH')
    @include('admin.people.form')
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection