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
            padding-top: 12px;
            padding-bottom: 12px;
            padding-right: 60px;
            padding-left: 10px;
            background-color: #f8f9fa;
        }
    </style>
    <div class="card-body">
        <button class="popup-button btn btn-primary col-md-1"
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Product
            Filters</button><br><br>
        <div class="filter-card" id="filterCard">
            <form action="{{ route('brands.index') }}" method="GET">
                <button type="submit" class="btn btn-secondary" style="margin-left: 1200px">Submit</button>
                <div class="row" style="margin-top: 5px; margin-bottom: 180px;">
                    <div class="col-md-3">
                        <div class="dropdown" id="brand_nameDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                 aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Brand</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="max-width: 1000px;">
                                <input type="text" id="brand_nameSearchInput" onkeyup="filterOptions()"
                                       placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($allbrands as $brand)
                                        <label class="brand_nameFilter d-flex">
                                            <input type="checkbox" name="brands[]" style="margin-bottom: 3px;"
                                                   value="{{ $brand->brand_name }}">
                                            <span class="option-text d-flex"> {{ $brand->brand_name }} <img
                                                    src="{{ asset($brand->logo) }}" width="50" height="50"
                                                    alt="{{ $brand->brand_name }}">
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3" style="margin-left: 0px;">
                        <div class="content-box">
                            <input type="text" name="dateTime" class="datetimerange"  />
                        </div>
                    </div>

                    <script>
                        $(function() {
                            $('.datetimerange').daterangepicker({
                                timePicker: true,
                                timePickerIncrement: 30,
                                locale: {
                                    format: 'MM/DD/YYYY h:mm A'
                                }
                            });
                        });
                    </script>

                </div>
                <script>
                    function toggleFilters() {
                        var filterCard = document.getElementById("filterCard");
                        if (filterCard.style.display === "none") {
                            filterCard.style.display = "block";
                        } else {
                            filterCard.style.display = "none";
                        }
                    }
                </script>
            </form>
        </div>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <div class="breadcrumb">
        <div class="col-md-6">
                <h1>Brand's Management</h1>
        </div>
        <div class="col-md-6" style="text-align: right;  margin-left: auto;">
            <a href="{{ route('brands.create')}}"><button class="btn btn-outline-secondary  ladda-button example-button m-1" data-style="expand-left"><span class="ladda-label">Add Brand</span></button></a>

        </div>
    </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
                <div class="card text-start">

                    <div class="card-body">
                        <h4 class="card-title mb-3">All Brand's</h4>


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

