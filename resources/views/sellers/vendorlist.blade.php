@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
    <div class="breadcrumb">
        <div class="col-md-6">
            <h1>Vendor's Management</h1>
    </div>
    <div class="col-md-6" style="text-align: right;  margin-left: auto;">
        <a href="{{ route('vendors.create')}}"><button class="btn btn-outline-secondary  ladda-button example-button m-1" data-style="expand-left"><span class="ladda-label">Add Vendor</span></button></a>

    </div>
</div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
                <div class="card text-start">

                    <div class="card-body">
                        <h4 class="card-title mb-3">All Vendors</h4>

                        {{-- <p>.....</p> --}}

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
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
