<header id="header">
    <nav id="nav-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4"></div>
                <Search></Search>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container">
          <a class="navbar-brand" href="/">
          <img src="/images/favicon.png">
          </a>
          <form action="{{ route('theme') }}" method="POST">
            @csrf
            @method('PUT')
            <button id="dark_mode" type="submit">
                @if(session('isDark'))
                <img src="/images/brightness.png" alt="">
                @else
                <i class="fas fa-moon"></i>
                @endif
            </button>
        </form>
          <button class="navbar-toggler" id="show" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>
          <button class="navbar-toggler" id="hide" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-times"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav" id="menu">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Posts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('ressources.index')}}">Ressources</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('questions.index') }}">Questions</a>
              </li>
            </ul>
            <ul class="navbar-nav ms-auto" id="social-media">
                <li class="nav-item" id="theme">
                    <form action="{{ route('theme') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button id="mode" type="submit">
                            @if(session('isDark'))
                            <img src="/images/brightness.png" alt="">
                                @else
                            <i class="fas fa-moon"></i>
                            @endif
                        </button>
                    </form>
                </li>
                @auth
                <li class="nav-item mx-2 mb-2">
                    <a class="nav-link" href="/profile" id="login">{{ Auth::user()->username }}</a>
                </li>
                <li class="nav-item mx-2">
                    <form action="{{ route('logout') }}" method="POST">
                    @csrf
                        <button class="nav-link" id="login">Logout</button>
                    </form>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}" id="login">Login / Register</a>
                </li>
                @endauth
            </ul>
          </div>
        </div>
    </nav>
</header>
