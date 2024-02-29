@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
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
            margin-right: 0px;
            overflow: hidden;
            margin-left: 0px;
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
            margin-left: 150px;
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

    </style>
    <div class="card-body">
        <button class="popup-button btn btn-primary col-md-1"
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Product
            Filters</button><br><br>
        <div class="filter-card" id="filterCard">
            <div class="row" >
                <div class="col-md-3">
                    <form action="{{ route('order_details') }}" method="GET">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Supplier Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
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

                    </form>
                </div>
                <div class="col-md-3">
                    <form action="{{ route('order_details') }}" method="GET">
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
                    </form>
                </div>
                <div class="col-md-3">
                    <form action="{{ route('order_details') }}" method="GET">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton3" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Product Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $value => $orders)
                                        <label class="product_nameFilter">
                                            <input type="checkbox" value="{{ $orders->product->name ?? null }}">
                                            <span class="option-text">{{ $orders->product->name ?? null }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-3">
                    <div class="content-box">
                        <form action="{{ route('order_details') }}" method="GET">
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

            <div class="row">
                <div class="col-md-3">
                    <form action="{{ route('order_details') }}" method="GET">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Model No</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $value => $orders)
                                        <label class="model_noFilter">
                                            <input type="checkbox" value="{{ $orders->product->model_no ?? null }}">
                                            <span class="option-text">{{ $orders->product->model_no ?? null }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-md-3">
                    <form action="{{ route('order_details') }}" method="GET">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">SKU #</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $value => $orders)
                                        <label class="skuFilter">
                                            <input type="checkbox" value="{{ $orders->product->sku ?? null }}">
                                            <span class="option-text">{{ $orders->product->sku ?? null }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-md-3">
                    <div class="content-box">
                        <form action="{{ route('products.index') }}" method="GET">
                            <div class="slider"><b>Price:</b>
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
                        </form>
                    </div>
                </div>

                <script>
                    function updatePriceValue(value, targetId) {
                        document.getElementById(targetId).innerText = value;
                    }
                </script>
            </div>
        </div>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="breadcrumb">
        <h1>All Parcels</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">All Parcels</h4>

                {{-- <p>All Orders list is below.</p> --}}

                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%;">
                        <thead>
                           
                            <th>Order Id#</th>
                            <th>Parcel Id #</th>
                            <th>Image</th>
                            <th>Product Details</th>
                            <th>Order Date</th>
                            <th>Customer Name</th>
                            <th>Customer Status</th>
                            <th>Current Status</th>
                            <th>Update Status</th>
                            <th>View Status</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $value => $orders)
                                <tr>
                                    <td>{{ $orders->order_id }}</td>
                                    <td>{{ $orders->id }}</td>
                                    <td>
                                        <img src="{{ $orders->product->url ?? null }}  " width="50" height="50"
                                            loading="lazy" alt="Placeholder Image">
                                    </td>
                                    <td style="width:250px">

                                        <span style=" font-weight: 600; ">Name:
                                            {{ $orders->product->name ?? null }} </span> <br>
                                        <span style=" font-weight: 600; ">Model #:
                                        </span>{{ $orders->product->model_no ?? null }}<br>
                                        <span style=" font-weight: 600; ">SKU:
                                        </span>{{ $orders->product->sku ?? null }}<br>
                                        <span style=" font-weight: 600; ">Supplier:
                                        </span>{{ $orders->vendor->name ?? null }}<br>
                                        <span style=" font-weight: 600; ">Price:
                                        </span>${{ $orders->p_price ?? null }}<br>


                                    </td>

                                    {{-- <td>{{ $orders->vendor->name ?? null }}</td> --}}


                                    <td>{{ $orders->created_at }}</td>

                                    <td>{{ $orders->order->first_name ?? null }} {{ $orders->order->last_name ?? null }}
                                    </td>
                                    <td style="width:110px">
                                        @if ($orders->customer_cancel_status == 'Canceled')
                                            <span class="badge-for-cancel">{{ $orders->customer_cancel_status }}
                                            </span><br>
                                            {{ $orders->customer_cancel_time }}<br>
                                            <span style=" font-weight: 700; ">Type:
                                            </span>Customer <br>
                                            <span style=" font-weight: 700; ">Reason:
                                            </span>{{ $orders->customer_cancel_reason }} 
                                             
                                        @else
                                        {{-- @if($orders->status == 'Canceled')
                                        <span class="badge-for-success" selected
                                                disabled>{{ $orders->status }}</span><br>
                                            {{ $orders->updated_at }} <br> 
                                            <span style=" font-weight: 700; ">Type:
                                            </span>Supplier
                                        @else
                                        
                                        <span class="badge-for-success" selected
                                        disabled>{{ $orders->status }}</span><br>
                                    {{ $orders->updated_at }}
                                        @endif
                                             --}}
                                        @endif
                                    </td>
                                    <td style="width:110px">
                                        @if ($orders->customer_cancel_status == 'Canceled')
                                            <span class="badge-for-light" selected
                                                disabled>{{ $orders->status }}</span><br>
                                            {{ $orders->updated_at }} <br>
                                        @elseif ($orders->status == 'Canceled')
                                            <span class="badge-for-light" selected
                                                disabled>{{ $orders->status }}</span><br>
                                            {{ $orders->updated_at }} <br>
                                            {{-- <span style=" font-weight: 700; ">Reason:
                                            </span>My Mistake --}}
                                        @else
                                            <span class="badge-for-success" selected
                                                disabled>{{ $orders->status }}</span><br>
                                            {{ $orders->updated_at }}
                                        @endif
                                    </td>
                                    @if ($orders->customer_cancel_status == 'Canceled')
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton{{ $orders->id }}" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    {{ $orders->status }}
                                                </button>
                                                <div class="dropdown-menu"
                                                    aria-labelledby="dropdownMenuButton{{ $orders->id }}">

                                                    <a class="dropdown-item" href="#">Can't Update More Status</a>

                                                </div>
                                            </div>
                                        </td>
                                    @else
                                        <td>
                                            <form method="POST" id="orderForm{{ $orders->id }}"
                                                action="{{ route('order_details_status', ['id' => $orders->id]) }}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton{{ $orders->id }}" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        {{ $orders->status }}
                                                    </button>
                                                    <div class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton{{ $orders->id }}">
                                                        @php
                                                            $isInProcess = false;
                                                            $isInPackaging = false;
                                                            $isInOutForDelivery = false;
                                                            $isInDelivered = false;
                                                            $isInFailedToDeliver = false;
                                                            $isInCanceled = false;
                                                            foreach ($orders->order_tracker as $tracker) {
                                                                if ($tracker->status == 'In Process') {
                                                                    $isInProcess = true;
                                                                }
                                                                if ($tracker->status == 'Packaging') {
                                                                    $isInPackaging = true;

                                                                }if ($tracker->status == 'Out For Delivery') {
                                                                    $isInOutForDelivery = true;

                                                                }if ($tracker->status == 'Delivered') {
                                                                    $isInDelivered = true;

                                                                }if ($tracker->status == 'Failed to Deliver') {
                                                                    $isInFailedToDeliver = true;

                                                                }if ($tracker->status == 'Canceled') {
                                                                    $isInProcess = true;
                                                                    $isInPackaging = true;
                                                                    $isInOutForDelivery = true;
                                                                    $isInDelivered = true;
                                                                    $isInFailedToDeliver = true;
                                                                    $isInCanceled = true;
                                                                } 

                                                            }
                                                        @endphp
                                                        @if (!$isInProcess)
                                                            <a class="dropdown-item"
                                                                onclick="updateOrderStatus('{{ $orders->id }}', 'In Process')">In
                                                                Process</a>
                                                        @endif
                                                        @if (!$isInPackaging)
                                                            <a class="dropdown-item" href="#"
                                                                onclick="updateOrderStatus('{{ $orders->id }}', 'Packaging')">Packaging</a>
                                                        @endif
                                                        @if (!$isInOutForDelivery)
                                                            <a class="dropdown-item" href="#"
                                                                onclick="updateOrderStatus('{{ $orders->id }}', 'Out For Delivery')">Out
                                                                of Delivery</a>
                                                        @endif
                                                        @if (!$isInDelivered)
                                                            <a class="dropdown-item" href="#"
                                                                onclick="updateOrderStatus('{{ $orders->id }}', 'Delivered')">Delivered</a>
                                                        @endif
                                                        @if (!$isInFailedToDeliver)
                                                            <a class="dropdown-item" href="#"
                                                                onclick="updateOrderStatus('{{ $orders->id }}', 'Failed to Deliver')">Failed
                                                                to Deliver</a>
                                                        @endif
                                                        @if (!$isInCanceled )
                                                            <a class="dropdown-item" href="#"
                                                                onclick="updateOrderStatus('{{ $orders->id }}', 'Canceled')">Canceled</a>
                                                        @else
                                                            <a class="dropdown-item" href="#"
                                                                >Can't Update More Status</a>
                                                        
                                                        @endif
                                                    </div>
                                                </div>
                                                <input type="hidden" name="status" id="status{{ $orders->id }}"
                                                    value="{{ $orders->status }}">
                                        </td>
                                    @endif

                                    <td>
                                        <div class="d-flex 2">
                                            <a href="{{ url('get_order_detail_status/' . $orders->id) }}"
                                                class="btn btn-outline-secondary"><i class="nav-icon i-Eye "></i></a>

                                        </div>
                                    </td>
                                    </form>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Order Id#</th>
                                <th>Parcel Id #</th>
                                <th>Image</th>

                                <th>Product Details</th>
                                {{-- <th>Vendor Name</th> --}}
                                <th>Order Date</th>
                                <th>Customer Name</th>
                                <th>Customer Status</th>
                                <th style=" width: 60px ">Current Status</th>
                                <th>Update Status</th>
                                <th>View Status</th>
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
@endsection
