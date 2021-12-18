@extends('layouts.admin')

@section('title', 'Tags index')

@section('content')
  <x-admin-breadcrumb levels=1 label="Tags" link="{{ route('admin.tags.index') }}"/>
  <x-admin-resource-index-header 
  title="Tags index" 
  route="{{ route('admin.tags.create') }}" 
  btn-text="create new tag"/>
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
    @foreach ($tags as $tag)
      <tr>
        <td>{{ $tag->id }}</td>
        <td>{{ $tag->name }}</td>
        <td>{{ $tag->slug }}</td>
        <td>
          <a class="btn btn-primary" href="{{ route('admin.tags.show', ['tag' => $tag]) }}">show</a>
          <a class="btn btn-primary" href="{{ route('admin.tags.edit', ['tag' => $tag]) }}">edit</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $tags->links() }}
@endsection