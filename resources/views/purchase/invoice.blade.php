@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/pickadate/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/pickadate/classic.date.css') }}">
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                        <div class="d-sm-flex mb-5" data-view="print">
                            <span class="m-auto"></span>
                            <button class="btn btn-primary mb-sm-0 mb-3 print-invoice">Print Invoice</button>
                        </div>
                        <!---===== Print Area =======-->
                        <div id="print-area">
                            <div class="row">
                                <div class="col-md-6">
                                    @if (Route::currentRouteName() == 'purchase.invoice')
                                        <h4 class="font-weight-bold">Purchase ID</h4>
                                        <p>#{{ $purchae_id }}</p>
                                    @elseif (Route::currentRouteName() == 'purchase.bill')
                                        <h4 class="font-weight-bold">Bill No </h4>
                                        <p>#{{ $bill_num }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6 text-sm-end">
                                    <p><strong>Invoice date: </strong> {{ $formattedDate }}</p>
                                </div>
                            </div>
                            <div class="mt-3 mb-4 border-top"></div>
                            @if (Route::currentRouteName() == 'purchase.invoice')
                            @endif

                            @if (Route::currentRouteName() == 'purchase.bill')
                                <div class="row mb-5">
                                    <div class="col-md-6 mb-3 mb-sm-0">
                                        <h5 class="font-weight-bold">Bill From</h5>
                                        <p>{{ $bill_from->first()->name }}</p>
                                        <p>
                                            {{ $bill_from->first()->address }}
                                        </p>
                                        <p>
                                            {{ $bill_from->first()->phone }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 text-sm-end">
                                        <h5 class="font-weight-bold">Bill To</h5>
                                        <p>{{ $bill_to->first()->name }}</p>
                                        <p>{{ $bill_to->first()->address1 }}</p>
                                        <p>{{ $bill_to->first()->phone1 }}</p>

                                    </div>
                                </div>
                            @endif

                            <div class="mt-3 mb-4 border-top"></div>
                            @if (Route::currentRouteName() == 'purchase.invoice')
                                <h3>Purchase History</h3>
                            @endif

                            @if (Route::currentRouteName() == 'purchase.bill')
                                <h3>Purchase Bill</h3>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover mb-4">
                                        <thead class="bg-gray-300">
                                            <tr>
                                                <th scope="col">Sr No#</th>
                                                <th scope="col">Date Created</th>

                                                @if (Route::currentRouteName() == 'purchase.invoice')
                                                    <th scope="col">Purchase ID</th>
                                                @endif
                                                @if (Route::currentRouteName() == 'purchase.bill')
                                                    <th scope="col">Bill No</th>
                                                @endif
                                                <th scope="col">Product Name</th>

                                                {{-- <th scope="col">Creted By</th> --}}
                                                <th scope="col">Product SKU</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Cost</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchaseHistory as $key => $invoice)
                                                <tr>
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td>{{ $invoice->date }}</td>
                                                    {{-- <td>{{ $invoice->purchase_id}}</td> --}}
                                                    @if (Route::currentRouteName() == 'purchase.invoice')
                                                        <td>{{ $invoice->purchase_id }}</td>
                                                    @endif
                                                    @if (Route::currentRouteName() == 'purchase.bill')
                                                        <td>{{ $invoice->bill_number }}</td>
                                                    @endif
                                                    <td>{{ $invoice->product->name ?? null }}</td>

                                                    {{-- <td>{{ $invoice->user->name}}</td> --}}
                                                    <td>{{ $invoice->product->sku ?? null }}</td>
                                                    <td>{{ $invoice->quantity }}</td>
                                                    <td>{{ $invoice->cost }}</td>
                                                    <td>{{ $invoice->total }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12">
                                    <div class="invoice-summary">
                                        <p>Total Quantity: <span>{{ $total_quantity }}</span></p>
                                        <h5 class="font-weight-bold">Total Cost: <span> ${{ $total_cost }}</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--==== / Print Area =====-->
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="{{ asset('assets/js/vendor/pickadate/picker.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('assets/js/invoice.script.js') }}"></script>
@endsection
