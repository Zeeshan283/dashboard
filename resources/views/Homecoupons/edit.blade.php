@extends('layouts.master')
@section('before-css')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection


@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Edit Coupon</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Edit Coupon according to requirments</h3>
                                </div>
                                <form action="{{ route('Homecoupons.update') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                            <div class="form-group col-md-4">
                                                <label for="commonField" class="ul-form__label">Coupon Code:</label>
                                                <input type="text" class="form-control" id="commonField" name="coupon_code" placeholder="Coupon Code" required>
                                                <small class="ul-form__text form-text">
                                                    Coupon Code Here
                                                </small>
                                            </div>
                                            <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn  btn-outline-secondary m-1">Update</button>
                                                     
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