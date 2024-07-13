<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    
</head>
<body>
<div class="limiter">
    <div class="container-login100" style="background-image: url('{{ asset('images/bg-01.jpg') }}');">
        <div class="wrap-register100 p-t-50 p-b-50">
            <form class="register100-form validate-form p-b-50 p-t-5" method="POST" action="{{ route('register') }}">
                @csrf
                <span class="login100-form-logo" style="margin-top:30px">
                    <img src="{{ asset('images/logo pgri.png') }}" alt="" width="120px" height="120px">
                    <br>
                </span>
                <span class="login100-form-title" style="color:black">
                    SIAKAD REGISTER
                </span>
                <div class="row">
                    <div class="col-md-6">
                        <div class="wrap-input100 validate-input" data-validate="id_status">
                            <input id="id_status" type="number" class="input100 form-control @error('id_status') is-invalid @enderror" name="id_status" value="{{ old('id_status') }}" required autocomplete="id_status" autofocus placeholder="Masukan NISN">
                            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                            @error('id_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="name">
                            <input id="nama" type="text" class="input100 form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus placeholder="Masukan Nama Lengkap">
                            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="username">
                            <input id="username" type="text" class="input100 form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Masukan Nama">
                            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="wrap-input100 validate-input" data-validate="email">
                            <input id="email" type="email" class="input100 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukan Email">
                            <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input id="password" type="password" class="input100 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Masukan Password">
                            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input id="password-confirm" type="password" class="input100 form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
                            <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                        </div>
                    </div>
                </div>
                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn">
                        Register
                    </button>
                </div>
                <br>
                <div class="container-login100-form-btn m-t-32">
                    <a href="{{ route('login') }}" class="text-center">Sudah punya akun?</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="dropDownSelect1"></div>
<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

