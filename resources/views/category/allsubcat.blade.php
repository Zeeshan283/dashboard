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
            margin-left: 0px;
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
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">SubCategory Filters</button><br><br>
        <div class="filter-card" id="filterCard" style="display: none;">
            <form action="{{ route('sub-category.index') }}" method="GET">
                <button type="submit" class="btn btn-secondary" style="margin-left: 1200px">Submit</button>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $key => $donor)
                                        <label class="nameFilter">
                                            <input type="checkbox" value="{{ $donor->name }}">
                                            <span class="option-text">{{ $donor->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton3" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Category</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $key => $donor)
                                        <label class="categoriesFilter">
                                            <input type="checkbox" value=" {{ $donor->categories->name ?? null }}">
                                            <span class="option-text"> {{ $donor->categories->name ?? null }}</span>
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
                                <p class="text-left">Slug</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $key => $donor)
                                        <label class="customer_nameFilter">
                                            <input type="checkbox" value=" {{ $donor->slug }}">
                                            <span class="option-text">{{ $donor->slug }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                <div class="col-md-3">
                    <div class="content-box">
                        <input type="button" class="datetimerange" value="12/31/2017 - 01/31/2018" />
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

<div class="row" style="margin-top: 10px; margin-bottom: 130px;">

                <div class="col-md-5">
                    <div class="content-box d-flex">
                        <div class="input-bar" style="margin-left: 350px;">
                            <label for="priceInput4">Enter Price:</label>
                            <input type="number" id="priceInput4" min="0" max="1000000" value="100"
                                oninput="updatePriceSlider(this.value, 'rangeValue4')">
                        </div>
                        <div class="slider"><b>Commission</b>
                            <label for="fader"></label><input type="range" min="0" max="100"
                                value="50" id="fader" step="20" list="volsettings"
                                oninput="updatePriceValue(this.value, 'rangeValue4')">
                            <p id="rangeValue4">100</p>
                            <datalist id="volsettings">
                                <option>0</option>
                                <option>20</option>
                                <option>40</option>
                                <option>60</option>
                                <option>80</option>
                                <option>100</option>
                            </datalist>
                        </div>

                    </div>
                </div>

        </div>
        <script>
            function updatePriceValue(value, outputId) {
                document.getElementById(outputId).textContent = value;
            }

            function updatePriceSlider(value, sliderId) {
                document.getElementById(sliderId).textContent = value;
                document.querySelector('input[type="range"]').value = value;
            }

            function updatePriceValue(value, targetId) {
                document.getElementById(targetId).innerText = value;
            }

        </script>
    </div>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="breadcrumb">
        <div class="col-md-6">
            <h1>All sub Categories</h1>
        </div>
        <div class="col-md-6" style="text-align: right;  margin-left: auto;">
            <a href="{{ route('sub-category.create') }}"><button
                    class="btn btn-outline-secondary ladda-button example-button m-1" data-style="expand-left"><span
                        class="ladda-label">Create Sub-Category</span></button></a>
        </div>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">
            <div class="card-body">
                <h4 class="card-title mb-3">All Sub Categories</h4>
                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%">
                        @include('datatables.table_content')
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>
@endsection

@section('page-js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
