@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">

@endsection

@section('main-content')
    <div class="breadcrumb">
        <h1>Get Order Parcels Status</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>


                    @php
                    $hasInProcessStatus = false;
                    $hasPackagingStatus = false;
                    $hasOutForDelivery = false;
                    $hasDelivered = false;
                    $hasFailedToDeliver = false;
                    $hasCanceled = false;
                @endphp

                @foreach ($status as $order)
                    @if ($order->status === 'In Process')
                        @php
                            $hasInProcessStatus = true;
                        @endphp
                    @endif
                     @if ($order->status === 'Packaging')
                        @php
                            $hasPackagingStatus = true;
                        @endphp
                    @endif
                    {{-- @if ($order->status === 'Out For Delivery')
                        @php
                            $hasOutForDelivery = true;
                        @endphp
                    @endif 
                    @if ($order->status === 'Delivered')
                        @php
                            $hasDelivered = true;
                        @endphp
                    @endif
                    @if ($order->status === 'Failed to Deliver')
                        @php
                            $hasFailedToDeliver = true;
                        @endphp
                    @endif
                    @if ($order->status === 'Canceled')
                        @php
                            $hasCanceled = true;
                        @endphp
                    @endif --}}
                    
                @endforeach



                
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">Get order Parcels Status</h4>

                {{-- <p>All Orders list is below.</p> --}}

                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%;">
                        <thead>
                            <th>Id #</th>
                            <th>Parcel Id #</th>
                            <th>Status</th>
                            <th>DateTime</th>
                        </thead>
                        <tbody>
                            @foreach ($status as $value => $orders)
                                <tr>

                                    <td>{{ $value + 1 }}</td>
                                    <td>{{ $orders->order_id }}</td>
                                    <td>{{ $orders->status }} </td>
                                    <td>{{ $orders->datetime }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id #</th>

                                <th>Parcel Id #</th>
                                <th>Status</th>
                                <th>DateTime</th>
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
