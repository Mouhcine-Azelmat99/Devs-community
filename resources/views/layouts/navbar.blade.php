<header id="header">
    <nav id="nav-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4"></div>
                <Search :langue='@json($langue)'></Search>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container">
          <a class="navbar-brand" href="/">
          <img src="/images/devs-logo.png">
          </a>
          <button class="navbar-toggler" id="show" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
          </button>
          <button class="navbar-toggler" id="hide" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-times"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav" id="menu">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">
                    @if($langue=='ar')
                        المنشورات
                    @else
                        Posts
                    @endif
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('ressources.index')}}">
                     @if($langue=='ar')
                    المصادر
                    @else
                        Ressources
                    @endif
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('questions.index') }}">
                     @if($langue=='ar')
                        الاسئلة
                    @else
                        questions
                    @endif
                </a>
              </li>
            </ul>
            <ul @if($langue=='ar')
                    class="navbar-nav me-auto"
                @else
                    class="navbar-nav ms-auto"
                @endif id="social-media">
                @auth
                <li class="nav-item mx-2 mb-2">
                    <a class="nav-link" href="/profile" id="login">{{ Auth::user()->username }}</a>
                </li>
                <li class="nav-item mx-auto">
                    <form action="{{ route('logout') }}" method="POST">
                    @csrf
                        <button class="nav-link" id="login">
                             @if($langue=='ar')
                                تسجيل الخروج
                            @else
                                Logout
                            @endif
                        </button>
                    </form>
                </li>
                @else
                <li class="nav-item mx-3">
                    <a class="nav-link" href="{{route('login')}}" id="login">
                    @if($langue=='ar')
                        تسجيل الدخول
                    @else
                        Login / Register
                    @endif
                    </a>
                </li>
                @endauth
                <li class="nav-item mx-auto">
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                             @if($langue=='ar')
                                اللغة
                            @else
                                Langue
                            @endif
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="{{ route('langue') }}" method="POST">
                                @csrf
                                    <input type="hidden" name="langue" value="ar">
                                    <button class="nav-link" id="login">العربية</button>
                                </form>
                            </li>
                            <li>
                                <form action="{{ route('langue') }}" method="POST">
                                @csrf
                                    <input type="hidden" name="langue" value="an">
                                    <button class="nav-link" id="login">Anglish</button>
                                </form>
                            </li>
                        </ul>
                      </div>
                </li>
            </ul>
          </div>
        </div>
    </nav>
</header>
