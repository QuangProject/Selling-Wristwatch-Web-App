@extends('layouts.base')

@section('title')
    Login
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container-login">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{ asset('img/signin-image.jpg') }}" alt="sing up image"></figure>
                        <a href="{{ route('register') }}" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title fw-bold">Sign in</h2>
                        <form method="POST" class="register-form" id="login-form" action="{{ route('login') }}">
                            @csrf

                            {{-- Email --}}
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" class="@error('email') is-invalid @enderror" name="email"
                                    id="email" value="{{ old('email') }}" placeholder="Email" required
                                    autocomplete="email" autofocus />

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" class="@error('password') is-invalid @enderror" name="password"
                                    id="password" placeholder="Password" required autocomplete="current-password" />

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                {{-- Remember --}}
                                <div class="form-group">
                                    <input type="checkbox" name="remember-me" id="remember-me" class="agree-term"
                                        {{ old('remember') ? 'checked' : '' }} />
                                    <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember
                                        me</label>
                                </div>

                                {{-- Forgot Password --}}
                                <div class="form-group">
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>

                            {{-- Submit --}}
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="{{ route('login.google') }}"><i
                                            class="display-flex-center zmdi zmdi-google"></i></a></li>
                                <li><a href="{{ route('login.facebook') }}"><i
                                            class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
