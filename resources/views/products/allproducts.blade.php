@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
    <div class="breadcrumb">
        <div class="col-md-6">
                <h1>Product's Management</h1>
        </div>
        <div class="col-md-6" style="text-align: right;  margin-left: auto;">
            <a href="{{ route('products.create')}}"><button class="btn btn-outline-secondary  ladda-button example-button m-1" data-style="expand-left"><span class="ladda-label">Add Product</span></button></a>

        </div>
    </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
                <div class="card text-start">
    
                    <div class="card-body">
                        <h4 class="card-title mb-3">All Product's</h4>

    
                        <div class="table-responsive">
                            <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                                style="width:100%">
                                @include('datatables.table_content')
                                
                            </table>
                        </div>
    
                    </div>
                </div>
            </div>

          
@endsection

@section('page-js')
<script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>

@endsection
