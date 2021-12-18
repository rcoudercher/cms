@extends('layouts.admin')

@section('title', 'Pages index')

@section('content')
  <x-admin-breadcrumb levels=1 label="Pages" link="{{ route('admin.pages.index') }}"/>
  <x-admin-resource-index-header 
  title="Pages index" 
  route="{{ route('admin.pages.create') }}" 
  btn-text="create new page"/>
  <table class="table table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">title</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($pages as $page)
      <tr>
        <td>{{ $page->id }}</td>
        <td>{{ $page->title }}</td>
        <td>
          <a class="btn btn-primary" href="{{ route('admin.pages.show', ['page' => $page]) }}">show</a>
          <a class="btn btn-primary" href="{{ route('admin.pages.edit', ['page' => $page]) }}">edit</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $pages->links() }}
@endsection