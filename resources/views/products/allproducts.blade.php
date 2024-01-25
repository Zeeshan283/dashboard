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
        <!-- Add this above your table -->
<div>
    <label for="nameFilter">Name:</label>
    <!-- <input type="text"> -->
    <select  id="nameFilter">
        <option value="mottor">mottor</option>
        <option value="plc">plc</option>
    </select>

    
    <label for="modelFilter">Model#:</label>
    <input type="text" id="modelFilter">
    <label for="startDateFilter">Start Date:</label>
    <input type="date" id="startDateFilter">

    <label for="endDateFilter">End Date:</label>
    <input type="date" id="endDateFilter">
    <!-- Add more filter inputs for other columns if needed -->
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

          <!-- Add this script at the end of your body or in a separate JS file -->
<!-- Update this script at the end of your body or in a separate JS file -->


@endsection

@section('page-js')
<script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>

@endsection
