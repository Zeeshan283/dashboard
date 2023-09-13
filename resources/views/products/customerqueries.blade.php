@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
<style>
        .tooltip-container {
        position: relative;
        display: inline-block;
    }

    .message-hover {
        cursor: pointer;
        /* text-decoration: underline; */
        color: blue;
    }

    .tooltip {
        visibility: hidden;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 4px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 0;
        margin-left: -70px; /* Adjust as needed for tooltip positioning */
        opacity: 0;
        transition: opacity 0.2s;
        width: auto; /* Adjust the width as needed */
    }

    .tooltip-container:hover .tooltip {
        visibility: visible;
        opacity: 1;
    }

</style>
    @endsection

@section('main-content')
    <div class="breadcrumb">
                <h1>Customr Queries</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
                <div class="card text-start">
    
                    <div class="card-body">
                        <h4 class="card-title mb-3">Customer Queries</h4>
    
                        <p>.....</p>
    
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
