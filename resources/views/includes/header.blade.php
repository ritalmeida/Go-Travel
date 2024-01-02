{{-- ANA RITA VIEIRA DE ALMEIRA 35456 --}}
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #fdde5d">
    <a class="navbar-brand" href="/home" style="color: #eb743f; font-weight:bolder">Go Travel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/home">Início<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about">Sobre</a>
        </li>
        <!--dropdown-->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Aldeias
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/spots">Experiências</a>
            <a class="dropdown-item" href="/gallery">Galeria de Imagens</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/cart">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
            </svg>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav mr-right">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="/session" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('login') }}">{{ __('Iniciar Sessão') }}</a>
            <a class="dropdown-item" href=" {{ route('register') }}">{{ __('Criar Conta') }}</a>
            <a class="dropdown-item" href="{{ route('profile') }}">{{__('Perfil')}}</a>
          </div>
        </li>
      </ul>
        
      <!--pesquisa-->
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Tópicos..." aria-label="Search">
        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Pesquisar</button>
      </form>
    </div>
</nav>
