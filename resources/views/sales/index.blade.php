@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
    <div class="breadcrumb">
        <h1>All Sales</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">All Sales</h4>

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
                            <th>Product Commission</th>
                            <th>Product Price</th>
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
                                    <td>{{ $orders->product->subcategories->commission ?? null }}% </td>
                                    
                                    <?php
                                        $product_price = $orders->p_price;
                                        $commissionAmount = ($orders->product->subcategories->commission / 100) * $product_price; 
                                        $total_commission += $commissionAmount;

                                        $TaxAmount = ($orders->product->tax_charges / 100) * $product_price ;
                                        $totalTax +=  $TaxAmount;
                                    ?>
                                    <td>${{ $orders->p_price ?? null }} </td>

                                    <?php
                                        $total_product_price +=  $orders->p_price;
                                    ?>
                                    {{-- <td>{{ $orders->first_name }}</td> --}}

                                    {{-- <td>{{ $orders->last_name }}</td> --}}

                                    <td>{{ $orders->created_at }}</td>
                                    <td>
                                        <img src="{{ $orders->product->url ?? null }}  " width="50" height="50"
                                            loading="lazy" alt="Placeholder Image">
                                    </td>
                                    {{-- <td>{{ $orders->shipping }}</td> --}}
                                    {{-- <td>
                                    @if ($orders->product)
                                    @if ($orders->product->url)
                                    <img src="{{ $product->product_image->url }}" width="50" height="50" loading="lazy" alt="Placeholder Image" - Order ID:
                                {{ $orders->id }}">
                                <p>Order ID: {{ $orders->id }}</p>
                                @else
                                @if ($orders->product->product_image)
                                <img src="{{ $product->product_image->url }}" width="50" height="50" loading="lazy" alt="Placeholder Image" - Order ID:
                                    {{ $orders->id }}">
                                <p>Order ID: {{ $orders->id }}</p>
                                @endif
                                @endif
                                @else
                                <img src="{{ asset('path-to-your-placeholder-image.jpg') }}" loading="lazy" width="50" height="50" alt="Placeholder Image">
                                <p>No image available</p>
                                @endif
                                </td> --}}

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
                                <th>Product Commission</th>
                                <th>Product Price</th>
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

     {{-- <div class="separator-breadcrumb border-top"></div>
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
                                <td>+${{ $total_product_price}}</td>
                                <td>+${{$totalTax}}</td>
                                <td>-${{$total_commission}}</td>
                                <td>${{$total_product_price - $total_commission}}</td>

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
    </div> --}} 
@endsection

@section('page-js')
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
