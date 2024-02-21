@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
    <div class="breadcrumb">
                <h1>Customer Canceled Parcel</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
                <div class="card text-start">
    
                    <div class="card-body">
                        <h4 class="card-title mb-3">Canceled List</h4>
    
                        
                        <div class="table-responsive">
                            <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                                style="width:100%">
                                <thead>
                                    {{-- <th>Sr No</th> --}}
                                    <th>Order Id#</th>
                                    <th>Parcel Id #</th>
                                    <th>Vendor Name</th>
                                    <th>Customer Name</th>
                                    <th>Product Name</th>
                                    <th>Product Model</th>
                                    <th>Product Sku</th>
                                    <th>Product Price</th>
                                    <th>Order Date</th>
                                    {{-- <th>Shipping Date</th> --}}
                                    <th>Image</th>
                                    <th>Customer Status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $value => $orders)
                                    <tr>
                                
                                        {{-- <td>{{ $value + 1 }}</td> --}}
                                
                                        <td>{{ $orders->order_id }}</td>
                                        <td>{{ $orders->id }}</td>
                                        <td>{{ $orders->vendor->name ?? null }}</td>
                                        <td>{{ $orders->order->first_name  ?? null }} {{ $orders->order->last_name ?? null}}</td>
                                
                                        <td>{{ $orders->product->name ?? null }} </td>
                                        <td>{{ $orders->product->sku ?? null }} </td>
                                        <td>{{ $orders->product->model_no ?? null }} </td>
                                        <!-- <td>{{ $orders->product->new_sale_price ?? null }} </td> -->
                                        <td>{{ $orders->p_price ?? null }} </td>
                                        {{-- <td>{{ $orders->first_name }}</td> --}}
                                
                                        {{-- <td>{{ $orders->last_name }}</td> --}}
                                
                                        <td>{{ $orders->created_at }}</td>
                                        <td>
                                
                                            <img src="{{ $orders->product->url ?? null }} " loading="lazy" width="50" height="50" alt="Placeholder Image">
                                            {{-- @else --}}
                                        </td>
                                        <td>
                                            @if($orders->customer_cancel_status == 'Canceled')
                                           <span style="color: red"> {{$orders->customer_cancel_status}} </span><br>
                                            {{$orders->customer_cancel_time}}
                                
                                            @else
                                            @endif
                                        </td>
                                        <form method="POST" action="{{ route('order_details_status', ['id' => $orders->id]) }}">
                                
                                            @csrf
                                
                                            @method('PATCH')
                                            {{-- <input type="text" name="id" value="{{ $orders->order_id }}" /> --}}
                                            <td>
                                                <select class="form-control" name="status" id="status{{ $orders->id }}">
                                                    <option value="{{ $orders->status }}" selected disabled>{{ $orders->status }}</option>
                                                    <option value="In Process">In Process</option>
                                                    <option value="Packaging">Packaging</option>
                                                    <option value="Confirmed">Confirmed</option>
                                                    <option value="Out of delivery">Out of Delivery</option>
                                                    <option value="Delivered">Delivered</option>
                                                    <option value="Failed to Deliver">Failed to Deliver</option>
                                                    <option value="Returned">Returned</option>
                                                    <option value="Canceled">Canceled</option>
                                
                                
                                                </select>
                                            </td>
                                
                                            <td class="d-flex 2">
                                
                                                {{-- <input type="hidden" value="{{ $orders->id }}" name="order_id" hidden> --}}
                                
                                                <button type="submit" class="btn btn-outline-secondary ladda-button example-button m-1"
                                                    data-style="expand-left"><span class="ladda-label">Update</span></button>
                                
                                                    <a href="{{ url('get_order_detail_status/' . $orders->id) }}" class="btn btn-outline-secondary"><i
                                                        class="nav-icon i-Eye "></i></a>
                                                </div>
                                
                                            </td>
                                
                                        </form>
                                
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
                                        <th>Product Price</th>
                                        <th>Order Date</th>
                                        {{-- <th>Shipping Date</th> --}}
                                        <th>Image</th>
                                        <th>Customer Status</th>
                                        <th>Status</th>
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

<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
    
@endsection
