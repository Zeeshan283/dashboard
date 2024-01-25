{{--@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
--}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Login</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/css/themes/lite-purple.min.css') }}">
    <style>
    .password-input-container {
        position: relative;
    }

    .eye-icon {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 1.2em;
    }


    .eye-icon::before {
        content: '\1F441';
        /* Unicode for eye icon */
        color: #aaa;
    }

    #password[type="password"]+.eye-icon::before {
        content: '\1F441';
        /* Unicode for closed eye icon */
    }

    #password[type="text"]+.eye-icon::before {
        content: '\1F440';
        /* Unicode for open eye icon */
    }
    </style>
</head>

<body>
    <div class="auth-layout-wrap" style="background-image: url({{ asset('upload/logo/7.png') }})">
        <div class="auth-content">
            <div class="card o-hidden">
                <div class="row">
                    <div class="col-md-6">
                        <div class="p-4">
                            <div class="auth-logo text-center mb-4">
                                <img src="{{ asset('upload/logo/3.png') }}" alt="">
                            </div>
                            <h1 class="mb-3 text-18">Forgot Password  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <h6>We have emailed your password reset link!</h6>
                        </div>
                    @endif</h1>
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                        
                              


                                <button type="submit" class="btn btn-rounded btn-outline-secondary w-100 mt-2">Send Password Reset Link</button>

                            </form>
                            <div class="mt-3 text-center">
                                <a class="text-muted" href="{{ route('login') }}"> <u>Sign in</u></a>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center "
                        style="background-size: cover;background-image: url({{ asset('assets/images/photo-long-3.jpg') }}">
                        <div class="pe-3 auth-right">
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="btn btn-rounded btn-outline-primary btn-outline-email w-100 btn-icon-text">
                                <i class="i-Mail-with-At-Sign"></i> Sign up with Email
                            </a>
                            @endif
                            <a class="btn btn-rounded btn-outline-primary btn-outline-google w-100 btn-icon-text">
                                <i class="i-Google-Plus"></i> Sign up with Google
                            </a>
                            <a class="btn btn-rounded btn-outline-primary w-100 btn-icon-text btn-outline-facebook">
                                <i class="i-Facebook-2"></i> Sign up with Facebook
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
