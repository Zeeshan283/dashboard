@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endsection
@section('main-content')
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
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

    </style>
    <div class="card-body">
        <button class="popup-button btn btn-secondary col-md-1"
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Customer Filters</button><br><br>
        <div class="filter-card" id="filterCard" style="display: none;">
            <form action="{{ route('customerlist') }}" method="GET">
                <button type="submit" class="btn btn-secondary" style="margin-left: 1200px">Submit</button>
                <div class="row" style="margin-top: 5px;">
                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Customer ID</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($customer as $value => $customers)
                                    <label class="idFilter">
                                            <input type="checkbox" value="{{ $customers->id }}">
                                            <span class="option-text">{{ $customers->id }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">First Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($customer as $value => $customers)
                                    <label class="first_nameFilter">
                                            <input type="checkbox" value="{{ $customers->first_name }}">
                                            <span class="option-text">{{ $customers->first_name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Last Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($customer as $value => $customers)
                                    <label class="last_nameFilter">
                                            <input type="checkbox" value="{{ $customers->last_name }}">
                                            <span class="option-text">{{ $customers->last_name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="row" style="margin-top: 30px; margin-bottom: 150px">
                    <div class="col-md-3 d-flex"> Gender:
                        <div class="ul-form__radio-inline d-flex">
                            <label class="ul-radio__position radio radio-primary form-check-inline">
                            <input type="radio" name="gender" value="male" <?php if( $customers->gender == 'male') echo 'checked'; ?>>
                            <span class="ul-form__radio-font">Male</span>
                            <span class="checkmark"></span>
                            </label>

                            <label class="ul-radio__position radio radio-primary form-check-inline">
                                <input type="radio" name="gender" value="female" <?php if( $customers->gender == 'female') echo 'checked'; ?>>
                                <span class="ul-form__radio-font">Female</span>
                                <span class="checkmark"></span>
                                </label>

                        </div>
                    </div>

                        <div class="col-md-3" style="margin-left: 100px;">
                            <div class="content-box">
                                <input type="button" class="datetimerange" value="12/31/2017 - 01/31/2018" />
                            </div>
                        </div>


                    </div>

                    </form>
    </div>
                    </div>


    <div class="separator-breadcrumb border-top"></div>
    <div class="breadcrumb">
                <h1>Customer Management</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
                <div class="card text-start">

                    <div class="card-body">
                        <h4 class="card-title mb-3">All Customers</h4>
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
                <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

                <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>


                <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
                <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
            @endsection
