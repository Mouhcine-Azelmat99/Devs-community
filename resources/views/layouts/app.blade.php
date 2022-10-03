<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="images/devs-logo.png">
    <!-- bootsrap style  -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
    <!-- font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- style css  -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>
<body  @if($langue=='ar')
    class="arab"
@endif>
    <div class="loader">
        <img src="{{asset('images/Pulse-1s-200px.svg')}}" alt="loader">
    </div>
    @auth @else
        <div class="login_modal">
            <section class="login">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                        <ul class="header">
                                <li id="list_login" class="active">
                                    <button id="login_show">Login</button>
                                </li>
                                <li id="list_register">
                                    <button id="register_show">Register</button>
                                </li>
                            </ul>
                            <hr>
                            <form method="POST" id="login_form" action="{{ route('login') }}">
                            @csrf
                                <div class="my-2">
                                    <label for="email" class="form-label">email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="my-2">
                                    <label for="password" class="form-label">password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <a href="register">I don't have account</a>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn py-2">Confirme</button>
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('facebook.login') }}" style="background:#1877F2;color:#fff" class="btn btn-facebook py-2 btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                    </a>
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('google.login') }}" style="background:#DB4437;color:#fff" class="btn btn-google py-2 btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Login with Google
                                    </a>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </form>

                            {{-- register --}}
                            <form method="POST" id="register_form" action="{{ route('register') }}">
                            @csrf
                                <div class="my-2">
                                    <label for="username" class="form-label">username</label>
                                    <input id="username" type="text" class="form-control px-4 @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="my-2">
                                    <label for="email" class="form-label">email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="my-2">
                                    <label for="password" class="form-label">password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="my-2">
                                    <label for="password-confirm" class="form-label">Confirm password-confirm</label>
                                    <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">

                                    @error('password-confirm')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <a href="login">I have already account</a>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-lg">Confirme</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endauth
    <div id="app">
        @yield('content')
    </div>
    {{-- <div class="icon-bar">
        <a href="#" class="facebook"><i class="fab  fa-facebook"></i></a>
        <a href="#" class="twitter"><i class="fab  fa-twitter"></i></a>
        <a href="#" class="google"><i class="fab  fa-google"></i></a>
        <a href="#" class="linkedin"><i class="fab  fa-linkedin"></i></a>
        <a href="#" class="youtube"><i class="fab  fa-youtube"></i></a>
  </div> --}}
    <div id="theme" class="@if ($dark_theme) theme-dark @endif">
    <form action="{{ route('theme') }}" method="POST">
            @csrf
            <input type="hidden" value="{{$dark_theme}}" name="theme">
            <button>
            @if($dark_theme)
                <img src="/images/brightness.png" alt="">
            @else
                <i class="fas fa-moon"></i>
            @endif
        </button>
        </form>
    </div>
    <div id="gotop" class="@if ($dark_theme) gotop-dark @endif">
        <button onclick="topFunction()">
            <i class="fas fa-angle-double-up"></i>
        </button>
    </div>

    <script>
    $(function(){
        setTimeout(() => {
            $(".loader").fadeOut(400)
        }, 500);
    })
    $(function(){
        setTimeout(() => {
            $(".login_modal").fadeIn(1000)
        }, 20000);
    })
    function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    }
    var mybutton = document.getElementById("gotop");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}


    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ mix('js/main.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
