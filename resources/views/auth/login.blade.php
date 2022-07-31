@extends('layouts.app')

@section('content')
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
@endsection
