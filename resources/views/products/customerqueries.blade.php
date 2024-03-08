@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <style>
        .tooltip-container {
            position: relative;
            display: inline-block;
        }

        .message-hover {
            cursor: pointer;
            /* text-decoration: underline; */
            color: blue;
        }

        .tooltip {
            visibility: hidden;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 4px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 0;
            margin-left: -70px;
            /* Adjust as needed for tooltip positioning */
            opacity: 0;
            transition: opacity 0.2s;
            width: auto;
            /* Adjust the width as needed */
        }

        .tooltip-container:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
    </style>
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
        <button class="popup-button btn btn-primary col-md-2"
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Customer Queries
            Filters</button><br><br>
        <div class="filter-card" id="filterCard">
            <form action="{{ route(Route::currentRouteName()) }}" method="GET">
                <button type="submit" class="btn btn-secondary" style="margin-left: 1100px">Submit</button>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3">
                        <div class="dropdown" id="customer_idDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Customer Id</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="CustomerIDSearchInput"  placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $key => $value)
                                        <label class="customer_idFilter">
                                            <input type="checkbox"  name="customer_id[]" value="{{ $value->customer_id }}">
                                            <span class="option-text">{{ $value->customer_id }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedCustomerIDList"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dropdown" id="Supplier_nameDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Supplier Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <input type="text" id="SupplierNameSearchInput"  placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $key => $value)
                                        <label class="supplier_nameFilter">
                                            <input type="checkbox" name="supplier_name[]" value="{{ $value->supplier_name }}">
                                            <span class="option-text">{{ $value->supplier_name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedSupplierNameList"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="dropdown" id="customer_nameDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton3" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Customer Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <input type="text" id="CustomerNameSearchInput" id="CustomerNameSearchInput" name="customer_name[]" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $key => $value)
                                        <label class="customer_nameFilter">
                                            <input type="checkbox" name="customer_name[]" value="{{ $value->customer_name }}">
                                            <span class="option-text">{{ $value->customer_name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedCustomerNameList"></div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton3" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Customer Contact</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <input type="text" id="searchInput4" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $key => $value)
                                        <label class="customer_contact_noFilter">
                                            <input type="checkbox" value="{{ $value->customer_contact_no }}">
                                            <span class="option-text">{{ $value->customer_contact_no }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="row" style="margin-bottom: 150px;">
                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Product Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="pro_nameSearchInput" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $key => $value)
                                        <label class="pro_nameFilter">
                                            <input type="checkbox" name="pro_name[]" value="{{ $value->pro_name }}">
                                            <span class="option-text">{{ $value->pro_name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedpro_nameList"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Product Model#</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="searchInput5" onkeyup="filterOptions()"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($data as $key => $value)
                                        <label class="pro_model_noFilter">
                                            <input type="checkbox" value="{{ $value->pro_model_no }}">
                                            <span class="option-text">{{ $value->pro_model_no }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3" style="margin-left: 0px;">
                        <div class="content-box">
                            <input type="text" name="dateTime" class="datetimerange" />
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
    <div class="separator-breadcrumb border-top"></div>
    <div class="breadcrumb">
        <h1>Contact Supplier</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">Contact Supplier</h4>
                {{--
                        <p>.....</p>
     --}}
                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%">
                        <thead>
                            <th>Sr#</th>
                            <th>Supplier Name</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Contact #</th>
                            <th>Product Name</th>
                            <th>Product Model #</th>
                            <th>Message</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->supplier_name }}</td>
                                    <td>{{ $value->customer_name }}</td>
                                    <td>{{ $value->customer_email }}</td>
                                    <td>{{ $value->customer_contact_no }}</td>
                                    <td>{{ $value->pro_name }}</td>
                                    <td>{{ $value->pro_model_no }}</td>
                                    <td>
                                        <div class="tooltip-container">
                                            <span class="">{{ Str::limit($value->message, 30) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a target="_blank" href="mailto:{{ $value->customer_email }}">
                                                <button type="button" class="btn btn btn-outline-secondary ">
                                                    <i class="nav-icon i-Email" title="email"
                                                        style="font-weight: bold;"></i>
                                                </button></a>
                                            <a target="_blank" href="{{ route('CustomerQueries.show', $value->id) }}">
                                                <button type="button" class="btn btn btn-outline-secondary ">
                                                    <i class="nav-icon i-Eye" title="view"
                                                        style="font-weight: bold;"></i>
                                                </button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr#</th>
                                <th>Supplier Name</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Customer Contact #</th>
                                <th>Product Name</th>
                                <th>Product Model #</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
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
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
