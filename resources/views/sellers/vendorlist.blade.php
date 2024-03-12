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
        <button class="popup-button btn btn-secondary col-md-1"
            style="color: white; position: relative; top: 5px; right: 10px;" onclick="toggleFilters()">Vendor
            Filters</button><br><br>
        <div class="filter-card" id="filterCard" style="display: none;">
            <form action="{{ route('vendors.index') }}" method="GET">
                <button type="submit" class="btn btn-secondary" style="margin-left: 1200px">Submit</button>
                <div class="row" style="margin-top: 5px; margin-bottom: 150px">
                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Vendor Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($vendor as $value => $vendors)
                                        <label class="nameFilter">
                                            <input type="checkbox" value="{{ $vendors->name }}">
                                            <span class="option-text">{{ $vendors->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3 d-flex">
                       Status:<br><br>
                        <br>
                        <div class="d-flex"><p style="margin-left: 60px; margin-right: 10px">Active:</p>
                            <label class="switch">
                                <input type="checkbox" name="status" value="1" <?php if($vendors->status == '1') echo 'checked'; ?>>
                                <span class="slider <?php if($vendors->status == '1') echo 'active'; ?>"></span>
                            </label><p style="margin-left: 60px; margin-right: 10px">InActive:</p>
                            <label class="switch">
                                <input type="checkbox" name="status" value="0" <?php if($vendors->status == '0') echo 'checked'; ?>>
                                <span class="slider <?php if($vendors->status == '0') echo 'active'; ?>"></span>
                            </label>
                        </div>
                    </div>

                        <div class="col-md-3" style="margin-left: 100px;">
                            <div class="content-box">
                                <input type="button" class="datetimerange" value="12/31/2017 - 01/31/2018" />
                            </div>
                        </div>



                    </div>


                </div>


        </div>
    </div>

    <div class="row">
        <div class="">
            <div class="card mb-4">
                <div class="card-body">

                    <div class="row">
                        <div class="col-6">
                            <div class="card-title" style=" margin-left: -20px; ">Total Supplier || Active Vs In Active
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card-title" style=" text-align: end; ">Total Supplier: {{ $totalSupplier }} ||
                                Active: {{ $totalActiveSupplier }} || InActive: {{ $totalInActiveSupplier }}</div>
                        </div>
                    </div>
                    <div id="basicLine1"
                        style="height: 300px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative;"
                        _echarts_instance_="ec_1709707664528">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="breadcrumb">
        <div class="col-md-6">
            <h1>Vendor's Management</h1>
        </div>
        <div class="col-md-6" style="text-align: right;  margin-left: auto;">
            <a href="{{ route('vendors.create') }}"><button
                    class="btn btn-outline-secondary  ladda-button example-button m-1" data-style="expand-left"><span
                        class="ladda-label">Add Vendor</span></button></a>
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
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script> --}}
    <script src="{{ asset('assets/js/vendor/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/js/es5/echart.options.min.js') }}"></script>
    <script src="{{ asset('assets/js/es5/dashboard.v1.script.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/apexcharts.dataseries.js') }}"></script>
    <script src="{{ asset('assets/js/es5/apexChart.script.min.js') }}"></script>
    <script src="{{ asset('assets/js/es5/apexBarChart.script.min.js') }}"></script>
    <script src="{{ asset('assets/js/es5/apexPieDonutChart.script.min.js') }}"></script>
    <script src="{{ asset('assets/js/es5/chartjs.script.min.js') }}"></script>
    <script src="{{ asset('assets/js/es5/apexColumnChart.script.min.js') }}"></script>
    <script src="{{ asset('assets/js/es5/echarts.script.min.js') }}"></script>

    <script>
        var a = document.getElementById("basicLine1");
        if (a) {
            var r = echarts.init(a);
            r.setOption({
                    tooltip: {
                        show: !0,
                        trigger: "axis",
                        axisPointer: {
                            type: "line",
                            animation: !0
                        },
                    },
                    grid: {
                        top: "10%",
                        left: "40",
                        right: "40",
                        bottom: "40"
                    },
                    xAxis: {
                        type: "category",
                        data: [
                            "1/11/2018",
                            "2/11/2018",
                            "3/11/2018",
                            "4/11/2018",
                            "5/11/2018",
                            "6/11/2018",
                            "7/11/2018",
                            "8/11/2018",
                            "9/11/2018",
                            "10/11/2018",
                            "11/11/2018",
                            "12/11/2018",
                            "13/11/2018",
                            "14/11/2018",
                            "15/11/2018",
                            "16/11/2018",
                            "17/11/2018",
                            "18/11/2018",
                            "19/11/2018",
                            "20/11/2018",
                            "21/11/2018",
                            "22/11/2018",
                            "23/11/2018",
                            "24/11/2018",
                            "25/11/2018",
                            "26/11/2018",
                            "27/11/2018",
                            "28/11/2018",
                            "29/11/2018",
                            "30/11/2018",
                        ],
                        axisLine: {
                            show: !1
                        },
                        axisLabel: {
                            show: !0
                        },
                        axisTick: {
                            show: !1
                        },
                    },
                    yAxis: {
                        type: "value",
                        axisLine: {
                            show: !1
                        },
                        axisLabel: {
                            show: !0
                        },
                        axisTick: {
                            show: !1
                        },
                        splitLine: {
                            show: !0
                        },
                    },
                    series: [{
                        name: "Active",

                        data: [

                            400, 800, 325, 900, 700, 800, 400, 900, 800, 800, 300,
                            405, 500, 1100, 900, 1450, 1200, 1350, 1200, 1400, 1e3,
                            800, 950, 705, 690, 921, 1020, 903, 852, 630,

                        ],
                        type: "line",
                        showSymbol: !0,
                        smooth: !0,
                        color: "#639",
                        lineStyle: {
                            opacity: 1,
                            width: 2
                        },
                    }, ],
                }),
                $(window).on("resize", function() {
                    setTimeout(function() {
                        r.resize();
                    }, 500);
                });
        }
    </script>
@endsection
