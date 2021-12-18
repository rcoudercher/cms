@extends('layouts.admin')

@section('title', 'Categories index')

@section('content')
  <x-admin-breadcrumb levels=1 label="Categories" link="{{ route('admin.categories.index') }}"/>
  <x-admin-resource-index-header 
  title="Categories index" 
  route="{{ route('admin.categories.create') }}" 
  btn-text="create new category"/>
  <table class="table table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">slug</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($categories as $category)
      <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->slug }}</td>
        <td>
          <a class="btn btn-primary" href="{{ route('admin.categories.show', ['category' => $category]) }}">show</a>
          <a class="btn btn-primary" href="{{ route('admin.categories.edit', ['category' => $category]) }}">edit</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $categories->links() }}
@endsection