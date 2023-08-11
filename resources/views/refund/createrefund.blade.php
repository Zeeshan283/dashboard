@extends('layouts.master')
@section('before-css')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Create Refund</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Create Refund according to customer queries</h3>
                                </div>
                                <form action="{{ route('refund.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">

                                        <div class="row">
                                            {{-- testing new drop-down menu here  --}}

                                                <div class="form-group col-lg-6">
                                                    <label for="inputtext11" class="ul-form__label">Vendor:</label>
                                                    <select class="form-control" id="vendor" required>
                                                        <option value="" selected disabled>Select Vendor</option>
                                                        @foreach ($vendors as $vendor)
                                                            <option value="{{ $vendor->name}}">{{ $vendor->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small id="passwordHelpBlock" class="ul-form__text form-text">
                                                        Select vendor
                                                    </small>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="inputtext11" class="ul-form__label">Product SKU:</label>
                                                    <select class="form-control" id="product_id" required>
                                                        <option value="" selected disabled>Product SKU</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{$product->sku}}">{{$product->sku}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small id="passwordHelpBlock" class="ul-form__text form-text">
                                                        Select Product SKU
                                                    </small>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="inputtext11" class="ul-form__label">Customer Id & Name:</label>
                                                    <select class="form-control" id="customer_id" required>
                                                        <option value="" selected disabled>Select Customer id</option>
                                                        @foreach ($customers as $customer)
                                                            <option value="{{$customer->id}}{{$customer->name}}">{{ $customer->id}} => {{$customer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small id="passwordHelpBlock" class="ul-form__text form-text">
                                                        Select Customer/Buyer Id
                                                    </small>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label for="inputtext11" class="ul-form__label">Order Id:</label>
                                                    <select class="form-control" id="order_id" required>
                                                        <option value="" selected disabled>Select Order Id</option>
                                                        @foreach ($orders as $order)
                                                        <option value="{{$order->id}}">{{$order->id}}</option>
                                                        @endforeach
                                                    </select>
                                                    <small id="passwordHelpBlock" class="ul-form__text form-text">
                                                        Select Order Id
                                                    </small>
                                                </div>

                                            <div class="form-group col-lg-6">
                                                <label for="inputtext11" class="ul-form__label">Amount:</label>
                                                <input type="number" inputmode="numeric " pattern="[0-9]" class="form-control" id="amount" placeholder="Enter refund Amount" required>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter refund amount
                                                </small>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="inputEmail12" class="ul-form__label">Refund Reaso:</label>
                                                <input type="text" class="form-control" id="reason" placeholder="Enter Contact Number" required>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter Refund Reason
                                                </small>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn  btn-primary m-1">Create Request</button>
                                                    <button type="button" class="btn btn-outline-secondary m-1">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('page-js')

<script>
    function selectMenu(menuText, inputId) {
        document.getElementById(inputId).value = menuText;
    }
</script>



@endsection

@section('bottom-js')




@endsection
