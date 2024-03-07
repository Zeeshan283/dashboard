@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" /> --}}
@endsection
@section('main-content')
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" /> --}}
    {{-- <style>
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
            margin-left: 100px;
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
    </style> --}}
    
    {{-- <div class="separator-breadcrumb border-top"></div> --}}


    <div class="row">
        <div class="">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-title" style=" margin-left: -20px; ">Total Order Vs Sales</div>
                        </div>
                        <div class="col-6">
                            <div class="card-title" style=" text-align: end; ">Total Orders: {{ $allorders }} || Total
                                Parcel's: {{ $allparcels }}</div>
                        </div>
                    </div>
                    <div id="stackedPointerArea1"
                        style="height: 300px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative;"
                        _echarts_instance_="ec_1709707664537">
                        <div
                            style="position: relative; overflow: hidden; width: 613px; height: 300px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;">
                            <canvas data-zr-dom-id="zr_0" width="766" height="375"
                                style="position: absolute; left: 0px; top: 0px; width: 613px; height: 300px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="breadcrumb">
        <h1>All Orders</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">All orders</h4>
                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%;">
                        @include('datatables.table_content')
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFilters() {
            var filterCard = document.getElementById("filterCard");
            filterCard.style.display = (filterCard.style.display === "none" || filterCard.style.display === "") ? "block" :
                "none";
        }
    </script>
@endsection

