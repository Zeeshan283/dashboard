@extends('layouts.master')
@section('page-css')
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
            width: 280px;
        }

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 3px solid #f1f1f1;
            z-index: 9;
            background-color: #fff;
            /* Form background color */
            padding: 1px;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text],
        .form-container input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus,
        .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        .form-container .cancel {
            background-color: red;
        }

        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }
    </style>
@endsection



@section('main-content')
    <div class="main-content">

        <div class="breadcrumb">
            <h1>Product Details</h1>
            <ul>
                <li><a href="">Apps</a></li>
                <li>Ecommerce</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        <!-- content goes here -->

        <section class="ul-product-detail">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="ul-product-detail__image">
                                        <img src="/{{ $data->image }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="ul-product-detail__brand-name mb-4">
                                        <h5 class="heading">{{ $data->name }}</h5>
                                    </div>

                                    <div class="ul-product-detail__price-and-rating d-flex align-items-baseline">
                                        <h3 class="font-weight-700 text-primary mb-0 mr-2">${{ $data->sale_price }}</h3>
                                        <span
                                            class="text-mute font-weight-800 mr-2"><del>${{ $data->old_price }}</del></span>
                                        @php
                                            $percentage = (($data->old_price - $data->sale_price) / $data->old_price) * 100;
                                        @endphp
                                        <small class="text-success font-weight-700">{{ number_format($percentage, 2) }}%
                                            off</small>
                                    </div>

                                    <!-- <div class="ul-product-detail__rating">
                                                                                                                                                                                                                                        <ul>
                                                                                                                                                                                                                                            <li></li>
                                                                                                                                                                                                                                        </ul>
                                                                                                                                                                                                                                    </div> -->
                                    <div class="ul-product-detail__features mt-3">
                                        <h6 class=" font-weight-700">Description:</h6>
                                        <ul class="m-0 p-0">
                                            <li>
                                                <i class="i-Right1 text-primary text-15 align-middle font-weight-700"> </i>
                                                <span class="align-middle">This Banner display for {{ $data->days }}
                                                    days</span>
                                            </li>
                                            <li>
                                                <i class="i-Right1 text-primary text-15 align-middle font-weight-700"> </i>
                                                @if ($data->quantity > 0)
                                                    <span class="align-middle"
                                                        style="color: #099909fa;font: -webkit-control;">Available</span>
                                                @else
                                                    <span class="align-middle" style="color: red;font: -webkit-control;">Not
                                                        Available</span>
                                                @endif
                                            </li>

                                            <li>
                                                <i class="i-Right1 text-primary text-15 align-middle font-weight-700"> </i>
                                                <span class="align-middle">Image Dimention
                                                    {{ $data->imageDimention }}</span>
                                            </li>

                                        </ul>
                                    </div>

                                    <div class="ul-product-detail__quantity d-flex align-items-center mt-3">
                                        @if ($data->quantity > 0)
                                            <button type="button" class="btn btn-primary m-1" onclick="openForm()">
                                                <i class="i-Full-Cart text-15"> </i>
                                                Buy Now</button>
                                        @else
                                            <button type="button" class="btn btn-primary m-1" disabled>
                                                <i class="i-Full-Cart text-15"> </i>
                                                Buy Now</button>
                                        @endif

                                        {{-- @if ($data->quantity > 0)
                                            <button id="cartEffect" onclick="openForm()"
                                                class="btn cart-btn btn-normal tooltip-top"
                                                data-tippy-content="Add to cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Buy Now
                                            </button>
                                        @else
                                            <button id="cartEffect" class="btn cart-btn btn-normal tooltip-top"
                                                data-tippy-content="Add to cart" disabled>
                                                <i class="fa fa-shopping-cart"></i>
                                                Buy Now
                                            </button>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ul-product-detail__box">
            <div class="row">
                <div class="col-lg-3 col-md-3 mt-4 text-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="ul-product-detail__border-box">
                                <div class="ul-product-detail--icon mb-2">
                                    <i class="i-Car text-success text-25 font-weight-500 "></i>
                                </div>
                                <h5 class="heading">Quick Responce</h5>
                                <p class="text-muted text-12">Instant purchase gratification: seamless, secure, and swift
                                    acquisition of your desired products online.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 mt-4 text-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="ul-product-detail__border-box">
                                <div class="ul-product-detail--icon mb-2">
                                    <i class="i-Reload text-danger text-25 font-weight-500 "></i>
                                </div>
                                <h5 class="heading">Display Banner {{ $data->days }} Days</h5>
                                <p class="text-muted text-12">Exclusive {{ $data->days }}-day showcase: Elevate your brand
                                    with a limited-time, captivating display banner.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 mt-4 text-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="ul-product-detail__border-box">
                                <div class="ul-product-detail--icon mb-2">
                                    <i class="i-Headset text-info text-25 font-weight-500"></i>
                                </div>
                                <h5 class="heading">Support 24/7</h5>
                                <p class="text-muted text-12">Reliable support, around the clock: 24/7 assistance for your
                                    peace of mind.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 mt-4 text-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="ul-product-detail__border-box">
                                <div class="ul-product-detail--icon mb-2">
                                    <i class="i-Money-Bag text-warning text-25 font-weight-500"></i>
                                </div>
                                <h5 class="heading">High Secure Payment</h5>
                                <p class="text-muted text-12">Fortified transactions: Experience high-security payments for
                                    peace of mind in every purchase.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ul-product-detail__tab">
            <div class="row">
                <div class="col-lg-12 col-md-12 mt-4">
                    <div class="card mt-2 mb-4 ">
                        <div class="card-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link show" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                        role="tab" aria-controls="nav-home" aria-selected="true">Details</a>
                                    {{-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                        role="tab" aria-controls="nav-profile" aria-selected="false">Reviews</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                                        role="tab" aria-controls="nav-contact" aria-selected="false">Customize
                                        Tab</a>
                                    <a class="nav-item nav-link" id="nav-brand-tab" data-toggle="tab" href="#nav-brand"
                                        role="tab" aria-controls="nav-contact" aria-selected="false">About Brand</a> --}}
                                </div>
                            </nav>
                            <div class="tab-content ul-tab__content p-5" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <img src="/{{ $data->image }}" alt="">
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <h5 class="text-uppercase font-weight-700 text-muted mt-4 mb-2">
                                            </h5>
                                            <p>
                                                <?php echo $data->details; ?>
                                            </p>

                                            <div class="ul-product-detail__nested-card">
                                                <div class="row text-center">
                                                    <div class="col-lg-4 col-sm-12 mb-2">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="ul-product-detail__border-box">
                                                                    <div class="ul-product-detail--icon mb-2">
                                                                        <i
                                                                            class="i-Car text-success text-25 font-weight-500 "></i>
                                                                    </div>
                                                                    <h5 class="heading">Quick Responce</h5>
                                                                    <p class="text-muted text-12">Instant purchase
                                                                        gratification: seamless, secure, and swift
                                                                        acquisition of your desired products online.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12 mb-2">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="ul-product-detail__border-box">
                                                                    <div class="ul-product-detail--icon mb-2">
                                                                        <i
                                                                            class="i-Reload text-danger text-25 font-weight-500 "></i>
                                                                    </div>
                                                                    <h5 class="heading">Display Banner {{ $data->days }}
                                                                        Days</h5>
                                                                    <p class="text-muted text-12">Exclusive
                                                                        {{ $data->days }}-day showcase: Elevate your
                                                                        brand
                                                                        with a limited-time, captivating display banner.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12 mb-2">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="ul-product-detail__border-box">
                                                                    <div class="ul-product-detail--icon mb-2">
                                                                        <i
                                                                            class="i-Money-Bag text-warning text-25 font-weight-500"></i>
                                                                    </div>
                                                                    <h5 class="heading">High Secure Payment</h5>
                                                                    <p class="text-muted text-12">Fortified transactions:
                                                                        Experience high-security payments for
                                                                        peace of mind in every purchase.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">

                                </div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">

                                </div>
                                <div class="tab-pane fade" id="nav-brand" role="tabpanel"
                                    aria-labelledby="nav-contact-tab">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>
    <div class="form-popup" id="myForm">
        <div class="card">
            <div class="card-header">
                <h5>Checkout</h5>
            </div>
            <div class="card-body">
                <div class="digital-add needs-validation">
                    <form action="{{ URL::to('stripe1') }}" target="__BLANK" enctype="multipart/form-data">
                        <input type="hidden" value="{{ Auth::user()->id }}" name="customer_id">
                        <input type="hidden" value="{{ Auth::user()->email }}" name="customer_email">
                        <input type="hidden" value="{{ $data->id }}" name="product_id">
                        <input type="hidden" value="{{ $data->sale_price }}" name="bill">
                        <div class="form-group">
                            <label for="validationCustom05" class="col-form-label pt-0"> Name</label>
                            <input class="form-control" id="validationCustom05" name="name" type="text"
                                required="">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"> Phone</label>
                            <input class="form-control" id="validationCustom05" name="phone" type="number"
                                required="" maxlength="12" onkeypress ="return onlyNumberKey(event)">
                        </div>

                        <br>
                        <div class="form-group mb-0">
                            <div class="product-buttons text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-light" onclick="closeForm()">Discard</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        {{-- <form action="{{ URL::to('vendor/stripe1') }}" class="form-container">
                <input type="hidden" value="{{ Auth::user()->id }}" name="customer_id">
                <input type="hidden" value="{{ $data->id }}" name="product_id">
                <input type="hidden" value="{{ $data->sale_price }}" name="bill">
                <label for=""><b>Name</b></label>
                <input type="text" name="name">
                <label for=""><b>Phone</b></label>
                <input type="text" name="phone">

                <button type="submit" class="btn">Submit</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form> --}}
    </div>


    <script>
        function openForm() {
            document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
@endsection
@section('content')
    <div class="page-body">

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <div class="page-header-left">
                            <h3>Advertisement Management's
                                {{-- <small>Bigdeal Admin panel</small> --}}
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item"> Advertisements</li>
                            <li class="breadcrumb-item active">Advertisement Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->



        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="card">
                <div class="row product-page-main card-body">
                    <div class="col-xl-4">
                        <div class="product-slider owl-carousel owl-theme" id="sync1">
                            <div class="item">
                                <h4>Image Dim:({{ $data->imageDimention }})</h4>
                                <br>

                                <img src="/{{ $data->image }}" alt="na" class="blur-up lazyloaded"
                                    style="width: -webkit-fill-available;">
                            </div>

                        </div>

                    </div>
                    <div class="col-xl-8">
                        <div class="product-page-details product-right mb-0">
                            <div class="pro-group">

                                <h2>{{ $data->name }}</h2>
                                <ul class="pro-price">
                                    <li>${{ $data->sale_price }}</li>
                                    <li><span>{{ $data->old_price }}</span></li>
                                    @php
                                        $percentage = (($data->old_price - $data->sale_price) / $data->old_price) * 100;

                                    @endphp
                                    <li>{{ number_format($percentage, 2) }}% off</li>

                                </ul>
                                <div class="revieu-box">
                                    <ul>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                    <a href="review.html"><span>(6 reviews)</span></a>
                                </div>

                            </div>


                            <div class="pro-group">
                                <h6 class="product-title">Display Days</h6>
                                <ul class="delivery-services">

                                    <li>
                                        <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m410 0c8.285156 0 15 6.714844 15 15v199.027344c52.363281 26.195312 87 79.976562 87 140.722656 0 86.84375-70.40625 157.25-157.25 157.25-60.746094 0-114.527344-34.636719-140.722656-87h-199.027344c-8.285156 0-15-6.714844-15-15v-395c0-8.285156 6.714844-15 15-15zm-126 30v84.0625c0 10.785156-11.507812 19.085938-22.746094 12.84375l-48.753906-24.773438-49.761719 25.289063c-9.988281 5.058594-21.710937-2.324219-21.703125-13.359375l-.035156-84.0625h-111v365h172.703125c-14.519531-54.976562 1.808594-112.394531 40.855469-151.441406s96.464844-55.375 151.441406-40.855469v-172.703125zm23 391h69.996094c15.984375 0 30.488281-6.511719 40.988281-17.015625 11.039063-11.035156 17.015625-25.332031 17.015625-41.980469 0-31.96875-26.035156-58.003906-58.003906-58.003906h-41.683594l8.804688-8.820312c13.871093-13.953126-7.339844-35.042969-21.210938-21.09375l-34.402344 34.464843c-5.824218 5.855469-5.800781 15.328125.058594 21.152344l34.46875 34.402344c13.949219 13.871093 35.042969-7.339844 21.09375-21.210938l-8.914062-8.894531h41.785156c16.242187 0 28.003906 12.984375 28.003906 28.996094 0 15.40625-12.597656 28.003906-28.003906 28.003906h-69.996094c-8.285156 0-15 6.714844-15 15s6.714844 15 15 15zm-42.230469-156.230469c-49.691406 49.695313-49.691406 130.269531 0 179.960938 49.695313 49.695312 130.269531 49.695312 179.960938 0 49.695312-49.691407 49.695312-130.265625 0-179.960938-49.691407-49.691406-130.269531-49.691406-179.960938 0zm-10.769531-234.769531h-83v59.65625l34.726562-17.648438c4.097657-2.078124 9.09375-2.246093 13.511719-.019531l34.761719 17.667969zm0 0"
                                                fill-rule="evenodd" />
                                        </svg>
                                        {{ $data->days }} Days
                                    </li>

                                </ul>
                            </div>
                            <div id="selectSize"
                                class="pro-group addeffect-section product-description border-product mb-0">
                                <!--
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <h6 class="product-title">quantity</h6>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="qty-box">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="input-group">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <button class="qty-minus"></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <input class="qty-adj form-control" type="number" min="1" max="10" value="1" />
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <button class="qty-plus"></button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div> -->
                                <div class="product-buttons">
                                    <span action="">


                                        @if ($data->quantity > 0)
                                            <button id="cartEffect" onclick="openForm()"
                                                class="btn cart-btn btn-normal tooltip-top"
                                                data-tippy-content="Add to cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Buy Now
                                            </button>
                                        @else
                                            <button id="cartEffect" class="btn cart-btn btn-normal tooltip-top"
                                                data-tippy-content="Add to cart" disabled>
                                                <i class="fa fa-shopping-cart"></i>
                                                Buy Now
                                            </button>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="pro-group pb-0">
                                <h6 class="product-title">share</h6>
                                <ul class="product-social">
                                    <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="javascript:void(0)"><i class="fa fa-rss"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="mt-5">
                            <span><?php echo $data->details; ?></span>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
        <div class="form-popup" id="myForm">
            <div class="card">
                <div class="card-header">
                    <h5>Checkout</h5>
                </div>
                <div class="card-body">
                    <div class="digital-add needs-validation">
                        <form action="{{ URL::to('vendor/stripe1') }}" target="__BLANK" enctype="multipart/form-data">
                            <input type="hidden" value="{{ Auth::user()->id }}" name="customer_id">
                            <input type="hidden" value="{{ Auth::user()->email }}" name="customer_email">
                            <input type="hidden" value="{{ $data->id }}" name="product_id">
                            <input type="hidden" value="{{ $data->sale_price }}" name="bill">
                            <div class="form-group">
                                <label for="validationCustom05" class="col-form-label pt-0"> Name</label>
                                <input class="form-control" id="validationCustom05" name="name" type="text"
                                    required="">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"> Phone</label>
                                <input class="form-control" id="validationCustom05" name="phone" type="text"
                                    required="" maxlength="12" onkeypress ="return onlyNumberKey(event)">
                            </div>
                            {{-- <div class="form-group">
                                <label class="col-form-label"> Image</label>
                                <input class="form-control" id="imageshow" name="image" type="file"
                                    required="">
                                <img src="" width="100px" id="show_image" />
                            </div> --}}
                            <div class="form-group">
                                <label class="col-form-label"> Online Payment:</label>
                                <br>
                                <input class="radio_animated " id="validationCustom05" name="" type="radio"
                                    checked>
                            </div>
                            <div class="form-group mb-0">
                                <div class="product-buttons text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-light" onclick="closeForm()">Discard</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            {{-- <form action="{{ URL::to('vendor/stripe1') }}" class="form-container">
                <input type="hidden" value="{{ Auth::user()->id }}" name="customer_id">
                <input type="hidden" value="{{ $data->id }}" name="product_id">
                <input type="hidden" value="{{ $data->sale_price }}" name="bill">
                <label for=""><b>Name</b></label>
                <input type="text" name="name">
                <label for=""><b>Phone</b></label>
                <input type="text" name="phone">

                <button type="submit" class="btn">Submit</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form> --}}
        </div>


        <script>
            function openForm() {
                document.getElementById("myForm").style.display = "block";
            }

            function closeForm() {
                document.getElementById("myForm").style.display = "none";
            }
        </script>
    @endsection
