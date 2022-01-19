@extends('layouts.admin')

@section('title', 'Schedule article')

@section('content')
  <x-admin-breadcrumb levels=2 label="Articles" label2="Schedule" link="{{ route('admin.articles.index') }}"/>
  <h1 class="h2">Schedule article</h1>
  <form action="{{ route('admin.articles.schedule.update', ['article' => $article]) }}" method="POST">
    @method('PATCH')
    @csrf
    <div class="mb-3">
        <label for="scheduled_at" class="form-label">Scheduled at date</label>
        <input type="datetime-local" class="form-control" id="scheduled_at" name="scheduled_at"
          value="{{ $article->scheduled_at }}" min="{{ $now }}">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
@endsection