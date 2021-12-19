
<div id="navSupport" class="mb-3">
  <a id="navLinkSubscribe" href="{{ route('donation') }}">Nous soutenir</a>
</div>

<div id="navAuth" class="mb-3">
  <ul>
    @guest
      <li class="menu-item">
        <a href="{{ route('login') }}">Connexion</a>
      </li>
      <li class="menu-item">
        <a href="{{ route('register') }}">Créer un compte</a>
      </li>
    @endguest
    @auth
      @can ('access-admin')
        <li class="menu-item">
          <a href="{{ route('admin.home') }}">ADMIN</a>
        </li>
      @endcan
      <li class="menu-item">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
        <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
      </li>
      <li class="menu-item">
        <a href="{{ route('profile.index') }}">Profil</a>
      </li>
    @endauth
  </ul>
</div>

<div id="navMain">
  <ul>
    <li class="menu-item">
      <a href="{{ route('latestNews') }}">Dernières nouvelles</a>
    </li>
  </ul>
</div>

