@extends('layouts.admin')

@section('title', 'Users index')

@section('content')
  <x-admin-breadcrumb levels=1 label="Users" link="{{ route('admin.users.index') }}"/>
  <x-admin-resource-index-header 
  title="Users index" 
  route="{{ route('admin.users.create') }}" 
  btn-text="create new user"/>
  <table class="table table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">email</th>
        <th scope="col">verified</th>
        <th scope="col">roles</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->hasVerifiedEmail() ? 'verified' : 'unverified' }}</td>
        <td>
          <ul>
            @foreach ($user->roles as $role)
              <li>{{ $role->name }}</li>
            @endforeach
          </ul>
        </td>
        <td>
          <a class="btn btn-primary" href="{{ route('admin.users.show', ['user' => $user]) }}">show</a>
          <a class="btn btn-primary" href="{{ route('admin.users.edit', ['user' => $user]) }}">edit</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $users->links() }}
@endsection