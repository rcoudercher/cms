@extends('layouts.admin')

@section('title', 'Images index')

@section('content')
  <x-admin-breadcrumb levels=1 label="Images" link="{{ route('admin.images.index') }}"/>
  <x-admin-resource-index-header 
  title="Images index" 
  route="{{ route('admin.images.create') }}" 
  btn-text="create new image"/>
  <table class="table table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">thumbnail</th>
        <th scope="col">credit</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($images as $image)
      <tr>
        <td>{{ $image->id }}</td>
        <td><img style="max-width: 250px;" src="{{ $image->url }}"></td>
        <td>{{ $image->credit }}</td>
        <td>
          <a class="btn btn-primary" href="{{ route('admin.images.show', ['image' => $image]) }}">show</a>
          <a class="btn btn-primary" href="{{ route('admin.images.edit', ['image' => $image]) }}">edit</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $images->links() }}
@endsection