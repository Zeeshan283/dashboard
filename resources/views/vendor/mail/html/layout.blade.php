{{-- <!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>

    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    {{ $header ?? '' }}

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0"
                            style="border: hidden !important;">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                                role="presentation">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell">
                                        {{ Illuminate\Mail\Markdown::parse($slot) }}

                                        {{ $subcopy ?? '' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{ $footer ?? '' }}
                </table>
            </td>
        </tr>
    </table>
</body>

</html> --}}


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Industry Mall</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link id="gull-theme" rel="stylesheet" href="{{ asset('assets\fonts\iconsmind\iconsmind.css') }}">
    <link id="gull-theme" rel="stylesheet" href="{{ asset('assets/styles/css/themes/lite-purple.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-free-5.10.1-web/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/metisMenu.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">

    <!-- <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}"> -->
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha384-GLhlTQ8iUN+eaT8e2SpVvL+PzzdA+P3hL9g5yyz9L3gfvvZ5voKVMIbS5gTKL4Rb" crossorigin="anonymous">

    <style>
        .td-container {
            width: 650px;
            min-width: 650px;
            font-size: 0pt;
            line-height: 0pt;
            margin: 0;
            font-weight: normal;
            padding: 55px 0px;
            display: table-cell;
            vertical-align: inherit;
            border-radius: 55px;
        }

        .card {
            border-collapse: separate;
            text-indent: initial;
            border-spacing: 2px;
            align-content: center;
        }

        .social-icons-container {
            display: flex;
            align-items: center;
        }

        .icon-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f8f9fa;
            /* light gray background color */
            margin: 5px;
            /* Adjust the margin as needed */
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .icon-button:hover {
            background-color: #007bff;
            /* blue background color on hover */
            color: #ffffff;
            /* white text color on hover */
        }

        .text-gray {
            color: #6c757d;
            /* gray text color */
            margin-left: 10px;
            /* Adjust the margin as needed */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-lg-8">
                <!-- <p flex-2><img src="{{ asset('upload/logo/3.png') }}" alt="logo" width="80px"> Hi! Saliha <span>INDUSTRY MALL</span></p> -->
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        {{-- <img src="{{ asset('upload/logo/3.png') }}" alt="logo" width="80px"> --}}
                    </div>
                    <div class="text-center">
                        <p>

                        </p>
                    </div>
                    <div class="text-right">

                    </div>
                </div>
                <p
                    style="position: relative;
                    line-height: 1.5em; margin-top: 20px; text-align: center; font-size: 40px;">
                    Welcome to <br><img src="{{ asset('upload/logo/16.jpg') }}" alt="logo" width="300px"></p>
                <p class="text-center">Leading E-Commerce Marketplace for Industrial Needs</p>


                <p>
                    {{-- style="position: relative;
                    line-height: 1.5em; margin-top: 20px; text-align: center; font-size: 40px;">
                    <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1">
                        Verify Your Email</button> --}}
                    {{ $subcopy ?? '' }}
                </p>


                <p justify-content-justify>Industry Mall is an E-Commerce Marketplace where suppliers can create their
                    own online store & company profile too. In this way, they can
                    describe more information about their company and create their own portfolio, tell customers about
                    their success story. Moreover, suppliers
                    can show their company registration certificates and achievement awards and mention a lot of
                    services.
                    In this way, each buyer can visit the ‘supplier’s profile’ page and get more knowledge about their
                    vendor and see their factory, store, and
                    productions and real-time pictures as well. It increases more trust level on the buyer.
                </p>
                <br><br>
                <div class="d-flex
                    justify-content-center align-items-center">
                    <img src="{{ asset('upload/logo/13.png') }}" border="0" width="100px" height="50px"
                        alt="" class="mx-2">
                    <img src="{{ asset('upload/logo/15.png') }}" border="0" width="100px" height="50px"
                        alt="" class="mx-2">
                </div>
                <br>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('upload/logo/12.png') }}" border="0" width="100px" height="auto"
                        alt="" class="mx-2">&nbsp; &nbsp;
                    <img src="{{ asset('upload/logo/14.png') }}" border="0" width="100px" height="auto"
                        alt="" class="mx-2">

                </div>
                <h6 class="text-center text-gray">Contact Us<br>
                    Industry Mall<br>Email: Industrymall.net@gmail.com<br>
                    <b>©</b> 2023-24 INDUSTRY MALL ®All rights reserved. |<a href="#"
                        style="color: #007bff; text-decoration: underline;"></a>
            </div>
        </div>
    </div>
</body>

</html>
