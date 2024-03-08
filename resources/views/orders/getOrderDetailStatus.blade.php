@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endsection
@section('main-content')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <style>
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ced4da;
            padding: 8px;
            max-height: 160px;
            max-width: 500px;
            overflow-y: auto;
        }

        .dropdown-options {
            margin-top: 30px;
        }

        .dropdown-options label {
            display: block;
            margin-bottom: 5px;
        }

        .option-text {
            margin-left: 5px;
        }

        /* Simplify focus outline for search inputs */
        input:focus {
            border-color: #ced4da;
            outline: none;
        }

        .dropdown-toggle {
            display: flex;
            max-width: 300px;
            padding-right: 100px;
            padding-left: 30px;
            background-color: #f8f9fa;
            border: 2px solid #e2eaf1;
            cursor: pointer;
            padding-top: 10px;
            padding-bottom: 5px;
            overflow: hidden;
        }

        .text-left {
            margin-right: auto;
        }

        .filter-card {
            margin-bottom: 0px;
            overflow: hidden;
            margin-left: 60px;
        }

        .datetimerange {
            border-color: #ccc !important;
            max-width: 300px;
            border: 2px solid;
            padding-top: 9px;
            padding-bottom: 9px;
            padding-right: 70px;
            padding-left: 70px;
            background-color: #f8f9fa;
        }

        .slider {
            position: relative;
            width: 400px;
            height: 30px;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 10px;
            padding-right: 15px;
            margin-left: 10px;
            background: #fcfcfc;
            border-radius: 25px;
            display: flex;
            box-shadow: 0px 15px 40px #7E6D5766;
        }

        .slider label {
            font-size: 28px;
            font-weight: 600;
            font-family: Open Sans;
            padding-left: 30px;
            color: black;
        }

        .slider input[type="range"] {
            width: 320px;
            height: 4px;
            background: black;
            border: none;
            outline: none;
        }

        .range input {
            margin-top: 10%;
            -webkit-transform: rotate(40deg);
            -moz-transform: rotate(40deg);
            -o-transform: rotate(40deg);
            transform: rotate(270deg);
            max-height: 5%;
        }

        .input-bar {
            background-color: #f8f9fa;
            border: 3px solid #e2eaf1;
        }

        #quantity {
            max-width: 500px;
            padding-right: 117px;
            padding-left: 116px;
            background-color: #f8f9fa;
            border: 3px solid #e2eaf1;
            cursor: pointer;
            padding-top: 12px;
            padding-bottom: 12px;
            overflow: hidden;
        }
    </style>
    <div class="card-body">
        <button class="popup-button btn btn-secondary col-md-2"
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Get Order Details
            Filters</button><br><br>
        <div class="filter-card" id="filterCard" style="display: none;">
            <form action="{{ route('order_details') }}" method="GET">
                <button type="submit" class="btn btn-secondary" style="margin-left: 1200px">Submit</button>
                <div class="row" style="margin-top: 10px; margin-bottom: 100px">

                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Parcel ID</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($status as $value => $orders)
                                        <label class="order_idFilter">
                                            <input type="checkbox" value="{{ $orders->order_id }}">
                                            <span class="option-text">{{ $orders->order_id }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Order Status</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($status as $value => $orders)
                                        <label class="idFilter">
                                            <input type="checkbox" value="{{ $orders->status }}">
                                            <span class="option-text">{{ $orders->status }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="content-box">
                            <input type="text" name="dateTime" class="datetimerange" />
                        </div>
                    </div>


                </div>
                <div class="breadcrumb">
                    <h1>Get Order Parcels Status</h1>
                </div>

                <div class="separator-breadcrumb border-top"></div>


                @php
                    $hasInProcessStatus = false;
                    $hasPackagingStatus = false;
                    $hasOutForDelivery = false;
                    $hasDelivered = false;
                    $hasFailedToDeliver = false;
                    $hasCanceled = false;
                @endphp

                @foreach ($status as $order)
                    @if ($order->status === 'In Process')
                        @php
                            $hasInProcessStatus = true;
                        @endphp
                    @endif
                    @if ($order->status === 'Packaging')
                        @php
                            $hasPackagingStatus = true;
                        @endphp
                    @endif
                    {{-- @if ($order->status === 'Out For Delivery')
                        @php
                            $hasOutForDelivery = true;
                        @endphp
                    @endif
                    @if ($order->status === 'Delivered')
                        @php
                            $hasDelivered = true;
                        @endphp
                    @endif
                    @if ($order->status === 'Failed to Deliver')
                        @php
                            $hasFailedToDeliver = true;
                        @endphp
                    @endif
                    @if ($order->status === 'Canceled')
                        @php
                            $hasCanceled = true;
                        @endphp
                    @endif --}}
                @endforeach




                <div class="col-md-12 mb-4">
                    <div class="card text-start">

                        <div class="card-body">
                            <h4 class="card-title mb-3">Get order Parcels Status</h4>

                            {{-- <p>All Orders list is below.</p> --}}

                            <div class="table-responsive">
                                <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                                    style="width:100%;">
                                    <thead>
                                        <th>Id #</th>
                                        <th>Parcel Id #</th>
                                        <th>Status</th>
                                        <th>DateTime</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($status as $value => $orders)
                                            <tr>

                                                <td>{{ $value + 1 }}</td>
                                                <td>{{ $orders->order_id }}</td>
                                                <td>{{ $orders->status }} </td>
                                                <td>{{ $orders->datetime }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id #</th>

                                            <th>Parcel Id #</th>
                                            <th>Status</th>
                                            <th>DateTime</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection

            @section('page-js')
                <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
                <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
                <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
            @endsection
