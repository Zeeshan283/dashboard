@extends('layouts.master')
@section('before-css')


@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Add New Vendor</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Add New Vendor</h3>
                                </div>
                                <form action="">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">First Name:</label>
                                                <input type="text" class="form-control" id="first_name" placeholder="Enter full name">
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your first name
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Last Name:</label>
                                                <input type="text" class="form-control" id="last_name" placeholder="Enter full name">
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your last name
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Contact Number:</label>
                                                <input type="text" class="form-control" id="inputEmail12" placeholder="Enter Contact Number">
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your contact number
                                                </small>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail13" class="ul-form__label">Username:</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-text bg-transparent input-group-prepend">
                                                        <i class="i-Checked-User"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                                                </div>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your username
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputtext14" class="ul-form__label">Email:</label>
                                                <input type="text" class="form-control" id="email" placeholder="Enter your email ">
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your Email
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail16" class="ul-form__label">Address:</label>
                                                <div class="input-right-icon">
                                                    <input type="text" class="form-control" id="inputEmail16" placeholder="Enter your address">
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
                                                <label for="inputEmail17" class="ul-form__label">Postcode:</label>
                                                <div class="input-right-icon">
                                                    <input type="text" class="form-control" id="inputEmail17" placeholder="Enter your postcode">
                                                    <span class="span-right-input-icon">
                                                        <i class="ul-form__icon i-New-Mail"></i>
                                                    </span>
                                                </div>

                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your postcode
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4 ">
                                                <label for="inputEmail18" class="ul-form__label">Status:</label>
                                                <div class="ul-form__radio-inline">
                                                    <label class=" ul-radio__position radio radio-primary form-check-inline">
                                                        <input type="radio" name="radio" value="0">
                                                        <span class="ul-form__radio-font">Active</span>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="ul-radio__position radio radio-primary">
                                                        <input type="radio" name="radio" value="0">
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
                                                    <button type="button" class="btn  btn-primary m-1">Save</button>
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
