@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
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
                                            </span>I'm Not Interested 
                                             
                                        @else
                                        @if($orders->status == 'Canceled')
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
