@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" /> --}}
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
            margin-left: 0px;
        }

        .datetimerange {
            border-color: #ccc !important;
            max-width: 350px;
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
    </style>
    <div class="card-body">
        <button  class="btn btn-outline-secondary ladda-button example-button m-1" data-style="expand-left" onclick="toggleFilters()">Sales
            Filters</button><br><br>
        <div class="filter-card" id="filterCard" style="display: none;">
            <form action="{{ route('order_details') }}" method="GET">
                <button type="submit" class="btn btn-secondary" style="margin-left: 1000px">Submit</button>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Order ID</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $value => $orders)
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
                                <p class="text-left">Parcel ID</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $value => $orders)
                                        <label class="idFilter">
                                            <input type="checkbox" value="{{ $orders->id }}">
                                            <span class="option-text">{{ $orders->id }}</span>
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
                                <p class="text-left ">Supplier Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $value => $orders)
                                        <label class="nameFilter">
                                            <input type="checkbox"
                                                value="{{ $orders->vendor->name ?? null }}">
                                            <span class="option-text">{{ $orders->vendor->name ?? null }}</span>
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
                                <p class="text-left">Customer Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <input type="text" id="searchInput" onkeyup="filterOptions()"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $value => $orders)
                                        <label class="customer_nameFilter">
                                            <input type="checkbox"
                                                value="{{ $orders->order->first_name ?? null }} {{ $orders->order->last_name ?? null }}">
                                            <span class="option-text">{{ $orders->order->first_name ?? null }}
                                                {{ $orders->order->last_name ?? null }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton3" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Product Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $value => $orders)
                                        <label class="nameFilter">
                                            <input type="checkbox"
                                                value="{{ $orders->product->name ?? null }}">
                                            <span class="option-text">{{ $orders->product->name ?? null }}</span>
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
                                <p class="text-left ">Model No#</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $value => $orders)
                                        <label class="model_noFilter">
                                            <input type="checkbox"value="{{ $orders->product->model_no ?? null }}">
                                            <span class="option-text">{{ $orders->product->model_no ?? null }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
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

                <div class="row d-flex" style="margin-top: 10px; margin-bottom: 150px">
                    <div class="col-md-3">
                        <div class="content-box d-flex">
                            <div class="input-bar">
                                <label for="priceInput3">Enter Price:</label>
                                <input type="number" id="priceInput3" min="0" max="100000" value="100"
                                    oninput="updatePriceSlider(this.value, 'rangeValue3')">
                            </div>
                            <div class="slider"><b>ReturnDays:</b>
                                <label for="fader"></label><input type="range" min="0" max="100"
                                    value="50" id="fader" step="20" list="volsettings"
                                    oninput="updatePriceValue(this.value, 'rangeValue3')">
                                <p id="rangeValue3">100</p>
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

                    <div class="col-md-3" style="margin-left: 50px;">
                        <div class="content-box d-flex">
                            <div class="input-bar" style="margin-left: 250px;">
                                <label for="priceInput4">Enter Price:</label>
                                <input type="number" id="priceInput4" min="0" max="1000000" value="100"
                                    oninput="updatePriceSlider(this.value, 'rangeValue4')">
                            </div>
                            <div class="slider"><b>WarrantyDays:</b>
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
                </script>


        <script>
            function updatePriceValue(value, targetId) {
                document.getElementById(targetId).innerText = value;
            }
            </script>

        </div>
    </div>


    <div class="row">
        <div class="">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6"><div class="card-title" style=" margin-left: 0px; "><h4>Sale Chart</h4></div></div>
                        <div class="col-6"><div class="card-title" style=" text-align: end; ">Total Sale: {{$totalSale}} </div></div>
                    </div>
                    <div id="zoomableLine-chart1"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="breadcrumb">
        <h1>All Sales</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">All Sales</h4>

                {{-- <p>All Orders list is below.</p> --}}

                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%;">
                        <thead>
                            {{-- <th>Sr No</th> --}}
                            <th>Order Id#</th>
                            <th>Parcel Id #</th>
                            <th>Vendor Name</th>
                            <th>Customer Name</th>
                            <th>Product Name</th>
                            <th>Product Model</th>
                            <th>Product Sku</th>
                            <th>Product Commission</th>
                            <th>Product Price</th>
                            <th>Order Date</th>
                            {{-- <th>Shipping Date</th> --}}
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $total_commission = 0;
                            $total_product_price = 0;
                            $totalTax = 0;
                            ?>
                            @foreach ($data as $value => $orders)
                                <tr>

                                    {{-- <td>{{ $value + 1 }}</td> --}}

                                    <td>{{ $orders->order_id }}</td>
                                    <td>{{ $orders->id }}</td>
                                    <td>{{ $orders->vendor->name ?? null }}</td>
                                    <td>{{ $orders->order->first_name ?? null }} {{ $orders->order->last_name ?? null }}
                                    </td>

                                    <td>{{ $orders->product->name ?? null }} </td>
                                    <td>{{ $orders->product->model_no ?? null }} </td>

                                    <td>{{ $orders->product->sku ?? null }} </td>
                                    <td>{{ $orders->product->subcategories->commission ?? null }}% </td>

                                    <?php
                                    if($orders->status === 'Delivered'){

                                    $product_price = $orders->p_price;
                                    $commissionAmount = ($orders->product->subcategories->commission / 100) * $product_price;
                                    $total_commission += $commissionAmount;

                                    $TaxAmount = ($orders->product->tax_charges / 100) * $product_price;
                                    $totalTax += $TaxAmount;
                                    }
                                    ?>
                                    <td>${{ $orders->p_price ?? null }} </td>

                                    <?php
                                    if($orders->status === 'Delivered'){
                                    $total_product_price += $orders->p_price;
                                }
                                    ?>
                                    {{-- <td>{{ $orders->first_name }}</td> --}}

                                    {{-- <td>{{ $orders->last_name }}</td> --}}

                                    <td>{{ $orders->created_at }}</td>
                                    <td>
                                        <img src="{{ $orders->product->url ?? null }}  " width="50" height="50"
                                            loading="lazy" alt="Placeholder Image">
                                    </td>
                                    {{-- <td>{{ $orders->shipping }}</td> --}}
                                    {{-- <td>
                                    @if ($orders->product)
                                    @if ($orders->product->url)
                                    <img src="{{ $product->product_image->url }}" width="50" height="50" loading="lazy" alt="Placeholder Image" - Order ID:
                                {{ $orders->id }}">
                                <p>Order ID: {{ $orders->id }}</p>
                                @else
                                @if ($orders->product->product_image)
                                <img src="{{ $product->product_image->url }}" width="50" height="50" loading="lazy" alt="Placeholder Image" - Order ID:
                                    {{ $orders->id }}">
                                <p>Order ID: {{ $orders->id }}</p>
                                @endif
                                @endif
                                @else
                                <img src="{{ asset('path-to-your-placeholder-image.jpg') }}" loading="lazy" width="50" height="50" alt="Placeholder Image">
                                <p>No image available</p>
                                @endif
                                </td> --}}

                                    <td>
                                        <div class="btn btn-outline-secondary ladda-button example-button m-1">
                                            {{ $orders->status }}</div>
                                    </td>

                                    <td>
                                        <a href="{{ url('get_order_detail_status/' . $orders->id) }}"
                                            class="btn btn-outline-secondary">Details</a>
                                    </td>



                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                {{-- <th>Sr No</th> --}}
                                <th>Order Id#</th>
                                <th>Parcel Id #</th>
                                <th>Vendor Name</th>
                                <th>Customer Name</th>
                                <th>Product Name</th>
                                <th>Product Model</th>
                                <th>Product Sku</th>
                                <th>Product Commission</th>
                                <th>Product Price</th>
                                <th>Order Date</th>
                                {{-- <th>Shipping Date</th> --}}
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>


            </div>
        </div>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">


            <div class="card-body">
                <h4 class="card-title mb-3">Amount</h4>


                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%;">
                        <thead>

                            <th>Total Product Price</th>
                            <th>Total Product Tax</th>
                            <th>Total Commision</th>
                            <th>Grand Total(You Earn)</th>
                        </thead>
                        <tbody>

                            <tr>
                                <td>+${{ $total_product_price }}</td>
                                <td>+${{ $totalTax }}</td>
                                <td>-${{ $total_commission }}</td>
                                <td>${{ $total_product_price - $total_commission }}</td>

                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total Product Price</th>
                                <th>Total Product Tax</th>
                                <th>Total Commision</th>
                                <th>Grand Total(You Earn)</th>



                            </tr>
                        </tfoot>
                    </table>
                </div>


            </div>
        </div>
    </div>
    @endsection

@section('page-js')
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
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
        $(document).ready(function() {
            var e = {
                chart: {
                    height: 350,
                    type: "line",
                    zoom: {
                        enabled: !1
                    },
                    toolbar: {
                        show: !0
                    },
                },
                tooltip: {
                    enabled: !0,
                    shared: !0,
                    followCursor: !1,
                    intersect: !1,
                    inverseOrder: !1,
                    custom: void 0,
                    fillSeriesColor: !1,
                    theme: !1,
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    curve: "smooth"
                },
                series: [{
                    name: "Desktops",
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                }, ],
                grid: {
                    row: {
                        colors: ["#f3f3f3", "transparent"],
                        opacity: 0.5
                    }
                },
                xaxis: {
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                    ],
                },
            };
            new ApexCharts(document.querySelector("#basicLine-chart"), e).render();
            e = {
                chart: {
                    height: 350,
                    type: "line",
                    shadow: {
                        enabled: !0,
                        color: "#000",
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 1,
                    },
                    toolbar: {
                        show: !1
                    },
                    animations: {
                        enabled: !0,
                        easing: "linear",
                        speed: 500,
                        animateGradually: {
                            enabled: !0,
                            delay: 150
                        },
                        dynamicAnimation: {
                            enabled: !0,
                            speed: 550
                        },
                    },
                },
                colors: ["#77B6EA", "#545454"],
                dataLabels: {
                    enabled: !0
                },
                stroke: {
                    curve: "smooth"
                },
                series: [{
                        name: "High - 2013",
                        data: [28, 29, 33, 36, 32, 32, 33]
                    },
                    {
                        name: "Low - 2013",
                        data: [12, 11, 14, 18, 17, 13, 13]
                    },
                ],
                grid: {
                    borderColor: "#e7e7e7",
                    row: {
                        colors: ["#f3f3f3", "transparent"],
                        opacity: 0.5
                    },
                },
                markers: {
                    size: 6
                },
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
                    title: {
                        text: "Month"
                    },
                },
                yaxis: {
                    title: {
                        text: "Temperature"
                    },
                    min: 5,
                    max: 40
                },
                legend: {
                    position: "top",
                    horizontalAlign: "right",
                    floating: !0,
                    offsetY: -25,
                    offsetX: -5,
                },
            };
            new ApexCharts(
                document.querySelector("#lineChartWIthDataLabel"),
                e
            ).render();
            for (var t = 14844186e5, a = [], r = 0; r < 120; r++) {
                var o = [(t += 864e5), dataSeries[1][r].value];
                a.push(o);
            }
            e = {
                chart: {
                    type: "area",
                    stacked: !1,
                    height: 350,
                    zoom: {
                        type: "x",
                        enabled: !0
                    },
                    toolbar: {
                        autoSelected: "zoom"
                    },
                },
                dataLabels: {
                    enabled: !1
                },
                series: [{
                    name: "XYZ MOTORS1",
                    data: a
                }],
                markers: {
                    size: 0
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: 0.5,
                        opacityTo: 0,
                        stops: [0, 90, 100],
                    },
                },
                yaxis: {
                    min: 2e7,
                    max: 25e7,
                    labels: {
                        formatter: function(e) {
                            return (e / 1e6).toFixed(0);
                        },
                    },
                    title: {
                        text: "Price"
                    },
                },
                xaxis: {
                    type: "datetime"
                },
                tooltip: {
                    shared: !1,
                    y: {
                        formatter: function(e) {
                            return (e / 1e6).toFixed(0);
                        },
                    },
                },
            };
            new ApexCharts(document.querySelector("#zoomableLine-chart1"), e).render();
            e = {
                chart: {
                    height: 350,
                    type: "line",
                    dropShadow: {
                        enabled: !0,
                        top: 3,
                        left: 3,
                        blur: 1,
                        opacity: 0.2
                    },
                },
                stroke: {
                    width: 7,
                    curve: "smooth"
                },
                series: [{
                    name: "Likes",
                    data: [
                        4, 3, 10, 9, 29, 19, 22, 9, 12, 7, 19, 5, 13, 9, 17, 2, 7,
                        5,
                    ],
                }, ],
                xaxis: {
                    type: "datetime",
                    categories: [
                        "1/11/2000",
                        "2/11/2000",
                        "3/11/2000",
                        "4/11/2000",
                        "5/11/2000",
                        "6/11/2000",
                        "7/11/2000",
                        "8/11/2000",
                        "9/11/2000",
                        "10/11/2000",
                        "11/11/2000",
                        "12/11/2000",
                        "1/11/2001",
                        "2/11/2001",
                        "3/11/2001",
                        "4/11/2001",
                        "5/11/2001",
                        "6/11/2001",
                    ],
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        gradientToColors: ["#FDD835"],
                        shadeIntensity: 1,
                        type: "horizontal",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100],
                    },
                },
                markers: {
                    size: 4,
                    opacity: 0.9,
                    colors: ["#FFA41B"],
                    strokeColor: "#fff",
                    strokeWidth: 2,
                    hover: {
                        size: 7
                    },
                },
                yaxis: {
                    min: -10,
                    max: 40,
                    title: {
                        text: "Engagement"
                    }
                },
            };
            new ApexCharts(document.querySelector("#gradientLineChart"), e).render();
            var n = 0,
                i = [];
            !(function(e, t, a) {
                for (var r = 0; r < t;) {
                    var o = e,
                        s = Math.floor(Math.random() * (a.max - a.min + 1)) + a.min;
                    i.push({
                        x: o,
                        y: s
                    }), (n = e), (e += 864e5), r++;
                }
            })(new Date("11 Feb 2017 GMT").getTime(), 10, {
                min: 10,
                max: 90
            });
            e = {
                chart: {
                    height: 350,
                    type: "line",
                    animations: {
                        enabled: !0,
                        easing: "linear",
                        dynamicAnimation: {
                            speed: 2e3
                        },
                    },
                    toolbar: {
                        show: !1
                    },
                    zoom: {
                        enabled: !1
                    },
                    dropShadow: {
                        enabled: !0,
                        top: 3,
                        left: 3,
                        blur: 1,
                        opacity: 0.2
                    },
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    curve: "smooth"
                },
                series: [{
                    data: i
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        gradientToColors: ["#FDD835"],
                        shadeIntensity: 1,
                        type: "horizontal",
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100, 100, 100],
                    },
                },
                markers: {
                    size: 0
                },
                xaxis: {
                    type: "datetime",
                    range: 7776e5
                },
                yaxis: {
                    max: 100
                },
                legend: {
                    show: !1
                },
            };
            var s = new ApexCharts(document.querySelector("#realTimeLine-chart"), e);
            s.render();
            window.setInterval(function() {
                    var e, t;
                    (e = {
                        min: 10,
                        max: 90
                    }),
                    (n = t = n + 864e5),
                    i.push({
                            x: t,
                            y: Math.floor(Math.random() * (e.max - e.min + 1)) + e.min,
                        }),
                        s.updateSeries([{
                            data: i
                        }]);
                }, 2e3),
                window.setInterval(function() {
                    (i = i.slice(i.length - 10, i.length)),
                    s.updateSeries([{
                        data: i
                    }], !1, !0);
                }, 6e4);
            e = {
                chart: {
                    height: 350,
                    type: "line",
                    zoom: {
                        enabled: !1
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    width: [5, 7, 5],
                    curve: "smooth",
                    dashArray: [0, 8, 5]
                },
                series: [{
                        name: "Session Duration",
                        data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10],
                    },
                    {
                        name: "Page Views",
                        data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35],
                    },
                    {
                        name: "Total Visits",
                        data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47],
                    },
                ],
                markers: {
                    size: 0,
                    hover: {
                        sizeOffset: 6
                    }
                },
                xaxis: {
                    categories: [
                        "01 Jan",
                        "02 Jan",
                        "03 Jan",
                        "04 Jan",
                        "05 Jan",
                        "06 Jan",
                        "07 Jan",
                        "08 Jan",
                        "09 Jan",
                        "10 Jan",
                        "11 Jan",
                        "12 Jan",
                    ],
                },
                tooltip: {
                    y: [{
                            title: {
                                formatter: function(e) {
                                    return e + " (mins)";
                                },
                            },
                        },
                        {
                            title: {
                                formatter: function(e) {
                                    return e + " per session";
                                },
                            },
                        },
                        {
                            title: {
                                formatter: function(e) {
                                    return e;
                                },
                            },
                        },
                    ],
                },
                grid: {
                    borderColor: "#f1f1f1"
                },
            };
            new ApexCharts(document.querySelector("#dashedLineChart"), e).render();
            var d = {
                chart: {
                    id: "chart2",
                    type: "line",
                    height: 230,
                    toolbar: {
                        autoSelected: "pan",
                        show: !1
                    },
                },
                colors: ["#546E7A"],
                stroke: {
                    width: 3
                },
                dataLabels: {
                    enabled: !1
                },
                fill: {
                    opacity: 1
                },
                markers: {
                    size: 0
                },
                series: [{
                    data: (i = (function(e, t, a) {
                        var r = 0,
                            o = [];
                        for (; r < t;) {
                            var n = e,
                                i =
                                Math.floor(
                                    Math.random() * (a.max - a.min + 1)
                                ) + a.min;
                            o.push([n, i]), (e += 864e5), r++;
                        }
                        return o;
                    })(new Date("11 Feb 2017").getTime(), 185, {
                        min: 30,
                        max: 90,
                    })),
                }, ],
                xaxis: {
                    type: "datetime"
                },
            };
            new ApexCharts(document.querySelector("#chart-line2"), d).render();
            e = {
                chart: {
                    id: "chart1",
                    height: 130,
                    type: "area",
                    brush: {
                        target: "chart2",
                        enabled: !0
                    },
                    selection: {
                        enabled: !0,
                        xaxis: {
                            min: new Date("19 Jun 2017").getTime(),
                            max: new Date("14 Aug 2017").getTime(),
                        },
                    },
                },
                colors: ["#008FFB"],
                series: [{
                    data: i
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.91,
                        opacityTo: 0.1
                    },
                },
                xaxis: {
                    type: "datetime",
                    tooltip: {
                        enabled: !1
                    }
                },
                yaxis: {
                    tickAmount: 2
                },
            };
            new ApexCharts(document.querySelector("#brushLine-chart"), e).render();
        });
    </script>
@endsection
