<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Register</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/css/themes/lite-purple.min.css') }}">
</head>

<body>
    <div class="auth-layout-wrap" style="background-image: url({{ asset('upload/logo/7.png') }})">
        <div class="auth-content">
            <div class="card o-hidden">
                <div class="row">
                    <div class="col-md-6 text-center "
                        style="background-size: cover;background-image: url({{ asset('assets/images/photo-long-3.jpg') }})">
                        <div class="ps-3 auth-right">
                            <div class="auth-logo text-center mt-4">
                                <img src="{{ asset('upload/logo/3.png') }}" alt="">
                            </div>
                            <div class="flex-grow-1"></div>
                            <div class="w-100 mb-4">
                                <a class="btn btn-outline-primary btn-outline-email w-100 btn-icon-text btn-rounded"
                                    href="signin.html">
                                    <i class="i-Mail-with-At-Sign"></i> Sign in with Email
                                </a>
                                <a
                                    class="btn btn-outline-primary btn-outline-google w-100 btn-icon-text btn-rounded my-3">
                                    <i class="i-Google-Plus"></i> Sign in with Google
                                </a>
                                <a class="btn btn-outline-primary btn-outline-facebook w-100 btn-icon-text btn-rounded">
                                    <i class="i-Facebook-2"></i> Sign in with Facebook
                                </a>
                            </div>
                            <div class="flex-grow-1"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-4">

                            <h1 class="mb-3 text-18">Sign Up</h1>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Your name</label>
                                    <input id="name" type="text"
                                        class="form-control-rounded form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name"
                                        autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input id="email" type="email"
                                        class="form-control-rounded form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password"
                                        class="form-control-rounded form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="repassword">Retype password</label>
                                    <input id="password-confirm" type="password"
                                        class="form-control-rounded form-control" name="password_confirmation" required
                                        autocomplete="new-password">
                                </div>
                                {{-- <div class="form-group col-md-6 ">
                                    <label for="inputEmail18" class="ul-form__label">Select Your Type:</label>
                                    <div class="ul-form__radio-inline">
                                        <label class=" ul-radio__position radio radio-primary form-check-inline">
                                            <input type="radio" name="role" value="Vendor">
                                            <span class="ul-form__radio-font">Vendor</span>
                                            <span class="checkmark" style="color: red" > @error('postcode'){{ $message }}@enderror</span>
                                        </label>
                                        <label class="ul-radio__position radio radio-primary">
                                            <input type="radio" name="role" value="Customer">
                                            <span class="ul-form__radio-font">Customer</span>
                                            <span class="checkmark" style="color: red">@error('postcode'){{ $message }}@enderror</span>
                                        </label>
                                    </div>
                                    
                                </div> --}}
                                <button type="submit" class="btn btn-outline-secondary w-100 btn-rounded mt-3 mb-3">Sign
                                    Up</button> <br>
                                <u>Already Have a Account </u>
                                <a href="{{ route('login') }}" class="">
                                    <i class="i-Mail-with-At-Sign"></i> Login Here
                                </a>
                                
                                <div class="mt-3">
                                    <p>After signing up, please check your email for a verification link to confirm your email address.</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/common-bundle-script.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
