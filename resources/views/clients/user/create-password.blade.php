@extends('layouts.base')

@section('title')
    Login
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create-password.css') }}">
@endsection

@section('content')
    <div class="main">
        <section class="signup">
            <div class="container-register">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title fw-bold text-center">Create New Password</h2>

                        <div id="password-error" role="alert"></div>

                        <form method="POST" class="create-password-form" id="create-password-form">
                            @csrf

                            {{-- Password --}}
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input id="password" type="password" name="password" placeholder="Password">
                            </div>

                            {{-- Confirm --}}
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input id="confirm-password" type="password" name="password_confirmation"
                                    placeholder="Repeat your password">
                            </div>

                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Create" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/create-password.js') }}"></script>
@endsection
