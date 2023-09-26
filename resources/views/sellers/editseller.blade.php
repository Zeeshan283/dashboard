@extends('layouts.master')
@section('before-css')

<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@section('page-css')
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">

@endsection
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
                                <form action="{{ route('vendor.update', ['vendor' => $vendors->id]) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <div class="card-body">

                                        <div class="row">
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
                                                <label for="inputEmail12" class="ul-form__label">Contact Number:</label>
                                                <input type="text" class="form-control" id="inputEmail12" name="phonenumber"  placeholder="Enter Contact Number" value="{{ $vendors->phone1}} " autofocus>
                                                <span style="color: red">@error('phonenumber'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your contact number
                                                </small>
                                            </div>

                                            
                                            <div class="form-group col-md-4">
                                                <label for="inputtext14" class="ul-form__label">Email:</label>
                                                <input type="text" class="form-control" id="email" name="email"  placeholder="Enter your email " value=" {{ $vendors->email }} " autofocus>
                                                <span style="color: red">@error('email'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your Email
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
                                            

                                        <div class="custom-separator"></div>

                                        


                                    </div>

                                    <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn  btn-outline-secondary m-1">Update</button>
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
<script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
     @if ($errors->any())
    <script>
        toastr.error("{{ $errors->first() }}");
    </script>
    @endif
    {!! Toastr::message() !!}
@endsection

@section('page-js')


<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>

@endsection

@section('bottom-js')



<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection