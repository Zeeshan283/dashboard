@extends('layouts.master')
@section('before-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Add Your Suppliers</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Add Your Suppliers</h3>
                                </div>
                                <form action="{{ route('supplier.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="inputtext11" class="ul-form__label">Supplier Name:</label>
                                                <input type="text" class="form-control" id="name"  name="name"  placeholder="Enter your supplier name" value="{{ old ('name')}}">
                                                <span style="color: red">@error('firstname'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your Supplier Name
                                                </small>
                                            </div>
                                    
                                            <div class="form-group col-lg-6">
                                                <label for="inputEmail12" class="ul-form__label">Supplier Contact Number:</label>
                                                <input type="number" class="form-control" id="phone" name="phone"  placeholder="Enter your supplier Contact Number"value="{{ old ('phone')}}">
                                                <span style="color: red">@error('phonenumber'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your supplier contact number
                                                </small>
                                            </div>

                                            
                                            
                                            <div class="form-group col-md-6">
                                                <label for="inputtext14" class="ul-form__label">Supplier Email:</label>
                                                <input type="email" class="form-control" id="email" name="email"  placeholder="Enter your supplier email " value="{{ old ('email')}}">
                                                <span style="color: red">@error('email')@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your supplier Email
                                                </small>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="inputEmail12" class="ul-form__label">Supplier Website:</label>
                                                <input type="=text" class="form-control" id="website" name="website"  placeholder="Enter Your Supplier Website"value="{{ old ('website')}}">
                                                <span style="color: red">@error('phonenumber'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your supplier Website
                                                </small>
                                            </div>                                           
                                            <div class="form-group col-lg-6">
                                                <label for="inputEmail12" class="ul-form__label">Supplier Address:</label>
                                                <input type="=text" class="form-control" id="address" name="address"  placeholder="Enter Your Supplier Address"value="{{ old ('address')}}">
                                                <span style="color: red">@error('phonenumber'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your supplier Address
                                                </small>
                                            </div>                                           
                                    </div>
              
                                    <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn  btn-primary m-1">Save</button>
                                                    <button type="button" class="btn btn-outline-secondary m-1" id="clearform">Cancel</button>
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

<script>
    $(document).ready(function(){
        $('#clearform').click(function(){
            $('#name').val('');
            $('#phone').val('');
            $('#email').val('');
            $('#website').val('');
            $('#address').val('');
        })
    })

</script>
@endsection
