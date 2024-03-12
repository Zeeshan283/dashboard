@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
@php
$auth = app('Illuminate\Contracts\Auth\Guard');
@endphp
    <div class="breadcrumb">
                <h1>Pending Orders</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
                <div class="card text-start">
    
                    <div class="card-body">
                        <h4 class="card-title mb-3">Pending Orders</h4>
                        
                        {{-- <p>With DataTables you can alter the ordering characteristics of the table at initialisation time. Using
                            the order initialisation parameter, you can set the table to display the data in exactly the order
                            that you want.</p> --}}
    
                        <div class="table-responsive">
                            <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                                style="width:100%">
                                <thead>

                                    <th>Order Id#</th>
                                    <th>Parcel Id #</th>
                                    <th>Image</th>
                                    <th>Product Details</th>
                                    <th>Order Date</th>
                                    <th>Customer Name</th>
                                    <th style="width:100px;">Customer Status</th>
                                    <th style="width:100px;">Refund Detail</th>
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
                                                    </span><br>{{ $orders->customer_cancel_time }}
                                                    <br>
                                                    <span style=" font-weight: 700; ">Type:
                                                    </span>Customer <br>
                                                    <span style=" font-weight: 700; ">Reason:
                                                    </span>{{ $orders->customer_cancel_reason }}
                                                @else
                                                    {{-- @if ($orders->status == 'Canceled')
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
                                            <td>
                                                @if ($orders->customer_cancel_status == 'Canceled')
                                                    @if ($orders->refund_status != 1)
                                                        <span class="badge-for-timer" id="timer{{ $loop->iteration }}"></span>
                                                    @else
                                                        <span class="badge-for-timer">Refunded</span>
                                                    @endif
                                                    <br>
                                                    <br>
        
        
        
        
                                                    @if ($auth->check() && $auth->user()->role == 'Admin')
                                                        <form id="orderForm1{{ $orders->id }}"
                                                            action="{{ route('refundedStatus', ['id' => $orders->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <button onclick="updaterefundStatus('{{ $orders->id }}')"
                                                                onclick="updaterefundStatus($orders->id)"
                                                                style="font-size: smaller;"
                                                                class="btn btn-outline-secondary"><span>Click
                                                                    Refunded</span></button>
                                                        </form>
                                                    @endif
                                                @elseif ($orders->status == 'Canceled')
                                                    @if ($orders->refund_status != 1)
                                                        <span class="badge-for-timer" id="timer{{ $loop->iteration }}"></span>
                                                    @else
                                                        <span class="badge-for-timer">Refunded</span>
                                                    @endif
                                                    <br>
                                                    <br>
        
        
                                                    @if ($auth->check() && $auth->user()->role == 'Admin')
                                                        <form id="orderForm1{{ $orders->id }}"
                                                            action="{{ route('refundedStatus', ['id' => $orders->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <button onclick="updaterefundStatus('{{ $orders->id }}')"
                                                                style="font-size: smaller;"
                                                                class="btn btn-outline-secondary"><span>Click
                                                                    Refunded</span></button>
                                                        </form>
                                                    @endif
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
                                                                        }
                                                                        if ($tracker->status == 'Out For Delivery') {
                                                                            $isInOutForDelivery = true;
                                                                        }
                                                                        if ($tracker->status == 'Delivered') {
                                                                            $isInDelivered = true;
                                                                        }
                                                                        if ($tracker->status == 'Failed to Deliver') {
                                                                            $isInFailedToDeliver = true;
                                                                        }
                                                                        if ($tracker->status == 'Canceled') {
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
                                                                @if (!$isInCanceled)
                                                                    <a class="dropdown-item" href="#"
                                                                        onclick="updateOrderStatus('{{ $orders->id }}', 'Canceled')">Canceled</a>
                                                                @else
                                                                    <a class="dropdown-item" href="#">Can't Update More
                                                                        Status</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="status" id="status{{ $orders->id }}"
                                                            value="{{ $orders->status }}">
                                                    </form>
        
                                                </td>
                                            @endif
        
                                            <td>
                                                <div class="d-flex 2">
                                                    <a href="{{ url('get_order_detail_status/' . $orders->id) }}"
                                                        class="btn btn-outline-secondary"><i class="nav-icon i-Eye "></i></a>
        
                                                </div>
                                            </td>
                                            </form>
        
                                            <script>
                                                // Get the cancel time from PHP and convert it to milliseconds
                                                var cancelTime{{ $loop->iteration }} = new Date("{{ $orders->updated_at }}").getTime();
        
                                                // Calculate 15 days in milliseconds
                                                var fifteenDaysInMillis{{ $loop->iteration }} = 15 * 24 * 60 * 60 * 1000;
        
                                                // Calculate the target time (15 days after cancel time)
                                                var targetTime{{ $loop->iteration }} = cancelTime{{ $loop->iteration }} +
                                                    fifteenDaysInMillis{{ $loop->iteration }};
        
                                                // Update the timer every second
                                                var timerInterval{{ $loop->iteration }} = setInterval(function() {
                                                    // Get the current time
                                                    var now = new Date().getTime();
        
                                                    // Calculate the remaining time
                                                    var remainingTime = targetTime{{ $loop->iteration }} - now;
        
                                                    // Check if the timer has expired
                                                    if (remainingTime <= 0) {
                                                        clearInterval(timerInterval{{ $loop->iteration }});
                                                        document.getElementById("timer{{ $loop->iteration }}").innerHTML = "Expired";
                                                    } else {
                                                        // Calculate days, hours, minutes, and seconds
                                                        var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
                                                        var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                                                        var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
        
                                                        // Update the timer element with the remaining time
                                                        document.getElementById("timer{{ $loop->iteration }}").innerHTML = days + "d " + hours + "h " +
                                                            minutes + "m " + seconds + "s ";
                                                    }
                                                }, 1000);
                                            </script>
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
                                        <th style="width:100px;">Refund Detail</th>
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
