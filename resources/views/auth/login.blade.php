<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Login</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/css/themes/lite-purple.min.css') }}">
    <link rel="icon" href="{{ asset('upload/logo/logo.png') }}" type="image/x-icon">
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
                            <h1 class="mb-3 text-18">Sign In</h1>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input id="email"
                                        class="form-control form-control-rounded @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password"
                                        class="form-control form-control-rounded @error('password') is-invalid @enderror"
                                        name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> -->

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="password-input-container">
                                        <input id="password" type="password"
                                            class="form-control form-control-rounded @error('password') is-invalid @enderror"
                                            name="password" required />
                                        <span toggle="#password" class="eye-icon"></span>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>

                                <button class="btn btn-rounded btn-outline-secondary w-100 mt-2">Sign In</button>

                            </form>
                            @if (Route::has('password.request'))
                            <div class="mt-3 text-center">

                                <a href="{{ route('password.request') }}" class="text-muted">
                                    <u>Forgot Password?</u></a><br>
                                <u>Don't have a account</u>
                                <a href="{{ route('register') }}">
                                    <i class="i-Mail-with-At-Sign"></i> Sign up
                                </a>
                            </div>
                            @endif
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
                            <a href="{{ route('login.google') }}" class="btn btn-rounded btn-outline-primary btn-outline-google w-100 btn-icon-text">
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

    <script src="{{ asset('assets/js/common-bundle-script.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.querySelector('.eye-icon');

        eyeIcon.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        });
    });
    </script>

</body>

</html>