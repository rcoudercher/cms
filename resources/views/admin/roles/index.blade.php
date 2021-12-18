@extends('layouts.admin')

@section('title', 'Roles index')

@section('content')
  <x-admin-breadcrumb levels=1 label="Roles" link="{{ route('admin.roles.index') }}"/>
  <x-admin-resource-index-header 
  title="Roles index" 
  route="{{ route('admin.roles.create') }}" 
  btn-text="create new role"/>
  <table class="table table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($roles as $role)
      <tr>
        <td>{{ $role->id }}</td>
        <td>{{ $role->name }}</td>
        <td>
          <a class="btn btn-primary" href="{{ route('admin.roles.show', ['role' => $role]) }}">show</a>
          <a class="btn btn-primary" href="{{ route('admin.roles.edit', ['role' => $role]) }}">edit</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $roles->links() }}
@endsection