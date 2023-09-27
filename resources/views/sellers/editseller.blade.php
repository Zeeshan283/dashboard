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
                <h1>Update Status</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Update Status</h3>
                                </div>
                                <form action="{{ route('vendor.update', ['vendor' => $vendors->id]) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <div class="card-body">

                                        
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail18" class="ul-form__label">Status: (Active || Inactive)</label>
                                                    <div class="ul-form__checkbox-inline">
                                                    <label class="switch">
                                                        <input type="checkbox"  name="radio" value="1" @if($vendors->status == '1') checked @endif class="coupon-status-toggle"  >
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text">
                                                    Select Your Status
                                                </small>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail18" class="ul-form__label">Verified Status  <span class="badge  badge-round-success md"><p style="font-size: revert;">✓</p></span></label>
                                                <div class="ul-form__checkbox-inline">
                                                    
                                                    <label class="switch">
                                                        <input type="checkbox"  name="verified" value="1" @if($vendors->verified_status == '1') checked @endif class="coupon-status-toggle"  >
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail18" class="ul-form__label">Trusted Status  <span class="badge  badge-round-info md"><p style="font-size: revert;">✓</p></span></label>
                                                <div class="ul-form__checkbox-inline">
                                                    
                                                    <label class="switch">
                                                        <input type="checkbox"  name="trusted" value="1" @if($vendors->trusted_status == '1') checked @endif class="coupon-status-toggle"  >
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
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