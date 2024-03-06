@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')
    <div class="row">
        <div class="">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-title" style=" margin-left: -20px; ">Stock Chart</div>
                        </div>
                        <div class="col-6">
                            <div class="card-title" style=" text-align: end; ">Total Items: {{ $totalItem }} || In-Stock:
                                {{ $inStock }} || Out-Of-Stock: {{ $outOfStock }} </div>
                        </div>
                    </div>
                    <div id="stackedBar1">


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="breadcrumb col-lg-12">
        <div class="col-md-6">
            <h1>Stock</h1>
        </div>
        <div class="col-md-6" style="text-align: right;  margin-left: auto;">
            <a href="{{ route('purchase.create') }}"><button class="btn btn-outline-secondary m-1"
                    data-style="expand-left"><span class="ladda-label">Add Purchase</span></button></a>

        </div>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">Stock</h4>
                {{-- <p>With DataTables you can alter the ordering characteristics of the table at initialisation time. Using
                            the order initialisation parameter, you can set the table to display the data in exactly the order
                            that you want.</p> --}}

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
        "use strict";
$(document).ready(function () {
    var e = {
        chart: { height: 350, type: "bar" },
        plotOptions: { bar: { horizontal: !0, endingShape: "rounded" } },
        dataLabels: { enabled: !1 },
        series: [
            { data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380] },
        ],
        xaxis: {
            categories: [
                "South Korea",
                "Canada",
                "United Kingdom",
                "Netherlands",
                "Italy",
                "France",
                "Japan",
                "United States",
                "China",
                "Germany",
            ],
        },
    };
    new ApexCharts(document.querySelector("#basicBar-chart"), e).render();
    e = {
        chart: { height: 350, type: "bar", toolbar: { show: !1 } },
        plotOptions: {
            bar: { horizontal: !0, dataLabels: { position: "top" } },
        },
        dataLabels: {
            enabled: !1,
            offsetX: -6,
            style: { fontSize: "12px", colors: ["#fff"] },
        },
        stroke: {
            show: !1,
            width: 1,
            colors: ["#fff"],
            lineCap: "round",
            curve: "smooth",
        },
        series: [
            { data: [44, 55, 41, 64, 22, 43, 21] },
            { data: [53, 32, 33, 52, 13, 44, 32] },
        ],
        xaxis: { categories: [2018, 2019, 2020, 2021, 2022, 2023, 2024] },
    };
    new ApexCharts(document.querySelector("#groupedBar"), e).render();
    e = {
        chart: { height: 350, type: "bar", stacked: !0, toolbar: { show: !1 } },
        plotOptions: { bar: { horizontal: !0 } },
        stroke: { width: 0, colors: ["#fff"] },
        series: [
            { name: "Electrical / Mechanical", data: [44, 55, 41, 37, 22, 43, 21] },
            { name: "Machinery / Vehicles / Commercial / Raw Materials", data: [53, 32, 33, 52, 13, 43, 32] },
            { name: "Power Distribution / Solar Power & Energy / Heavy Batteries", data: [12, 17, 11, 9, 15, 11, 20] },
            { name: "Consumer / Home / Office", data: [9, 7, 5, 8, 6, 9, 4] },
            // { name: "Reborn Kid", data: [25, 12, 19, 32, 25, 24, 10] },
        ],
        xaxis: {
            categories: [2018, 2019, 2020, 2021, 2022, 2023, 2024],
            labels: {
                formatter: function (e) {
                    return e + "";
                },
            },
        },
        yaxis: { title: { text: void 0 } },
        tooltip: {
            y: {
                formatter: function (e) {
                    return e + "";
                },
            },
        },
        fill: { opacity: 1 },
        legend: { position: "top", horizontalAlign: "left", offsetX: 40 },
    };
    new ApexCharts(document.querySelector("#stackedBar1"), e).render();
    e = {
        chart: { height: 350, type: "bar", stacked: !0, toolbar: { show: !1 } },
        colors: ["#008FFB", "#FF4560"],
        plotOptions: { bar: { horizontal: !0, barHeight: "80%" } },
        dataLabels: { enabled: !1 },
        stroke: { width: 1, colors: ["#fff"] },
        series: [
            {
                name: "Males",
                data: [
                    0.4, 0.65, 0.76, 0.88, 1.5, 2.1, 2.9, 3.8, 3.9, 4.2, 4, 4.3,
                    4.1, 4.2, 4.5, 3.9, 3.5, 3,
                ],
            },
            {
                name: "Females",
                data: [
                    -0.8, -1.05, -1.06, -1.18, -1.4, -2.2, -2.85, -3.7, -3.96,
                    -4.22, -4.3, -4.4, -4.1, -4, -4.1, -3.4, -3.1, -2.8,
                ],
            },
        ],
        grid: { xaxis: { showLines: !1 } },
        yaxis: { min: -5, max: 5, title: {} },
        tooltip: {
            shared: !1,
            x: {
                formatter: function (e) {
                    return e;
                },
            },
            y: {
                formatter: function (e) {
                    return Math.abs(e) + "%";
                },
            },
        },
        xaxis: {
            categories: [
                "85+",
                "80-84",
                "75-79",
                "70-74",
                "65-69",
                "60-64",
                "55-59",
                "50-54",
                "45-49",
                "40-44",
                "35-39",
                "30-34",
                "25-29",
                "20-24",
                "15-19",
                "10-14",
                "5-9",
                "0-4",
            ],
            title: { text: "Percent" },
            labels: {
                formatter: function (e) {
                    return Math.abs(Math.round(e)) + "%";
                },
            },
        },
    };
    
});

    </script>
@endsection
