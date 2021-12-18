@extends('layouts.admin')

@section('title', 'Edit comment')

@section('content')
  <x-admin-breadcrumb levels=2 label="Comments" label2="Edit" link="{{ route('admin.comments.index') }}"/>
  <h1 class="h2">Edit comment</h1>
  <form action="{{ route('admin.comments.update', ['comment' => $comment]) }}" method="POST">
    @method('PATCH')
    @include('admin.comments.form')
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection