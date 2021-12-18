@extends('layouts.admin')

@section('title', 'Authors index')

@section('content')
  <x-admin-breadcrumb levels=1 label="Authors" link="{{ route('admin.authors.index') }}"/>
  <x-admin-resource-index-header 
  title="Authors index" 
  route="{{ route('admin.authors.create') }}" 
  btn-text="create new author"/>
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
    @foreach ($authors as $author)
      <tr>
        <td>{{ $author->id }}</td>
        <td>{{ $author->name }}</td>
        <td>{{ $author->slug }}</td>
        <td>
          <a class="btn btn-primary" href="{{ route('admin.authors.show', ['author' => $author]) }}">show</a>
          <a class="btn btn-primary" href="{{ route('admin.authors.edit', ['author' => $author]) }}">edit</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $authors->links() }}
@endsection