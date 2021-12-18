@extends('layouts.admin')

@section('title', 'Analytics index')

@section('content')
  <x-admin-breadcrumb levels=1 label="Analytics" link="{{ route('admin.analytics.index') }}"/>
  <h1 class="h2">Analytics index</h1>
  <div class="my-4">
    <a href="{{ route('admin.analytics.saveRequestLogs') }}">save yesterday's request logs to database</a>
  </div>
  <div class="">
    <h2 class="h3">Most visited pages YESTERDAY</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">URI</th>
          <th scope="col">Visits</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($visitsYesterday as $key => $value)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $key }}</td>
            <td>{{ $value }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection