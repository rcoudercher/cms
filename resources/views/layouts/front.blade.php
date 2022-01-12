<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>@yield('title') | Le Droit Chemin</title>
    @yield('metadata')
  </head>
  <body>
    <div id="page-wrapper" class="mt-lg-4">
      
      <header id="mobile-nav" class="fixed-top py-3 d-lg-none wrapper-fluid bg-white border-bottom">
        <div id="mobile-nav-top" class="clearfix">
          <div class="float-start">
            @include('partials.logo')
          </div>
          <div class="float-end">
            <input class="menu-btn" type="checkbox" id="menu-btn" />
            <label class="menu-icon p-1" for="menu-btn" onclick="toggleMobileNavDropdown()">
              <span class="navicon" />
            </label>
          </div>
        </div>
        <div id="mobile-nav-dropdown" class="mt-4">
          <div class="m-0 p-0 navbar-nav-scroll">
            @include('partials.nav-links')
          </div>
        </div>
      </header>
      
      <div>
        <div id="desktop-nav" class="d-none d-lg-block fixed-top h-100 mt-4">
          <div class="logo mb-4">
            <a href="{{ route('home') }}">le Droit<br>Chemin</a>
          </div>
          <div class="m-0 p-0 navbar-nav-scroll">
            @include('partials.nav-links')
          </div>
        </div>
        <div class="content">
          <main>
            @yield('content')
          </main>
          <footer id="site-footer" class="border-top border-3 pt-5 pb-4 px-lg-0 mt-5">
            <div class="row">
              <div class="col-sm-6 col-md-4">
                <h6 class="h6">À propos</h5>
                <ul class="m-0 p-0">
                  <li class="menu-item"><a href="{{ route('about') }}">le Droit Chemin</a></li>
                  <li class="menu-item"><a href="{{ route('contact') }}">Contact</a></li>
                  <li class="menu-item"><a href="{{ route('legal') }}">Mentions légales</a></li>
                  <li class="menu-item"><a href="{{ route('privacy') }}">Confidentialité</a></li>
                  <li class="menu-item"><a href="{{ route('comment-rules') }}">Charte Commentaires</a></li>
                </ul>
              </div>
              <div class="col-sm-6 col-md-4 mt-5 mt-sm-0">
                <h6 class="h6">Nous soutenir</h5>
                <ul class="m-0 p-0">
                  <li class="menu-item"><a href="{{ route('donation') }}">Faire un don</a></li>
                  <li class="menu-item"><a href="{{ route('contribute') }}">Contribuer</a></li>
                </ul>
              </div>
              <div class=" col-md-4 mt-5 mt-md-0">
                <h6 class="h6">Réseaux</h5>
                <ul class="m-0 p-0">
                  <li class="menu-item"><a href="https://twitter.com/ldchemin">Twitter</a></li>
                  <li class="menu-item"><a href="https://gab.com/ldchemin/">Gab</a></li>
                  <li class="menu-item"><a href="https://gettr.com/user/ldchemin">GETTR</a></li>
                </ul>
              </div>
            </div>
            <div class="mt-5">
              <p class="text-center text-md-start fs-6 fst-italic">© 2021-2022 Le Droit Chemin - Tous droits réservés</p>
            </div>
          </footer>
        </div>
      </div>
    </div>
    
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
        
  </body>
</html>