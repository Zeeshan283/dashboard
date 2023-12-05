@extends('layouts.master')
@section('page-css')
    <!-- <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}"> -->
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection
@section('main-content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-GLhlTQ8iUN+eaT8e2SpVvL+PzzdA+P3hL9g5yyz9L3gfvvZ5voKVMIbS5gTKL4Rb" crossorigin="anonymous">

<style>
	.td-container{
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
    background-color: #f8f9fa; /* light gray background color */
    margin: 5px; /* Adjust the margin as needed */
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
  }

  .icon-button:hover {
    background-color: #007bff; /* blue background color on hover */
    color: #ffffff; /* white text color on hover */
  }

  .text-gray {
    color: #6c757d; /* gray text color */
    margin-left: 10px; /* Adjust the margin as needed */
  }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-lg-8">
                <!-- <p flex-2><img src="{{ asset('upload/logo/3.png') }}" alt="logo" width="80px"> Hi! Saliha <span>INDUSTRY MALL</span></p> -->
				<div class="d-flex justify-content-between align-items-center">
                    <div>
                        <img src="{{ asset('upload/logo/3.png') }}" alt="logo" width="80px">
                    </div>
                    <div class="text-center">
                        <p>Hi! Saliha</p>
                    </div>
                    <div class="text-right">
                        <span>INDUSTRY MALL</span>
                    </div>
                </div>
                    <p class="text-center" style="font-size: 40px;">Welcome to <br><img src="{{ asset('upload/logo/3a.jpg') }}" alt="logo" width="300px"></p>
                    <p class="text-center">Leading E-Commerce Marketplace for Industrial Needs</p>

                <td class="fluid-img" style="font-size:0pt; line-height:0pt; text-align: center">
                    <img src="{{ asset('upload/logo/11.jpg') }}" border="0" width="826" height="auto" alt="">
                </td>

                <p justify-content-justify>Industry Mall is an E-Commerce Marketplace where suppliers can create their own online store & company profile too. In this way, they can
                    describe more information about their company and create their own portfolio, tell customers about their success story. Moreover, suppliers
                    can show their company registration certificates and achievement awards and mention a lot of services.</p>

                <h3 class="text-center">Please click the button below to verify your email address</h3>
                <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"><a href="#">Verify Email</a></button>

                <p>In this way, each buyer can visit the ‘supplier’s profile’ page and get more knowledge about their vendor and see their factory, store, and
                    productions and real-time pictures as well. It increases more trust level on the buyer.
                </p>
				<img src="{{ asset('upload/logo/9.jpg') }}" border="0" width="826" height="auto" alt="">
<br><br>
				<div class="d-flex">
<img src="{{ asset('upload/logo/8.jpg') }}" border="0" width="512" height="auto" alt="">&nbsp; &nbsp;
<img src="{{ asset('upload/logo/10.jpeg') }}" border="0" width="300" height="auto" alt="">
</div>
<br><br>
<div class="d-flex justify-content-center align-items-center">
    <img src="{{ asset('upload/logo/13.png')}}" border="0" width="100px" height="50px" alt="" class="mx-2">
    <img src="{{ asset('upload/logo/15.png') }}" border="0" width="100px" height="50px" alt="" class="mx-2">
</div>
<br>
<div class="d-flex justify-content-center align-items-center">
<img src="{{ asset('upload/logo/12.png')}}" border="0" width="100px" height="auto" alt="" class="mx-2">&nbsp; &nbsp;
<img src="{{ asset('upload/logo/14.png') }}" border="0" width="100px" height="auto" alt="" class="mx-2"> <h6 class="text-gray">Follow us </h6>
<div class="social-icons-container">
<div class="icon-button" style="font-size: 20px;">
<i class="fab fa-linkedin"></i>
    </div>
  <div class="icon-button" style="font-size: 20px;">
    <i class="fab fa-facebook"></i>
  </div>
 
  <div class="icon-button" style="font-size: 20px;">
    <i class="fab fa-twitter"></i>
  </div>
  <div class="icon-button" style="font-size: 20px;">
    <i class="fab fa-instagram"></i>
  </div>
 
</div>
</div>
 <h6 class="text-center text-gray">Contact Us<br>
Industry Mall<br>Email: Industrymall.net@gmail.com<br>
 <b>©</b> 2023-24 INDUSTRY MALL ®All rights reserved. |<a href="#" style="color: #007bff; text-decoration: underline;">To UNSUBSCRIBE</a>
        </div>
    </div>
</div>	
@endsection
@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection