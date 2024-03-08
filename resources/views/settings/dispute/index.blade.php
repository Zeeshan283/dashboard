@extends('layouts.master')
@section('page-css')
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
            margin-left: 100px;
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
        <button class="popup-button btn btn-primary col-md-1"
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Dispute Filters</button><br><br>
        <div class="filter-card" id="filterCard">
            <form action="{{ route('reports.index') }}" method="GET">
                <button type="submit" class="btn btn-secondary" style="margin-left: 1200px">Submit</button>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-3">
                        <div class="dropdown" id="titleDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Title</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="titleSearchInput" name="title[]" placeholder="Search...">
                                <div class="dropdown-options">
                            @foreach ($data as $key => $value)
                                        <label class="titleFilter">
                                            <input type="checkbox" name="title[]"  value="{{ $value->title }}">
                                            <span class="option-text" name="title[]">{{ $value->title }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="col-md-2">
                        <div class="dropdown" id="user_idDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">User ID#</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <input type="text" id="user_idSearchInput" name="user_id[]"  placeholder="Search...">
                                <div class="dropdown-options">
                            @foreach ($data as $key => $value)
                                        <label class="user_idFilter">
                                            <input type="checkbox" name="user_id[]"  value="{{$value->user_id }}">
                                            <span class="option-text" name="user_id[]" >{{$value->user_id }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                </div>
                    <div class="col-md-3">
                        <div class="dropdown" id="user_typeDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton3" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">User Type</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <input type="text" id="user_typeSearchInput" name="user_type[]" placeholder="Search...">
                                <div class="dropdown-options">
                            @foreach ($data as $key => $value)
                                        <label class="user_typeFilter">
                                            <input type="checkbox" name="user_type[]"  value="{{ $value->user_type }}">
                                            <span class="option-text"  name="user_type[]">{{ $value->user_type }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-top: 10px;">

                    <div class="col-md-3">
                        <div class="dropdown" id="nameDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton4" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                <input type="text" id="nameSearchInput" name="name[]" placeholder="Search...">
                                <div class="dropdown-options">
                            @foreach ($data as $key => $value)
                                        <label class="nameFilter">
                                            <input type="checkbox" name="name[]"  value="{{ $value->name }}">
                                            <span class="option-text"  name="name[]">{{ $value->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="dropdown" id="addressDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton5" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Address</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                                <input type="text" id="addressSearchInput" name="address[]" placeholder="Search...">
                                <div class="dropdown-options">
                            @foreach ($data as $key => $value)
                                        <label class="addressFilter">
                                            <input type="checkbox" name="address[]"  value="{{ $value->city . $value->state . $value->country }}">
                                            <span class="option-text"  name="address[]">{{ $value->city . $value->state . $value->country }}</span>
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
                <div class="row d-flex" style="margin-top: 40px; margin-bottom: 150px">

                    <div class="col-md-5" style="margin-left: 200px;">
                        <div class="content-box d-flex">
                            <div class="input-bar" style="margin-left: 120px;">
                                <label for="priceInput5">Enter Price:</label>
                                <input type="number" id="priceInput5" min="0" max="1000000" value="100"
                                    oninput="updatePriceSlider(this.value, 'rangeValue5')">
                            </div>
                            <div class="slider"><b>Amount:</b>
                                <label for="fader"></label><input type="range" min="0" max="100"
                                    value="50" id="fader" step="20" list="volsettings"
                                    oninput="updatePriceValue(this.value, 'rangeValue5')">
                                <p id="rangeValue5">100</p>
                                <datalist id="volsettings">
                                    <option>10000</option>
                                    <option>20000</option>
                                    <option>40000</option>
                                    <option>60000</option>
                                    <option>80000</option>
                                    <option>100000</option>
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
            </form>

        </div>
    </div>
     <div class="separator-breadcrumb border-top"></div>

    <div class="breadcrumb">
        <h1>Dispute's Management</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">Dispute List</h4>
                {{--
                        <p>.....</p>
     --}}
                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                            <th>Sr#</th>
                            <th>Title</th>
                            <th>User Id</th>
                            <th>User Type</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Profile Link</th>
                            <th>Message</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->user_id }}</td>
                                    <td>{{ $value->user_type }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->contact }}</td>
                                    <td>{{ $value->city . $value->state . $value->country }}</td>
                                    <td>{{ $value->profile_link }}</td>
                                    <td>
                                        <div class="tooltip-container">
                                            <span class="">{{ Str::limit($value->message, 30) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a target="_blank" href="mailto:{{ $value->email }}">
                                                <button type="button" class="btn btn btn-outline-secondary ">
                                                    <i class="nav-icon i-Email" title="email"
                                                        style="font-weight: bold;"></i>
                                                </button></a>
                                            <a target="_blank" href="{{ route('disputes.show', $value->id) }}">
                                                <button type="button" class="btn btn btn-outline-secondary ">
                                                    <i class="nav-icon i-Eye" title="view" style="font-weight: bold;"></i>
                                                </button></a>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr#</th>
                                <th>Title</th>
                            <th>User Id</th>
                                <th>User Type</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Profile Link</th>
                                <th>Message</th>
                                <th>Action</th>
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
@endsection
