@extends('layouts.master')
@section('before-css')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection


@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Create Coupon</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Create Coupon according to requirments</h3>
                                </div>
                                <form action="{{ route('Homecoupons.store') }}" method="POST">
    @csrf
    <div class="form-group col-md-4">
    <label for="couponId" class="ul-form__label">Coupon ID:</label>
    <input type="text" class="form-control" id="couponId" name="id" placeholder="Enter Coupon ID" required>
    <small class="ul-form__text form-text">
        Enter a Coupon ID
    </small>
</div>

                           
                             <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn  btn-outline-secondary m-1">Create Coupon</button>
                                                     
                                                    <a href="{{ route('admin')}}"><button type="button" class="btn btn-outline-secondary m-1">Cancel</button></a>
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