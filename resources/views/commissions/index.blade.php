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
            padding-top: 8px;
            padding-bottom: 8px;
            padding-right: 60px;
            padding-left: 10px;
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
        <button class="popup-button btn btn-primary col-md-1"
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Product
            Filters</button><br><br>
        <div class="filter-card" id="filterCard">
            <form action="{{ route('order_details') }}" method="GET">
                <button type="submit" class="btn btn-secondary" style="margin-left: 1200px">Submit</button>
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
                                            <input type="checkbox" value="{{ $orders->vendor->name ?? null }}">
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
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
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
                                <input type="text" id="searchInput" onkeyup="filterOptions()"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $value => $orders)
                                        <label class="nameFilter">
                                            <input type="checkbox" value="{{ $orders->product->name ?? null }}">
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
                                <p class="text-left">Model No#</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <input type="text" id="searchInput" onkeyup="filterOptions()"
                                    placeholder="Search...">
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

                    <div class="col-md-3">
                        <div class="content-box">
                            <input type="number" name="commissionAmount[]" min="1" max="500"
                                placeholder="Commission" id="quantity">
                        </div>
                    </div>

                </div>

                <div class="row d-flex" style="margin-top: 10px; margin-bottom: 150px">
                    <div class="col-md-3">
                        <div class="content-box d-flex">
                            <div class="input-bar">
                                <label for="priceInput3">Enter Price:</label>
                                <input type="number" id="priceInput3" min="0" max="100000" value="100"
                                    oninput="updatePriceSlider(this.value, 'rangeValue3')">
                            </div>
                            <div class="slider"><b>Price</b>
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

                    function toggleFilters() {
                        var filterCard = document.getElementById("filterCard");
                        if (filterCard.style.display === "none") {
                            filterCard.style.display = "block";
                        } else {
                            filterCard.style.display = "none";
                        }
                    }
                </script>
        </div>
    </div>
    <?php
    $total_commission1 = 0;
    $total_product_price1 = 0;
    $totalTax1 = 0;
    ?>
    @foreach ($data as $value => $orders)
        <tr style="display: none">

            <?php
            $product_price = $orders->p_price;
            $commissionAmount = ($orders->product->subcategories->commission / 100) * $product_price;
            $total_commission1 += $commissionAmount;

            $TaxAmount = ($orders->product->tax_charges / 100) * $product_price;
            $totalTax1 += $TaxAmount;
            ?>
            <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->

        </tr>
    @endforeach
    <div class="row">
        <div class="">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-title" style=" margin-left: -20px; ">Commission Chart</div>
                        </div>
                        <div class="col-6">
                            <div class="card-title" style=" text-align: end; ">Total Commission Charged:
                                ${{ $total_commission1 }}
                            </div>
                        </div>
                    </div>
                    <div id="columnDataLabel"
                        style="height: 300px; -webkit-tap-highlight-color: transparent; user-select: none; position: relative;"
                        _echarts_instance_="ec_1709707664532">


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="breadcrumb">
        <h1>Commissions Management</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">All Commissions</h4>

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
                            <th>Product Commission %</th>
                            <th>Product Price</th>
                            <th>Commission Charges</th>
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
                                    <td>{{ $orders->product->subcategories->commission ?? null }}%
                                    </td>

                                    <?php
                                    $product_price = $orders->p_price;
                                    $commissionAmount = ($orders->product->subcategories->commission / 100) * $product_price;
                                    $total_commission += $commissionAmount;

                                    $TaxAmount = ($orders->product->tax_charges / 100) * $product_price;
                                    $totalTax += $TaxAmount;
                                    ?>
                                    <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->
                                    <td>${{ $orders->p_price ?? null }} </td>
                                    <?php
                                    $total_product_price += $orders->p_price;
                                    ?>

                                    <td>-${{ $commissionAmount }}</td>
                                    <td>{{ $orders->created_at }}</td>
                                    <td>
                                        <img src="{{ $orders->product->url ?? null }}  " width="50" height="50"
                                            loading="lazy" alt="Placeholder Image">
                                    </td>


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
                                <th>Product Commission %</th>
                                <th>Product Price</th>
                                <th>Commission Charges</th>
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
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
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
@endsection
