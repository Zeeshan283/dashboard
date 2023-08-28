@extends('layouts.master')
@section('before-css')


@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Update Vendor</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Update Vendor</h3>
                                </div>
                                <form action="{{ route('vendor.update') }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">First Name:</label>
                                                <input type="text" class="form-control" id="first_name"  name="firstname"  placeholder="Enter full name" value=" {{  $vendors ->first_name}}" autofocus>
                                                <span style="color: red">@error('firstname'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your first name
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Last Name:</label>
                                                <input type="text" class="form-control" id="last_name" name="lastname"  placeholder="Enter full name" value="{{ $vendors->last_name}} " autofocus>
                                                <span style="color: red">@error('lastname'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your last name
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Contact Number:</label>
                                                <input type="text" class="form-control" id="inputEmail12" name="phonenumber"  placeholder="Enter Contact Number" value="{{ $vendors->phone1}} " autofocus>
                                                <span style="color: red">@error('phonenumber'){{ $message }}@enderror</span>
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
                                                    <input type="text" class="form-control" id="inlineFormInputGroup" name="username"  placeholder="Username" value=" {{ $vendors->name }} " autofocus>
                                                </div>
                                                <span style="color: red">@error('username'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your username
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputtext14" class="ul-form__label">Email:</label>
                                                <input type="text" class="form-control" id="email" name="email"  placeholder="Enter your email " value=" {{ $vendors->email }} " autofocus>
                                                <span style="color: red">@error('email')@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your Email
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail16" class="ul-form__label">Address:</label>
                                                <div class="input-right-icon">
                                                    <input type="text" class="form-control" id="inputEmail16"  name="address"  placeholder="Enter your address" value=" {{ $vendors->addres }} " autofocus>
                                                    <span class="span-right-input-icon" style="color: red">@error('address'){{ $message }}@enderror
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
                                                    <input type="text" class="form-control" id="inputEmail17" name="postcode" placeholder="Enter your postcode" value=" {{ $vendors->zipcode }} " autofocus>
                                                    <span class="span-right-input-icon" style="color: red">@error('postcode'){{ $message }}@enderror
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
                                                        <span class="ul-form__radio-font"> Active</span>
                                                        <span class="checkmark" style="color: red" > @error('Active'){{ $message }}@enderror</span>
                                                    </label>
                                                    <label class="ul-radio__position radio radio-primary">
                                                        <input type="radio" name="radio" value="1">
                                                        <span class="ul-form__radio-font">In Active</span>
                                                        <span class="checkmark" style="color: red">@error('In_Active'){{ $message }}@enderror</span>
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
                                                    <button type="submit" class="btn  btn-primary m-1">Update</button>
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
