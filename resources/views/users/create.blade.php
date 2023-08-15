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
                                                <label for="first_name" class="ul-form__label">First Name:</label>
                                                <input type="text"  name="first_name" id="first_name" placeholder="Enter full name" required class="form-control">
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your first name
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="last_name" class="ul-form__label">Last Name:</label>
                                                <input type="text" name="last_name" id="last_name" placeholder="Enter full name" required class="form-control">
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your last name
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="contact_number" class="ul-form__label">Contact Number:</label>
                                                <input type="text" class="form-control" id="contact_number" placeholder="Enter Contact Number" required class="form-control">
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your contact number
                                                </small>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="username" class="ul-form__label">Username:</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-text bg-transparent input-group-prepend">
                                                        <i class="i-Checked-User"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="username" placeholder="Username" required class="form-control">
                                                </div>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your username
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="email" class="ul-form__label">Email:</label>
                                                <input type="email" class="form-control" id="email" placeholder="Enter your email" required class="form-control">
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your Email
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="password" class="ul-form__label">Password:</label>
                                                <input type="text" class="form-control" id="password" placeholder="Enter your Password" required class="form-control">
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your Password
                                                </small>
                                            </div>
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

                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your address
                                                </small>
                                        </div>

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
                                            <div class="form-group col-md-4 ">
                                                <label for="status" class="ul-form__label">Status:</label>
                                                <div class="ul-form__radio-inline">
                                                    <label class=" ul-radio__position radio radio-primary form-check-inline">
                                                        <input type="radio" name="radio" value="0" id="status" required class="form-control">
                                                        <span class="ul-form__radio-font">Active</span>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="ul-radio__position radio radio-primary">
                                                        <input type="radio" name="radio" value="1" id="status" class="form-control">
                                                        <span class="ul-form__radio-font">In Active</span>
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
                                                    <a href="{{ route('user.index')}}"><button type="submit" class="btn  btn-primary m-1">Submit</button></a>
                                                    <button type="cancel" class="btn btn-outline-secondary m-1">Cancel</button>
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
