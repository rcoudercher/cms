@extends('layouts.admin')

@section('title', 'Configs index')

@section('content')
  <x-admin-breadcrumb levels=1 label="Configs" link="{{ route('admin.configs.index') }}"/>
  <x-admin-resource-index-header 
  title="Configs index" 
  route="{{ route('admin.configs.create') }}" 
  btn-text="create new config"/>
  <table class="table table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">value</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($configs as $config)
      <tr>
        <td>{{ $config->id }}</td>
        <td>{{ $config->name }}</td>
        <td>{{ $config->value }}</td>
        <td>
          <a class="btn btn-primary" href="{{ route('admin.configs.show', ['config' => $config]) }}">show</a>
          <a class="btn btn-primary" href="{{ route('admin.configs.edit', ['config' => $config]) }}">edit</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $configs->links() }}
@endsection