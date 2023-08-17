@extends('layouts.master')
@section('before-css')


@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Add New User</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Add New User</h3>
                                </div>
<<<<<<< HEAD:resources/views/users/create.blade.php
=======
                                <form action="{{ route('user.store')}}" method="POST">
                                    @csrf
                                    <div class="card-body">
>>>>>>> 67666940cf6d07ed67171f6aa75a585e7e3dc153:resources/views/users/adduser.blade.php

    {{-- <div class="row">
        <div class="col-md-12">
            @if($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif --}}
                                <form method="post" action="{{ route('user.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-4">
<<<<<<< HEAD:resources/views/users/create.blade.php
                                                <label for="first_name" class="ul-form__label">First Name:</label>
                                                <input type="text"  name="first_name" id="first_name" placeholder="Enter full name" required class="form-control">
=======
                                                <label for="inputtext11" class="ul-form__label">Username:</label>
                                                <input type="text" class="form-control" id="first_name" placeholder="Enter full name" name="name" required>
>>>>>>> 67666940cf6d07ed67171f6aa75a585e7e3dc153:resources/views/users/adduser.blade.php
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your  name
                                                </small>
                                            </div>
    
                                            <div class="form-group col-md-4">
<<<<<<< HEAD:resources/views/users/create.blade.php
                                                <label for="last_name" class="ul-form__label">Last Name:</label>
                                                <input type="text" name="last_name" id="last_name" placeholder="Enter full name" required class="form-control">
=======
                                                <label for="inputtext11" class="ul-form__label">Email:</label>
                                                <input type="email" class="form-control" id="first_name" placeholder="Enter your Email" name="email" required>
>>>>>>> 67666940cf6d07ed67171f6aa75a585e7e3dc153:resources/views/users/adduser.blade.php
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your  Email
                                                </small>
                                            </div>
    
                                            <div class="form-group col-md-4">
<<<<<<< HEAD:resources/views/users/create.blade.php
                                                <label for="contact_number" class="ul-form__label">Contact Number:</label>
                                                <input type="text" class="form-control" id="contact_number" placeholder="Enter Contact Number" required class="form-control">
=======
                                                <label for="inputEmail12" class="ul-form__label">Contact Number:</label>
                                                <input type="number" class="form-control" id="inputEmail12" placeholder="Enter Contact Number" name="phone1" required>
>>>>>>> 67666940cf6d07ed67171f6aa75a585e7e3dc153:resources/views/users/adduser.blade.php
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your contact number
                                                </small>
                                            </div>

                                            <div class="form-group col-md-4">
<<<<<<< HEAD:resources/views/users/create.blade.php
                                                <label for="username" class="ul-form__label">Username:</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-text bg-transparent input-group-prepend">
                                                        <i class="i-Checked-User"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="username" placeholder="Username" required class="form-control">
                                                </div>
=======
                                                <label for="inputEmail12" class="ul-form__label">Pakistan:</label>
                                                <input type="text" class="form-control" id="inputEmail12" placeholder="Enter Your Country" name="country" required>
>>>>>>> 67666940cf6d07ed67171f6aa75a585e7e3dc153:resources/views/users/adduser.blade.php
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your country
                                                </small>
                                            </div>

                                            <div class="form-group col-md-4">
<<<<<<< HEAD:resources/views/users/create.blade.php
                                                <label for="email" class="ul-form__label">Email:</label>
                                                <input type="email" class="form-control" id="email" placeholder="Enter your email" required class="form-control">
=======
                                                <label for="inputEmail12" class="ul-form__label">City:</label>
                                                <input type="text" class="form-control" id="inputEmail12" placeholder="Enter your city" name="city" required>
>>>>>>> 67666940cf6d07ed67171f6aa75a585e7e3dc153:resources/views/users/adduser.blade.php
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your city
                                                </small>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Address:</label>
                                                <input type="text" class="form-control" id="inputEmail12" placeholder="Enter your address" name="address1" required>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your Address
                                                </small>
                                            </div>


                                            
                                            <div class="form-group col-md-4">
<<<<<<< HEAD:resources/views/users/create.blade.php
                                                <label for="password" class="ul-form__label">Password:</label>
                                                <input type="text" class="form-control" id="password" placeholder="Enter your Password" required class="form-control">
=======
                                                <label for="inputtext14" class="ul-form__label">Password:</label>
                                                <input type="text" class="form-control" id="password" placeholder="Enter your Password " name="password" required>
>>>>>>> 67666940cf6d07ed67171f6aa75a585e7e3dc153:resources/views/users/adduser.blade.php
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your Password
                                                </small>
                                            </div>
<<<<<<< HEAD:resources/views/users/create.blade.php
                                            <div class="form-group col-md-4">
                                                <label for="confirm_password" class="ul-form__label">Confirm Password:</label>
                                                <input type="text" class="form-control" id="confirm_password" placeholder="Enter your confirme Password" required class="form-control">
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Confirm Password
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="address" class="ul-form__label">Address:</label>
                                                <div class="input-right-icon">
                                                    <input type="text" class="form-control" id="address" placeholder="Enter your address">
                                                    <span class="span-right-input-icon">
                                                        <i class="ul-form__icon i-Map-Marker"></i>
                                                    </span>
                                                </div>
=======
>>>>>>> 67666940cf6d07ed67171f6aa75a585e7e3dc153:resources/views/users/adduser.blade.php


<<<<<<< HEAD:resources/views/users/create.blade.php
                                        <div class="custom-separator"></div>

                                        <div class="row">
                                            <div class="form-group col-md-4 me-2">
                                                <label for="zipcode" class="ul-form__label">Zipcode:</label>
                                                <div class="input-right-icon">
                                                    <input type="text" class="form-control" id="zipcode" placeholder="Enter your postcode" required class="form-control">
                                                    <span class="span-right-input-icon">
                                                        <i class="ul-form__icon i-New-Mail"></i>
                                                    </span>
                                                </div>

                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your postcode
                                                </small>
                                            </div>
=======
>>>>>>> 67666940cf6d07ed67171f6aa75a585e7e3dc153:resources/views/users/adduser.blade.php
                                            <div class="form-group col-md-4 ">
                                                <label for="status" class="ul-form__label">Status:</label>
                                                <div class="ul-form__radio-inline">
                                                    <label class=" ul-radio__position radio radio-primary form-check-inline">
<<<<<<< HEAD:resources/views/users/create.blade.php
                                                        <input type="radio" name="radio" value="0" id="status" required class="form-control">
                                                        <span class="ul-form__radio-font">Active</span>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="ul-radio__position radio radio-primary">
                                                        <input type="radio" name="radio" value="1" id="status" class="form-control">
                                                        <span class="ul-form__radio-font">In Active</span>
=======
                                                        <input type="radio" name="gender" value="male">
                                                        <span class="ul-form__radio-font">Male</span>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="ul-radio__position radio radio-primary">
                                                        <input type="radio" name="gender" value="Female">
                                                        <span class="ul-form__radio-font">Female</span>
>>>>>>> 67666940cf6d07ed67171f6aa75a585e7e3dc153:resources/views/users/adduser.blade.php
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Select Your Status
                                                </small>
                                            </div>

                                        </div>


                                    </div>

                                    <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
<<<<<<< HEAD:resources/views/users/create.blade.php
                                                    <a href="{{ route('user.index')}}"><button type="submit" class="btn  btn-primary m-1">Submit</button></a>
                                                    <button type="cancel" class="btn btn-outline-secondary m-1">Cancel</button>
=======
                                                    <button type="submit" class="btn  btn-primary m-1">Save</button>
                                                    <button type="button" class="btn btn-outline-secondary m-1">Cancel</button>
>>>>>>> 67666940cf6d07ed67171f6aa75a585e7e3dc153:resources/views/users/adduser.blade.php
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('page-js')




@endsection

@section('bottom-js')




@endsection
