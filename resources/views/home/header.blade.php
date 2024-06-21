<header style="background-color: #2D3035">
  <nav class="navbar navbar-expand-lg navbar-dark custom_nav-container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <span class="nav-a">El Sol</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-a" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-a" href="contact.php">Contáctanos</a>
        </li>
      </ul>
      <div class="user_option d-flex align-items-center">
        @if (Route::has('login'))
          @auth
            <a class="nav-a" href="{{ url('mis_ordenes') }}">Mis órdenes</a>
            <a class="nav-a" href="{{ url('mi_carrito') }}">
              <i class="bi bi-cart"></i> [{{ $count }}]
            </a>
            <form method="POST" action="{{ route('logout') }}" class="ml-3">
              @csrf
              <button type="submit" class="btn btn-primary">Cerrar sesión</button>
            </form>
          @else
            <a class="nav-a" href="{{ url('/login') }}">
              <i class="bi bi-person-circle"></i> <span>Login</span>
            </a>
            <a class="nav-a" href="{{ url('/register') }}">
              <i class="bi bi-cloud-plus-fill"></i> <span>Registrarse</span>
            </a>
          @endauth
        @endif
      </div>
    </div>
  </nav>
</header>

<!--
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
    </div>
  </div>
</nav>-->