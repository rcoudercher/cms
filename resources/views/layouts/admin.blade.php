<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.home') }}">ADMIN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Models</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('admin.articles.index') }}">Articles</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.authors.index') }}">Authors</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.categories.index') }}">Categories</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.comments.index') }}">Comments</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.configs.index') }}">Configs</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.images.index') }}">Images</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.pages.index') }}">Pages</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.people.index') }}">People</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.roles.index') }}">Roles</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.tags.index') }}">Tags</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Users</a></li>
              </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.analytics.index') }}">Analytics</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">FRONT</a></li>
            @auth
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
              </li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>
    <div class="container-fluid my-4">
      @if($errors->any())
        <div class="alert alert-danger mt-3" role="alert">
          DEBUG:
          {!! implode('', $errors->all('<div>:message</div>')) !!}
        </div>
      @endif
      
      @if (session('message'))
        <div class="alert alert-success mt-3" role="alert">
          <strong>{{ session()->get('message') }}</strong>
        </div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger mt-3" role="alert">
          <strong>{{ session()->get('error') }}</strong>
        </div>
      @endif
      @if($errors->first('query'))
        <div class="alert alert-warning mt-3" role="alert">
          {{ $errors->first('query') }}
        </div>
      @endif
      @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
