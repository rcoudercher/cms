<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>@yield('title')</title>
  </head>
  <body>
    <div class="container">
      <div class="pt-5 text-center">
        @include('partials.logo')
      </div>
      <div class="mx-auto mt-5 mb-4" style="width: 340px;">
        @yield('content')
      </div>
      <div class="text-center my-4">
        <a class="footerLink" href="{{ route('privacy') }}">Confidentialité</a>
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
    </div>
  </body>
</html>