@section('page-js')
    {{-- <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script> --}}
    {{-- <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> --}}
    {{-- <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script> --}}
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>

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
        "use strict";
        $(document).ready(function() {
            var e = document.getElementById("echartBar");
            if (e) {
                var t = echarts.init(e);
                t.setOption({
                        legend: {
                            borderRadius: 0,
                            orient: "horizontal",
                            x: "right",
                            data: ["Online", "Offline"],
                        },
                        grid: {
                            left: "8px",
                            right: "8px",
                            bottom: "0",
                            containLabel: !0
                        },
                        tooltip: {
                            show: !0,
                            backgroundColor: "rgba(0, 0, 0, .8)"
                        },
                        xAxis: [{
                            type: "category",
                            data: [
                                "Jan",
                                "Feb",
                                "Mar",
                                "Apr",
                                "May",
                                "Jun",
                                "Jul",
                                "Aug",
                                "Sept",
                                "Oct",
                                "Nov",
                                "Dec",
                            ],
                            axisTick: {
                                alignWithLabel: !0
                            },
                            splitLine: {
                                show: !1
                            },
                            axisLine: {
                                show: !0
                            },
                        }, ],
                        yAxis: [{
                            type: "value",
                            axisLabel: {
                                formatter: "${value}"
                            },
                            min: 0,
                            max: 1e5,
                            interval: 25e3,
                            axisLine: {
                                show: !1
                            },
                            splitLine: {
                                show: !0,
                                interval: "auto"
                            },
                        }, ],
                        series: [{
                                name: "Online",
                                data: [
                                    35e3, 69e3, 22500, 6e4, 5e4, 5e4, 3e4, 8e4, 7e4, 6e4,
                                    2e4, 30005,
                                ],
                                label: {
                                    show: !1,
                                    color: "#0168c1"
                                },
                                type: "bar",
                                barGap: 0,
                                color: "#bcbbdd",
                                smooth: !0,
                                itemStyle: {
                                    emphasis: {
                                        shadowBlur: 10,
                                        shadowOffsetX: 0,
                                        shadowOffsetY: -2,
                                        shadowColor: "rgba(0, 0, 0, 0.3)",
                                    },
                                },
                            },
                            {
                                name: "Offline",
                                data: [
                                    45e3, 82e3, 35e3, 93e3, 71e3, 89e3, 49e3, 91e3, 80200,
                                    86e3, 35e3, 40050,
                                ],
                                label: {
                                    show: !1,
                                    color: "#639"
                                },
                                type: "bar",
                                color: "#7569b3",
                                smooth: !0,
                                itemStyle: {
                                    emphasis: {
                                        shadowBlur: 10,
                                        shadowOffsetX: 0,
                                        shadowOffsetY: -2,
                                        shadowColor: "rgba(0, 0, 0, 0.3)",
                                    },
                                },
                            },
                        ],
                    }),
                    $(window).on("resize", function() {
                        setTimeout(function() {
                            t.resize();
                        }, 500);
                    });
            }
            var o = document.getElementById("echartPie");
            if (o) {
                var i = echarts.init(o);
                i.setOption({
                        color: [
                            "#62549c",
                            "#7566b5",
                            "#7d6cbb",
                            "#8877bd",
                            "#9181bd",
                            "#6957af",
                        ],
                        tooltip: {
                            show: !0,
                            backgroundColor: "rgba(0, 0, 0, .8)"
                        },
                        series: [{
                            name: "Sales by Country",
                            type: "pie",
                            radius: "60%",
                            center: ["50%", "50%"],
                            data: [{
                                    value: 535,
                                    name: "USA"
                                },
                                {
                                    value: 310,
                                    name: "Brazil"
                                },
                                {
                                    value: 234,
                                    name: "France"
                                },
                                {
                                    value: 155,
                                    name: "BD"
                                },
                                {
                                    value: 130,
                                    name: "UK"
                                },
                                {
                                    value: 348,
                                    name: "India"
                                },
                            ],
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: "rgba(0, 0, 0, 0.5)",
                                },
                            },
                        }, ],
                    }),
                    $(window).on("resize", function() {
                        setTimeout(function() {
                            i.resize();
                        }, 500);
                    });
            }
            var a = document.getElementById("basicLine");
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
            var n = document.getElementById("multiLine");
            if (n) {
                var l = echarts.init(n);
                l.setOption({
                        tooltip: {
                            trigger: "axis"
                        },
                        grid: {
                            top: "10%",
                            left: "3%",
                            right: "4%",
                            bottom: "3%",
                            containLabel: !0,
                        },
                        xAxis: {
                            type: "category",
                            data: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                            boundaryGap: !1,
                            axisLabel: {
                                color: "#999"
                            },
                            axisLine: {
                                color: "#999",
                                lineStyle: {
                                    color: "#999999"
                                }
                            },
                        },
                        yAxis: {
                            type: "value",
                            min: 65,
                            max: 110,
                            axisLine: {
                                show: !1
                            },
                            axisTick: {
                                show: !1
                            },
                        },
                        series: [{
                                name: "Alpha",
                                data: [70, 65, 85, 75, 95, 86, 93],
                                type: "line",
                                smooth: !0,
                                symbolSize: 8,
                                lineStyle: {
                                    color: "#ff5721",
                                    opacity: 1,
                                    width: 1.5
                                },
                                itemStyle: {
                                    color: "#fff",
                                    borderColor: "#ff5721",
                                    borderWidth: 1.5,
                                },
                            },
                            {
                                name: "Beta",
                                data: [80, 90, 75, 104, 75, 80, 70],
                                type: "line",
                                smooth: !0,
                                symbolSize: 8,
                                lineStyle: {
                                    color: "#5f6cc1",
                                    opacity: 1,
                                    width: 1.5
                                },
                                itemStyle: {
                                    color: "#fff",
                                    borderColor: "#5f6cc1",
                                    borderWidth: 1.5,
                                },
                            },
                            {
                                name: "Gama",
                                data: [110, 95, 102, 90, 105, 95, 108],
                                type: "line",
                                smooth: !0,
                                symbolSize: 10,
                                lineStyle: {
                                    color: "#4cae50",
                                    opacity: 1,
                                    width: 1.5
                                },
                                itemStyle: {
                                    color: "#fff",
                                    borderColor: "#4cae50",
                                    borderWidth: 1.5,
                                },
                            },
                        ],
                    }),
                    $(window).on("resize", function() {
                        setTimeout(function() {
                            l.resize();
                        }, 500);
                    });
            }
            var s = document.getElementById("basicBar");
            if (s) {
                var c = echarts.init(s);
                c.setOption({
                        grid: {
                            show: !1,
                            top: 5,
                            left: 0,
                            right: 0,
                            bottom: 0
                        },
                        color: ["#5f6bc2"],
                        tooltip: {
                            show: !0,
                            backgroundColor: "rgba(0, 0, 0, 0.8)"
                        },
                        xAxis: [{
                            type: "category",
                            axisTick: {
                                alignWithLabel: !0
                            },
                            splitLine: {
                                show: !1
                            },
                            axisLine: {
                                show: !1
                            },
                        }, ],
                        yAxis: [{
                            type: "value",
                            label: {
                                show: !1
                            },
                            axisLine: {
                                show: !1
                            },
                            splitLine: {
                                show: !1
                            },
                        }, ],
                        series: [{
                            data: [
                                400, 800, 325, 900, 700, 800, 400, 900, 800, 800, 300,
                                405, 500, 1100, 900, 1450, 1200, 1350, 1200, 1400, 1e3,
                                800, 950, 705, 690, 921, 1020, 903, 852, 630,
                            ],
                            label: {
                                show: !1,
                                color: "#0168c1"
                            },
                            type: "bar",
                            barWidth: "70%",
                            smooth: !0,
                        }, ],
                    }),
                    $(window).on("resize", function() {
                        setTimeout(function() {
                            c.resize();
                        }, 500);
                    });
            }
            var d = document.getElementById("multipleBar");
            if (d) {
                var m = echarts.init(d);
                m.setOption({
                        grid: {
                            show: !1,
                            left: "3%",
                            right: "4%",
                            bottom: "3%",
                            containLabel: !0,
                        },
                        legend: {
                            borderRadius: 0,
                            orient: "horizontal",
                            x: "right",
                            data: ["Online", "Offline"],
                        },
                        tooltip: {
                            show: !0,
                            backgroundColor: "rgba(0, 0, 0, 0.8)"
                        },
                        xAxis: [{
                            type: "category",
                            axisLabel: {
                                color: "#444"
                            },
                            axisTick: {
                                alignWithLabel: !0,
                                lineStyle: {
                                    color: "#aaa"
                                },
                                color: "#eee",
                            },
                            splitLine: {
                                show: !1
                            },
                            axisLine: {
                                show: !0,
                                lineStyle: {
                                    color: "#aaa"
                                }
                            },
                        }, ],
                        yAxis: [{
                            type: "value",
                            axisLabel: {
                                formatter: "${value}"
                            },
                            min: 0,
                            max: 1e5,
                            interval: 25e3,
                            axisLine: {
                                show: !1
                            },
                            splitLine: {
                                show: !0,
                                interval: "auto"
                            },
                            axisTick: {
                                show: !1,
                                color: "#eee"
                            },
                        }, ],
                        series: [{
                                name: "Series 1",
                                data: [
                                    35e3, 69e3, 22500, 6e4, 5e4, 5e4, 3e4, 8e4, 7e4, 6e4,
                                    2e4, 30005,
                                ],
                                label: {
                                    show: !1,
                                    color: "#0168c1"
                                },
                                type: "bar",
                                barGap: 0,
                                smooth: !0,
                            },
                            {
                                name: "Series 2",
                                data: [
                                    45e3, 82e3, 35e3, 93e3, 71e3, 89e3, 49e3, 91e3, 80200,
                                    86e3, 35e3, 40050,
                                ],
                                label: {
                                    show: !1,
                                    color: "#0168c1"
                                },
                                type: "bar",
                                smooth: !0,
                            },
                        ],
                    }),
                    $(window).on("resize", function() {
                        setTimeout(function() {
                            m.resize();
                        }, 500);
                    });
            }
            var f = document.getElementById("multipleBar2");
            if (f) {
                var h = echarts.init(f);
                h.setOption({
                        tooltip: {
                            trigger: "axis",
                            axisPointer: {
                                type: "shadow"
                            }
                        },
                        grid: {
                            top: "8%",
                            left: "3%",
                            right: "4%",
                            bottom: "3%",
                            containLabel: !0,
                        },
                        yAxis: {
                            type: "value",
                            min: 0,
                            max: 500,
                            interval: 100,
                            axisLabel: {
                                formatter: "{value}k",
                                color: "#333",
                                fontSize: 12,
                                fontStyle: "normal",
                                fontWeight: 400,
                            },
                            axisLine: {
                                show: !1,
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            axisTick: {
                                show: !1,
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            splitLine: {
                                lineStyle: {
                                    color: "#ddd",
                                    width: 1,
                                    opacity: 0.5
                                },
                            },
                        },
                        xAxis: {
                            type: "category",
                            boundaryGap: !0,
                            data: [
                                "Dec, 1",
                                "Dec, 2",
                                "Dec, 3",
                                "Dec, 4",
                                "Dec, 5",
                                "Dec, 6",
                                "Dec, 7",
                            ],
                            axisLabel: {
                                formatter: "{value}",
                                color: "#333",
                                fontSize: 12,
                                fontStyle: "normal",
                                fontWeight: 400,
                            },
                            axisLine: {
                                show: !1,
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            axisTick: {
                                show: !1,
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            splitLine: {
                                show: !1,
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                        },
                        series: [{
                                color: "#3182bd",
                                name: "Campaign",
                                type: "bar",
                                barGap: 0,
                                label: {
                                    normal: {
                                        show: !1,
                                        position: "insideBottom",
                                        distance: 5,
                                        align: "left",
                                        verticalAlign: "middle",
                                        rotate: 90,
                                        formatter: "{c}  {name|{a}}",
                                        fontSize: 14,
                                        fontWeight: "bold",
                                        rich: {
                                            name: {
                                                color: "#fff"
                                            }
                                        },
                                    },
                                },
                                data: [320, 332, 301, 334, 390, 350, 215],
                            },
                            {
                                color: "#74c475",
                                name: "Steppe",
                                type: "bar",
                                label: {
                                    normal: {
                                        show: !1,
                                        position: "insideBottom",
                                        distance: 5,
                                        align: "left",
                                        verticalAlign: "middle",
                                        rotate: 90,
                                        formatter: "{c}  {name|{a}}",
                                        fontSize: 14,
                                        fontWeight: "bold",
                                        rich: {
                                            name: {
                                                color: "#fff"
                                            }
                                        },
                                    },
                                },
                                data: [220, 182, 191, 234, 290, 190, 210],
                            },
                            {
                                color: "#e6550d",
                                name: "Desert",
                                type: "bar",
                                label: {
                                    normal: {
                                        show: !1,
                                        position: "insideBottom",
                                        distance: 5,
                                        align: "left",
                                        verticalAlign: "middle",
                                        rotate: 90,
                                        formatter: "{c}  {name|{a}}",
                                        fontSize: 14,
                                        fontWeight: "bold",
                                        rich: {
                                            name: {
                                                color: "#fff"
                                            }
                                        },
                                    },
                                },
                                data: [150, 232, 201, 154, 190, 150, 130],
                            },
                            {
                                color: "#756bb1",
                                name: "Wetland",
                                type: "bar",
                                label: {
                                    normal: {
                                        show: !1,
                                        position: "insideBottom",
                                        distance: 5,
                                        align: "left",
                                        verticalAlign: "middle",
                                        rotate: 90,
                                        formatter: "{c}  {name|{a}}",
                                        fontSize: 14,
                                        fontWeight: "bold",
                                        rich: {
                                            name: {
                                                color: "#fff"
                                            }
                                        },
                                    },
                                },
                                data: [98, 77, 101, 99, 40, 30, 50],
                            },
                        ],
                    }),
                    $(window).on("resize", function() {
                        setTimeout(function() {
                            h.resize();
                        }, 500);
                    });
            }

            // zoom line chart 
            var y = document.getElementById("zoomBar");
            if (y) {

                var b = echarts.init(y);
                b.setOption({
                        tooltip: {
                            trigger: "axis",
                            axisPointer: {
                                type: "shadow",
                                shadowStyle: {
                                    opacity: 0
                                }
                            },
                        },
                        grid: {
                            top: "8%",
                            left: "3%",
                            right: "4%",
                            bottom: "3%",
                            containLabel: !0,
                        },
                        xAxis: {
                            data: data.map(item => item.order_date),
                            // data: [
                            //     "1",
                            //     "02",
                            //     "03",
                            //     "04",
                            //     "05",
                            //     "06",
                            //     "07",
                            //     "08",
                            //     "09",
                            //     "10",
                            //     "11",
                            //     "12",
                            //     "13",
                            //     "14",
                            //     "15",
                            //     "16",
                            //     "17",
                            //     "18",
                            //     "19",
                            //     "20",
                            //     "21",
                            //     "22",
                            //     "23",
                            //     "24",
                            //     "25",
                            //     "26",
                            //     "27",
                            //     "28",
                            //     "29",
                            //     "30",
                            // ],
                            axisLabel: {
                                inside: !0,
                                textStyle: {
                                    color: "#fff"
                                }
                            },
                            axisTick: {
                                show: !1
                            },
                            axisLine: {
                                show: !1
                            },
                            z: 10,
                        },
                        yAxis: {
                            axisLine: {
                                show: !1
                            },
                            axisTick: {
                                show: !1
                            },
                            axisLabel: {
                                textStyle: {
                                    color: "#999"
                                }
                            },
                            splitLine: {
                                show: !1
                            },
                        },
                        dataZoom: [{
                            type: "inside"
                        }],
                        series: [{
                                name: "Total Orders",
                                type: "bar",
                                itemStyle: {
                                    normal: {
                                        color: "rgba(0,0,0,0.05)"
                                    }
                                },
                                barGap: "-100%",
                                barCategoryGap: "40%",
                                data: data.map(item => item.total_orders),
                                // data: [
                                //     500, 500, 500, 500, 500, 500, 500, 500, 500, 500, 500,
                                //     500, 500, 500, 500, 500, 500, 500, 500, 500, 500, 500,
                                //     500, 500, 500, 500, 500, 500, 500, 500,
                                // ],
                                animation: !1,
                            },
                            {
                                name: "Completed Orders",
                                type: "bar",
                                itemStyle: {
                                    normal: {
                                        color: new echarts.graphic.LinearGradient(
                                            0,
                                            0,
                                            0,
                                            1,
                                            [{
                                                    offset: 0,
                                                    color: "#83bff6"
                                                },
                                                {
                                                    offset: 0.5,
                                                    color: "#188df0"
                                                },
                                                {
                                                    offset: 1,
                                                    color: "#188df0"
                                                },
                                            ]
                                        ),
                                    },
                                    emphasis: {
                                        color: new echarts.graphic.LinearGradient(
                                            0,
                                            0,
                                            0,
                                            1,
                                            [{
                                                    offset: 0,
                                                    color: "#2378f7"
                                                },
                                                {
                                                    offset: 0.7,
                                                    color: "#2378f7"
                                                },
                                                {
                                                    offset: 1,
                                                    color: "#83bff6"
                                                },
                                            ]
                                        ),
                                    },
                                },
                                data: data.map(item => item.completed_orders),
                                // data: [
                                //     350, 182, 191, 234, 290, 330, 310, 123, 442, 321, 90,
                                //     149, 210, 122, 133, 334, 198, 123, 125, 220, 220, 182,
                                //     191, 234, 290, 330, 310, 123, 442, 212,
                                // ],
                            },
                        ],
                    }),
                    $(window).on("resize", function() {
                        setTimeout(function() {
                            b.resize();
                        }, 500);
                    });
            }
            var p = document.getElementById("basicDoughnut");
            if (p) {
                var u = echarts.init(p);
                u.setOption({
                        grid: {
                            left: "3%",
                            right: "4%",
                            bottom: "3%",
                            containLabel: !0
                        },
                        color: [
                            "#c13018",
                            "#f36e12",
                            "#ebcb37",
                            "#a1b968",
                            "#0d94bc",
                            "#135bba",
                        ],
                        tooltip: {
                            show: !1,
                            trigger: "item",
                            formatter: "{a} <br/>{b}: {c} ({d}%)",
                        },
                        xAxis: [{
                            axisLine: {
                                show: !1
                            },
                            splitLine: {
                                show: !1
                            }
                        }],
                        yAxis: [{
                            axisLine: {
                                show: !1
                            },
                            splitLine: {
                                show: !1
                            }
                        }],
                        series: [{
                            name: "Sessions",
                            type: "pie",
                            radius: ["50%", "85%"],
                            center: ["50%", "50%"],
                            avoidLabelOverlap: !1,
                            hoverOffset: 5,
                            label: {
                                normal: {
                                    show: !1,
                                    position: "center",
                                    textStyle: {
                                        fontSize: "13",
                                        fontWeight: "normal"
                                    },
                                    formatter: "{a}",
                                },
                                emphasis: {
                                    show: !0,
                                    textStyle: {
                                        fontSize: "15",
                                        fontWeight: "bold"
                                    },
                                    formatter: "{b} \n{c} ({d}%)",
                                },
                            },
                            labelLine: {
                                normal: {
                                    show: !1
                                }
                            },
                            data: [{
                                    value: 335,
                                    name: "Organic"
                                },
                                {
                                    value: 310,
                                    name: "Search Eng."
                                },
                                {
                                    value: 234,
                                    name: "Email"
                                },
                                {
                                    value: 135,
                                    name: "Referal"
                                },
                                {
                                    value: 148,
                                    name: "Social"
                                },
                                {
                                    value: 548,
                                    name: "Others"
                                },
                            ],
                            itemStyle: {
                                emphasis: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: "rgba(0, 0, 0, 0.5)",
                                },
                            },
                        }, ],
                    }),
                    $(window).on("resize", function() {
                        setTimeout(function() {
                            u.resize();
                        }, 500);
                    });
            }
            var w = document.getElementById("basicArea");
            if (w) {
                var g = echarts.init(w);
                g.setOption({
                        tooltip: {
                            trigger: "axis",
                            axisPointer: {
                                animation: !0
                            }
                        },
                        grid: {
                            left: "4%",
                            top: "4%",
                            right: "3%",
                            bottom: "10%"
                        },
                        xAxis: {
                            type: "category",
                            boundaryGap: !1,
                            data: [
                                "Jan",
                                "Feb",
                                "Mar",
                                "Apr",
                                "May",
                                "Jun",
                                "Jul",
                                "Aug",
                                "Sept",
                                "Oct",
                                "Nov",
                                "Dec",
                            ],
                            axisLabel: {
                                formatter: "{value}",
                                color: "#666",
                                fontSize: 12,
                                fontStyle: "normal",
                                fontWeight: 400,
                            },
                            axisLine: {
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            axisTick: {
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            splitLine: {
                                show: !1,
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                        },
                        yAxis: {
                            type: "value",
                            min: 0,
                            max: 200,
                            interval: 50,
                            axisLabel: {
                                formatter: "{value}k",
                                color: "#666",
                                fontSize: 12,
                                fontStyle: "normal",
                                fontWeight: 400,
                            },
                            axisLine: {
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            axisTick: {
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            splitLine: {
                                lineStyle: {
                                    color: "#ddd",
                                    width: 1,
                                    opacity: 0.5
                                },
                            },
                        },
                        series: [{
                            name: "Visit",
                            type: "line",
                            smooth: !0,
                            data: [
                                140, 135, 95, 115, 95, 126, 93, 145, 115, 140, 135, 95,
                                115, 95, 126, 125, 145, 115, 140, 135, 95, 115, 95, 126,
                                93, 145, 115, 140, 135, 95,
                            ],
                            symbolSize: 8,
                            showSymbol: !1,
                            lineStyle: {
                                color: "rgb(255, 87, 33)",
                                opacity: 1,
                                width: 1.5,
                            },
                            itemStyle: {
                                show: !1,
                                color: "#ff5721",
                                borderColor: "#ff5721",
                                borderWidth: 1.5,
                            },
                            areaStyle: {
                                normal: {
                                    color: {
                                        type: "linear",
                                        x: 0,
                                        y: 0,
                                        x2: 0,
                                        y2: 1,
                                        colorStops: [{
                                                offset: 0,
                                                color: "rgba(255, 87, 33, 1)",
                                            },
                                            {
                                                offset: 0.3,
                                                color: "rgba(255, 87, 33, 0.7)",
                                            },
                                            {
                                                offset: 1,
                                                color: "rgba(255, 87, 33, 0)",
                                            },
                                        ],
                                    },
                                },
                            },
                        }, ],
                    }),
                    $(window).on("resize", function() {
                        setTimeout(function() {
                            g.resize();
                        }, 500);
                    });
            }
            var x = document.getElementById("stackedArea");
            if (x) {
                var S = echarts.init(x);
                S.setOption({
                        tooltip: {
                            trigger: "axis",
                            axisPointer: {
                                animation: !0
                            }
                        },
                        grid: {
                            left: "4%",
                            top: "4%",
                            right: "3%",
                            bottom: "10%"
                        },
                        xAxis: {
                            type: "category",
                            boundaryGap: !1,
                            data: [
                                "Jan",
                                "Feb",
                                "Mar",
                                "Apr",
                                "May",
                                "Jun",
                                "Jul",
                                "Aug",
                                "Sept",
                                "Oct",
                                "Nov",
                                "Dec",
                            ],
                            axisLabel: {
                                formatter: "{value}",
                                color: "#666",
                                fontSize: 12,
                                fontStyle: "normal",
                                fontWeight: 400,
                            },
                            axisLine: {
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            axisTick: {
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            splitLine: {
                                show: !1,
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                        },
                        yAxis: {
                            type: "value",
                            min: 0,
                            max: 200,
                            interval: 50,
                            axisLabel: {
                                formatter: "{value}k",
                                color: "#666",
                                fontSize: 12,
                                fontStyle: "normal",
                                fontWeight: 400,
                            },
                            axisLine: {
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            axisTick: {
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            splitLine: {
                                lineStyle: {
                                    color: "#ddd",
                                    width: 1,
                                    opacity: 0.5
                                },
                            },
                        },
                        series: [{
                                name: "Visit",
                                type: "line",
                                smooth: !0,
                                data: [
                                    140, 135, 95, 115, 95, 126, 93, 145, 115, 140, 135, 95,
                                    115, 95, 126, 125, 145, 115, 140, 135, 95, 115, 95, 126,
                                    93, 145, 115, 140, 135, 95,
                                ],
                                symbolSize: 8,
                                showSymbol: !1,
                                lineStyle: {
                                    color: "rgb(255, 87, 33)",
                                    opacity: 1,
                                    width: 1.5,
                                },
                                itemStyle: {
                                    show: !1,
                                    color: "#ff5721",
                                    borderColor: "#ff5721",
                                    borderWidth: 1.5,
                                },
                                areaStyle: {
                                    normal: {
                                        color: {
                                            type: "linear",
                                            x: 0,
                                            y: 0,
                                            x2: 0,
                                            y2: 1,
                                            colorStops: [{
                                                    offset: 0,
                                                    color: "rgba(255, 87, 33, 1)",
                                                },
                                                {
                                                    offset: 0.3,
                                                    color: "rgba(255, 87, 33, 0.7)",
                                                },
                                                {
                                                    offset: 1,
                                                    color: "rgba(255, 87, 33, 0)",
                                                },
                                            ],
                                        },
                                    },
                                },
                            },
                            {
                                name: "Sales",
                                type: "line",
                                smooth: !0,
                                data: [
                                    50, 70, 65, 84, 75, 80, 70, 50, 70, 65, 104, 75, 80, 70,
                                    50, 70, 65, 94, 75, 80, 70, 50, 70, 65, 86, 75, 80, 70,
                                    50, 70,
                                ],
                                symbolSize: 8,
                                showSymbol: !1,
                                lineStyle: {
                                    color: "rgb(95, 107, 194)",
                                    opacity: 1,
                                    width: 1.5,
                                },
                                itemStyle: {
                                    color: "#5f6cc1",
                                    borderColor: "#5f6cc1",
                                    borderWidth: 1.5,
                                },
                                areaStyle: {
                                    normal: {
                                        color: {
                                            type: "linear",
                                            x: 0,
                                            y: 0,
                                            x2: 0,
                                            y2: 1,
                                            colorStops: [{
                                                    offset: 0,
                                                    color: "rgba(95, 107, 194, 1)",
                                                },
                                                {
                                                    offset: 0.5,
                                                    color: "rgba(95, 107, 194, 0.7)",
                                                },
                                                {
                                                    offset: 1,
                                                    color: "rgba(95, 107, 194, 0)",
                                                },
                                            ],
                                        },
                                    },
                                },
                            },
                        ],
                    }),
                    $(window).on("resize", function() {
                        setTimeout(function() {
                            S.resize();
                        }, 500);
                    });
            }
            var v = document.getElementById("stackedPointerArea1");
            if (v) {
                var L = echarts.init(v);
                L.setOption({
                        tooltip: {
                            trigger: "axis",
                            axisPointer: {
                                animation: !0
                            }
                        },
                        grid: {
                            left: "4%",
                            top: "4%",
                            right: "3%",
                            bottom: "10%"
                        },
                        xAxis: {
                            type: "category",
                            boundaryGap: !1,
                            data: [
                                "1",
                                "2",
                                "3",
                                "4",
                                "5",
                                "6",
                                "7",
                                "8",
                                "9",
                                "10",
                                "11",
                                "12",
                                "13",
                                "14",
                                "15",
                                "16",
                                "17",
                                "18",
                                "19",
                                "20",
                                "21",
                                "22",
                                "23",
                                "24",
                                "25",
                                "26",
                                "27",
                                "28",
                                "29",
                                "30",
                            ],
                            axisLabel: {
                                formatter: "{value}",
                                color: "#666",
                                fontSize: 12,
                                fontStyle: "normal",
                                fontWeight: 400,
                            },
                            axisLine: {
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            axisTick: {
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            splitLine: {
                                show: !1,
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                        },
                        yAxis: {
                            type: "value",
                            min: 0,
                            max: 200,
                            interval: 50,
                            axisLabel: {
                                formatter: "{value}k",
                                color: "#666",
                                fontSize: 12,
                                fontStyle: "normal",
                                fontWeight: 400,
                            },
                            axisLine: {
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            axisTick: {
                                lineStyle: {
                                    color: "#ccc",
                                    width: 1
                                }
                            },
                            splitLine: {
                                lineStyle: {
                                    color: "#ddd",
                                    width: 1,
                                    opacity: 0.5
                                },
                            },
                        },
                        series: [{
                                name: "Orders",
                                type: "line",
                                smooth: !0,
                                data: [
                                    140, 135, 95, 115, 95, 126, 93, 145, 115, 140, 135, 95,
                                    115, 95, 126, 125, 145, 115, 140, 135, 95, 115, 95, 126,
                                    93, 145, 115, 140, 135, 95,
                                ],
                                symbolSize: 8,
                                lineStyle: {
                                    color: "rgb(255, 87, 33)",
                                    opacity: 1,
                                    width: 1.5,
                                },
                                itemStyle: {
                                    color: "#ff5721",
                                    borderColor: "#ff5721",
                                    borderWidth: 1.5,
                                },
                                areaStyle: {
                                    normal: {
                                        color: {
                                            type: "linear",
                                            x: 0,
                                            y: 0,
                                            x2: 0,
                                            y2: 1,
                                            colorStops: [{
                                                    offset: 0,
                                                    color: "rgba(255, 87, 33, 1)",
                                                },
                                                {
                                                    offset: 0.3,
                                                    color: "rgba(255, 87, 33, 0.7)",
                                                },
                                                {
                                                    offset: 1,
                                                    color: "rgba(255, 87, 33, 0)",
                                                },
                                            ],
                                        },
                                    },
                                },
                            },
                            {
                                name: "Sales",
                                type: "line",
                                smooth: !0,
                                data: [
                                    50, 70, 65, 84, 75, 80, 70, 50, 70, 65, 104, 75, 80, 70,
                                    50, 70, 65, 94, 75, 80, 70, 50, 70, 65, 86, 75, 80, 70,
                                    50, 70,
                                ],
                                symbolSize: 8,
                                lineStyle: {
                                    color: "rgb(95, 107, 194)",
                                    opacity: 1,
                                    width: 1.5,
                                },
                                itemStyle: {
                                    color: "#5f6cc1",
                                    borderColor: "#5f6cc1",
                                    borderWidth: 1.5,
                                },
                                areaStyle: {
                                    normal: {
                                        color: {
                                            type: "linear",
                                            x: 0,
                                            y: 0,
                                            x2: 0,
                                            y2: 1,
                                            colorStops: [{
                                                    offset: 0,
                                                    color: "rgba(95, 107, 194, 1)",
                                                },
                                                {
                                                    offset: 0.5,
                                                    color: "rgba(95, 107, 194, 0.7)",
                                                },
                                                {
                                                    offset: 1,
                                                    color: "rgba(95, 107, 194, 0)",
                                                },
                                            ],
                                        },
                                    },
                                },
                            },
                        ],
                    }),
                    $(window).on("resize", function() {
                        setTimeout(function() {
                            L.resize();
                        }, 500);
                    });
            }

        });
    </script>
@endsection
