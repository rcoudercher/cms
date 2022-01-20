@php
    $logo = \App\Models\Config::where('name', 'logo')->first();
    $gaTrackingCode = \App\Models\Config::where('name', 'ga-tracking-code')->first();
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {!! is_null($gaTrackingCode) ? '' :  $gaTrackingCode->value !!}
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>Hello, world!</title>
        <title>@yield('title')</title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        @if (is_null($logo))
                            <a class="navbar-brand" href="#">LOGO</a>
                        @else
                            <img src="{{ $logo->value }}" height="40">
                        @endif
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                                </li>
                            @endguest
                            @auth
                                @can ('access-admin')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.home') }}">ADMIN</a>
                                    </li>
                                @endcan
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile.index') }}">Profil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                                    <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            @yield('content')
        </main>
        <footer></footer>
        {{-- shows a notification if there is one --}}
        @if (session()->has('notification'))
        <div id="msgbox-area" class="msgbox-area"></div>
        @include('scripts.message-box')
        <script type="text/javascript">
        let message = @json(session('notification'));
        let notification = new MessageBox("#msgbox-area", {
        closeTime: 10000,
        hideCloseButton: false
        });
        notification.show(message, 'FERMER', null);
        </script>
        @endif
        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>