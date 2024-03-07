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
            max-width: 400px;
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
            max-width: 280px;
            padding-right: 100px;
            padding-left: 30px;
            background-color: #f8f9fa;
            border: 2px solid #e2eaf1;
            cursor: pointer;
            padding-top: 10px;
            padding-bottom: 5px;
            overflow: hidden;
            margin-bottom: 150px;
        }

        .filter-card {
            margin-left: 100px;
        }

        .text-left {
            margin-right: auto;
        }

        .datetimerange {
            border-color: #ccc !important;
            max-width: 350px;
            border: 2px solid;
            padding-top: 8px;
            padding-bottom: 8px;
            padding-right: 60px;
            padding-left: 60px;
            background-color: #f8f9fa;
        }
    </style>
    <div class="card-body">
        <button class="popup-button btn btn-primary col-md-1"
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Product
            Filters</button><br><br>
        <div class="filter-card" id="filterCard">
            <button type="submit" class="btn btn-secondary" style="margin-left: 1200px">Submit</button>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-2">
                    <form action="{{ route('productreviews') }}" method="GET">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Customer Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    <label class="customer_nameFilter">
                                        <input type="checkbox" value="customer_name">
                                        <span class="option-text">Tiger Nixon</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="col-md-2">
                    <form action="{{ route('productreviews') }}" method="GET">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Model No#</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    <label class="model_noFilter">
                                        <input type="checkbox" value="model_no">
                                        <span class="option-text">System Architect</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                    <form action="{{ route('productreviews') }}" method="GET">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton3" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Rating</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    <label class="ratingFilter">
                                        <input type="checkbox" value="rating">
                                        <span class="option-text">
                                            <span class="star star-filled"></span>&nbsp;&nbsp;
                                            <span class="star star-filled"></span>&nbsp;&nbsp;
                                            <span class="star star-filled"></span>&nbsp;&nbsp;
                                            <span class="star star-filled"></span>&nbsp;&nbsp;
                                            <span class="star star-partial"></span>&nbsp;&nbsp;</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-3">
                    <div class="content-box">
                        <form action="{{ route('productreviews') }}" method="GET">
                            <input type="button" class="datetimerange" value="12/31/2017 - 01/31/2018" />
                        </form>
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

        </div>
    </div>
    <div class="breadcrumb">
        <h1>Product Reviews</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">Product Reviews</h4>

                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%">
                        @include('datatables.table_content')
                    </table>
                </div>

            </div>
        </div>
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
@endsection

@section('page-js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>


    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
