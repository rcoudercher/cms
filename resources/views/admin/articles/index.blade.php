@extends('layouts.admin')

@section('title', 'Articles index')

@section('content')
  <x-admin-breadcrumb levels=1 label="Articles" link="{{ route('admin.articles.index') }}"/>
  
  <x-admin-resource-index-header 
  title="Articles index" 
  route="{{ route('admin.articles.create') }}" 
  btn-text="create new article"/>
  <table class="table table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">id</th>
        
        
        <th scope="col">title</th>
        <th scope="col">status</th>
        <th scope="col">category</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($articles as $article)
      <tr>
        <td>{{ $article->id }}</td>
        <td>{{ $article->title }}</td>
        <td>
          @if ($article->isPublic())
            <span class="badge bg-success">published</span>
          @elseif ($article->isScheduled())
            <span class="badge bg-info text-dark">scheduled {{ $article->scheduledAtDifference() }}</span>
          @else
            <span class="badge bg-warning text-dark">hidden</span>
          @endif
        </td>
        <td>
          @if (is_null($article->category))
            <span class="fw-bold fst-italic">NULL</span>
          @else
            <a href="{{ route('admin.categories.show', ['category' => $article->category]) }}">{{ $article->category->name }}</a>
          @endif
        </td>
        <td>
          <a class="btn btn-primary" href="{{ route('admin.articles.show', ['article' => $article]) }}">show</a>
          <a class="btn btn-primary" href="{{ route('admin.articles.edit', ['article' => $article]) }}">edit</a>
          @if (!$article->isPublic())
            <a class="btn btn-primary" href="{{ route('admin.articles.schedule.edit', ['article' => $article]) }}">schedule</a>
          @endif
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  {{ $articles->links() }}
@endsection