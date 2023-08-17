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
                                <form action="{{ route('user.store')}}" method="POST">
                                    @csrf
                                    <div class="card-body">

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
                                                <label for="inputtext11" class="ul-form__label">Username:</label>
                                                <input type="text" class="form-control" id="first_name" placeholder="Enter full name" name="name" required>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your  name
                                                </small>
                                            </div>
    
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Email:</label>
                                                <input type="email" class="form-control" id="first_name" placeholder="Enter your Email" name="email" required>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your  Email
                                                </small>
                                            </div>
    
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Contact Number:</label>
                                                <input type="number" class="form-control" id="inputEmail12" placeholder="Enter Contact Number" name="phone1" required>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your contact number
                                                </small>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Country:</label>
                                                <input type="text" class="form-control" id="inputEmail12" placeholder="Enter Your Country" name="country" required>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your country
                                                </small>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">City:</label>
                                                <input type="text" class="form-control" id="inputEmail12" placeholder="Enter your city" name="city" required>
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
                                                <label for="inputtext14" class="ul-form__label">Password:</label>
                                                <input type="text" class="form-control" id="password" placeholder="Enter your Password " name="password" required>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your Password
                                                </small>
                                            </div>


                                            <div class="form-group col-md-4 ">
                                                <label for="status" class="ul-form__label">Status:</label>
                                                <div class="ul-form__radio-inline">
                                                    <label class=" ul-radio__position radio radio-primary form-check-inline">
                                                        <input type="radio" name="gender" value="male">
                                                        <span class="ul-form__radio-font">Male</span>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="ul-radio__position radio radio-primary">
                                                        <input type="radio" name="gender" value="Female">
                                                        <span class="ul-form__radio-font">Female</span>
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
                                                    <button type="submit" class="btn  btn-primary m-1">Save</button>
                                                    <button type="button" class="btn btn-outline-secondary m-1">Cancel</button>
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
