@extends('layouts.master')

@section('page-css')
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
            width: 280px;
        }

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 3px solid #f1f1f1;
            z-index: 9;
            background-color: #fff;
            /* Form background color */
            padding: 1px;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text],
        .form-container input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus,
        .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover,
        .open-button:hover {
            opacity: 1;
        }
    </style>
@endsection

@section('main-content')
    <div class="breadcrumb">
        <div class="col-md-6">
            <h1>Advertisement Order's Management</h1>
        </div>

    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">All Order's</h4>


                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order Id</th>
                                <th>Vendor Name</th>
                                <th>Advertisement Name</th>
                                <th>Display Day's</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Display Start Time</th>
                                <th>Display End Time</th>
                                <th>Time</th>
                                <th>Order Time</th>
                                <th>Payment</th>
                                <th>Display Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->id ?? 'Deleted form database as per instruction' }}</td>
                                    <td>{{ $item->user->name ?? 'deleted from database' }}</td>
                                    <td>{{ $item->advertisement->name ?? 'deleted from database' }}</td>
                                    <td>{{ $item->advertisement->days ?? 'deleted from database' }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->display_time_start }}</td>
                                    <td>{{ $item->display_end_start }}</td>
                                    <td>
                                        <p id="countdown-{{ $item->id }}"></p>
                                        <script>
                                            // Set the date we're counting down to
                                            var countDownDate{{ $item->id }} = new Date("{{ $item->display_end_start }}").getTime();

                                            // Update the count down every 1 second
                                            var x{{ $item->id }} = setInterval(function() {

                                                // Get today's date and time
                                                var now = new Date().getTime();

                                                // Find the distance between now and the count down date
                                                var distance = countDownDate{{ $item->id }} - now;

                                                // Time calculations for days, hours, minutes, and seconds
                                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                // Output the result in an element with id="countdown-{{ $item->id }}"
                                                document.getElementById("countdown-{{ $item->id }}").innerHTML = days + "d " + hours + "h " +
                                                    minutes + "m " + seconds + "s ";

                                                // If the count down is over, write some text 
                                                if (distance < 0) {
                                                    clearInterval(x{{ $item->id }});
                                                    document.getElementById("countdown-{{ $item->id }}").innerHTML = "EXPIRED";
                                                }
                                            }, 1000);
                                        </script>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        @if ($item->status == 'paid')
                                            <span class="badge badge-success" style="background-color: #039103;">Paid
                                        </span>@else<span class="badge badge-danger"
                                                style="background-color: #e51111;">Payment Failed</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->display_status == '1')
                                            <span class="badge badge-success" style="background-color: #039103 ;">Display
                                            </span>
                                        @else
                                            <span class="badge badge-danger" style="background-color: #e51111;">No
                                                Display</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex Order-list " style="width: 90px;">
                                            @if ($item->image != '')
                                                <a href="{{ asset($item->image) }}" download target="__BLANK"
                                                    class="image-popup">
                                                    <img src="{{ asset($item->image) }}" alt="N/A"
                                                        class=" img-fluid img-40 blur-up lazyloaded">
                                                </a>
                                            @else
                                                N/A
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{-- <a href="#" onclick="openForm({{ $item->id }})">
                                                <i class="fa fa-edit me-2 font-success"></i></a> --}}
                                            <a href="#" title="upload banner"
                                                onclick="openForm({{ $item->id }}, {{ $item->advertisement->days }}, {{ $item->display_status }}, {{ $item->display_time_start }})"><button
                                                    type="button" class="btn btn-outline-secondary ">
                                                    Upload
                                                </button></a>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach



                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Order Id</th>
                                <th>Vendor Name</th>
                                <th>Advertisement Name</th>
                                <th>Display Day's</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Display Start Time</th>
                                <th>Display End Time</th>
                                <th>Order Time</th>
                                <th>Payment</th>
                                <th>Display Status</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="form-popup" id="myForm">
        <div class="card">
            <div class="card-header">
                <h5>Display Status</h5>
            </div>
            <div class="card-body">
                <div class="digital-add needs-validation">
                    @if ($item->id ?? 'null')
                        <form id="editForm" action="{{ route('advertisementOrderImageUpdate', ['id' => $item->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="a_d_i_admin" id="advertisementId">
                            <div class="form-group">
                                <label for="validationCustom05" class="col-form-label pt-0">Status</label>
                                <select name="display_status" id="display_status" class="form-control fstdropdown-select">
                                    <option value="1">Display</option>
                                    <option value="0">Not Display</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom05" class="col-form-label pt-0">Display Start Time</label>
                                <input type="date" id="display_time_start" name="display_time_start" value=""
                                    class="form-control ">
                            </div>


                            <div class="form-group">
                                <label for="validationCustom05" class="col-form-label pt-0">Display Days</label>
                                <input type="number" name="days" id="display_days" value="" class="form-control">
                            </div>
                            <img src="" width="100px" id="show_image">
                            <div class="form-group mb-0">
                                <div class="product-buttons text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-light" onclick="closeForm()">Discard</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        function openForm(advertisementId, display_days, display_status, display_time_start) {
            document.getElementById("myForm").style.display = "block";
            document.getElementById("advertisementId").value = advertisementId;
            document.getElementById("display_days").value = display_days;
            document.getElementById("display_status").value = display_status;

            flatpickr("#display_time_start", {
                enableTime: false,
                dateFormat: "Y/m/d",
            });
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script>
    {{-- <script>
        function updateEndDate() {
            var startDate = document.getElementById('display_time_start').value;
            var days = document.getElementById('display_days').value;

            if (startDate && days) {
                var endDate = new Date(startDate);
                endDate.setDate(endDate.getDate() + parseInt(days));

                // Format the date as 'YYYY-MM-DD' for the input field
                var formattedEndDate = endDate.toISOString().split('T')[0];

                document.getElementById('display_end_start').value = formattedEndDate;
            }
        }
    </script>

    <script>
        function openForm(advertisementId, display_days) {
            document.getElementById("myForm").style.display = "block";
            document.getElementById("advertisementId").value = advertisementId;
            document.getElementById("display_days").value = display_days;
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
    </script> --}}
@endsection

@section('page-js')
    <script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
