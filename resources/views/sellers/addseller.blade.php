@extends('layouts.master')
@section('before-css')
{{-- css link sheet  --}}
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@section('page-css')
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Add New Supplier</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Add New Supplier</h3>
                                </div>
                                <form action="{{ route('vendor.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="inputtext11" class="ul-form__label">First Name:</label>
                                                <input type="text" class="form-control" id="first_name"  name="first_name"  placeholder="Enter full name" value="{{ old ('firstname')}}">
                                                <span style="color: red">@error('first_name'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your first name
                                                </small>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="inputtext11" class="ul-form__label">Last Name:</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name"  placeholder="Enter full name" value="{{ old ('lastname')}}">
                                                <span style="color: red">@error('last_name'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your last name
                                                </small>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="inputEmail12" class="ul-form__label">Contact Number:</label>
                                                <input type="number" class="form-control" id="inputEmail12" name="phone1"  placeholder="Enter Contact Number"value="{{ old ('phonenumber')}}">
                                                <span style="color: red">@error('phonenumber'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your contact number
                                                </small>
                                            </div>

                                            
                                            <div class="form-group col-md-6">
                                                <label for="inputtext14" class="ul-form__label">Email:</label>
                                                <input type="email" class="form-control" id="email" name="email"  placeholder="Enter your email " value="{{ old ('email')}}">
                                                <span style="color: red">@error('email'){{ $message }}@enderror</span>
                                                
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your Email
                                                </small>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail16" class="ul-form__label">Password:</label>
                                                <div class="input-right-icon">
                                                    <input type="password" class="form-control" id="inputEmail16"  name="password"  placeholder="Enter your address" value="{{ old ('address')}}">
                                                    <span class="span-right-input-icon" style="color: red">@error('password'){{ $message }}@enderror
                                                        <!-- <i class="ul-form__icon i-Map-Marker"></i> -->
                                                    </span>
                                                </div>

                                    </div>

                                  
                                            

                                            {{-- status hide for fun  --}}
                                            <div class="form-group col-md-6 ">
                                                <label for="inputEmail18" class="ul-form__label">Status:</label>
                                                <div class="ul-form__radio-inline">
                                                    <label class=" ul-radio__position radio radio-primary form-check-inline">
                                                        <input type="radio" name="radio" value="0">
                                                        <span class="ul-form__radio-font"> Active</span>
                                                        <span class="checkmark" style="color: red" > @error('postcode'){{ $message }}@enderror</span>
                                                    </label>
                                                    <label class="ul-radio__position radio radio-primary">
                                                        <input type="radio" name="radio" value="1">
                                                        <span class="ul-form__radio-font">In Active</span>
                                                        <span class="checkmark" style="color: red">@error('postcode'){{ $message }}@enderror</span>
                                                    </label>
                                                </div>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Select Your Status
                                                </small>
                                            </div>

                                        

                                    </div>

                                    <div class="card-footer">
                                        <div class="mc-footer">
                                               <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn  btn-outline-secondary m-1">Save</button>
                                                    <!-- <button type="button" class="btn btn-outline-secondary m-1">Cancel</button> -->
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

@section('bottom-js')
    <script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>


<script src="{{asset('assets/js/smart.wizard.script.js')}}"></script>
<script src="{{asset('assets/js/quill.script.js')}}"></script>


@endsection