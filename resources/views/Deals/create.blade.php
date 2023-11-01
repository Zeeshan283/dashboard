@extends('layouts.master')
@section('before-css')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection


@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Add Product</h1>
            </div>
            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title">Add Products</h3>
                                </div>
                                <form action="{{ route('Deals.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">SKU:<span style="color: red;">*</span></label>
                                                <div class="col-lg-4">
                                                {!! Form::text('sku', null, [
                                                    'id' => 'sku',
                                                    'class' => 'form-control',
                                                    // '' => '',
                                                    'placeholder'=>'Enter Product SKU',
                                                ]) !!}
                                                @if ($errors->has('sku'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('sku') }}</span   style="color: red;">
                                                @endif
                                                </div>  
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="commonField" name="status" value="Active" hidden>
                                    </div>
                                    <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn  btn-outline-secondary m-1">Add</button>
                                                     
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