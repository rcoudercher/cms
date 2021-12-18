@extends('layouts.admin')

@section('title', 'People index')

@section('content')
  <x-admin-breadcrumb levels=1 label="People" link="{{ route('admin.people.index') }}"/>
  <x-admin-resource-index-header 
  title="People index" 
  route="{{ route('admin.people.create') }}" 
  btn-text="create new person"/>
  <table class="table table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">date of birth</th>
        <th scope="col">date of death</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($people as $person)
      <tr>
        <td>{{ $person->id }}</td>
        <td>{{ $person->name }}</td>
        <td>{{ $person->date_of_birth }}</td>
        <td>{{ $person->date_of_death }}</td>
        <td>
          <a class="btn btn-primary" href="{{ route('admin.people.show', ['person' => $person]) }}">show</a>
          <a class="btn btn-primary" href="{{ route('admin.people.edit', ['person' => $person]) }}">edit</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $people->links() }}
@endsection