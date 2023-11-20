@section('style')
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
            padding: 20px;
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
@section('main-cotent')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Advertisement Order List
                                {{-- <small></small> --}}
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item">Orders</li>
                            <li class="breadcrumb-item active">Order List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Order Lists</h5>
                    </div>
                    <div class="card-body Order-table">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Order Id</th>
                                    <th>Vendor Name</th>
                                    <th>Advertisement Name</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Display Time Start</th>
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
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->display_time_start }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ($item->status == 'paid')
                                            <span class="badge badge-success">Paid </span>@else<span
                                                    class="badge badge-danger">Payment Failed</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->display_status == '1')
                                                <span class="badge badge-success">Display </span>
                                            @else
                                                <span class="badge badge-danger">No Display</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex Order-list">
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
                                                <a href="#" onclick="openForm({{ $item->id }})">
                                                    <i class="fa fa-edit me-2 font-success"></i></a>


                                            </div>
                                        </td>

                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>


        <div class="form-popup" id="myForm">
            <div class="card">
                <div class="card-header">
                    <h5>Display Status</h5>
                </div>
                <div class="card-body">
                    <div class="digital-add needs-validation">
                        @if ($item->id)
                            <form id="editForm" action="{{ route('advertisementOrderImageUpdate', ['id' => $item->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="a_d_i_admin" id="advertisementId">
                                <div class="form-group">
                                    <label for="validationCustom05" class="col-form-label pt-0">Status</label>
                                    <select name="display_status" class="form-control fstdropdown-select">
                                        <option value="1">Display</option>
                                        <option value="0">Not Display</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom05" class="col-form-label pt-0">Display Time Start</label>
                                    <input type="date" name="display_time_start" class="form-control ">
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

        <script>
            function openForm(advertisementId) {
                document.getElementById("myForm").style.display = "block";
                document.getElementById("advertisementId").value = advertisementId;
            }

            function closeForm() {
                document.getElementById("myForm").style.display = "none";
            }
        </script>
    @endsection





    @extends('layouts.master')
    @section('page-css')
        <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    @endsection

    @section('main-content')
        <div class="breadcrumb">
            <div class="col-md-6">
                <h1>Advertisement Order List</h1>
            </div>

        </div>

        <div class="separator-breadcrumb border-top"></div>
        <div class="col-md-12 mb-4">
            <div class="card text-start">

                <div class="card-body">
                    <h4 class="card-title mb-3">All Advertisement Order's</h4>


                    <div class="table-responsive">
                        <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Order Id</th>
                                    <th>Vendor Name</th>
                                    <th>Advertisement Name</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Display Time Start</th>
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
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->display_time_start }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ($item->status == 'paid')
                                            <span class="badge badge-success">Paid </span>@else<span
                                                    class="badge badge-danger">Payment Failed</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->display_status == '1')
                                                <span class="badge badge-success">Display </span>
                                            @else
                                                <span class="badge badge-danger">No Display</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex Order-list">
                                                @if ($item->image != '')
                                                    <a href="{{ asset($item->image) }}" download target="__BLANK"
                                                        class="image-popup">
                                                        <img src="{{ asset($item->image) }}" alt="N/A" width="90px"
                                                            class=" img-fluid img-40 blur-up lazyloaded">
                                                    </a>
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="#" onclick="openForm({{ $item->id }})">
                                                    <i class="fa fa-edit me-2 font-success"></i></a>
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
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Display Time Start</th>
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
    @endsection

    @section('page-js')
        <script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
    @endsection
