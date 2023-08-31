<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PURCHASE RECEIPT</title>
    <style>
        body {
            margin-top: 20px;
            background: #f8f8f8;
            color:black;
        }

        tr {
            /* line-height: 0px; */
            border: 2px solid black;
        }

        .table thead th {
            border-bottom: 1px solid black;
        }
        .table tbody td {
            border-bottom: 1px solid black;
        }
        a:hover{
            color: black!important;
            text-decoration: none;
        }
    </style>
    <link href="{{ asset('css/test.css') }}" rel="stylesheet">
    <script src="{{ asset('js/test.js') }}"></script>
</head>

<body>
    <a  href="javascript:void(0);" onclick="window.print()">
        <div class="container">
            <div class="row flex-lg-nowrap">
                <div class="col">
                    <div class="row">
                        <div class="col mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="e-profile">
                                        <br />
                                        @include('include.header')
                                        <h3 style="text-align: center;"><u>Purchase Details</u></h3>
                                        <div class="col-md-12">
    
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-auto mb-3">
                                                <div class="mx-auto" style="width: 140px;">
                                                </div>
    
                                            </div>
                                            <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label style="color:black; font-weight: 700;">
                                                        Date: {{ date('d/m/Y', strtotime($details[0]->date)) }}
                                                    </label>
                                                    <u><b></b></u>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label style="color:black; font-weight: 700;">
                                                        Bill #: {{ $details[0]->bill_no }}</label>
                                                    <u><b></b></u>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label style="color:black; font-weight: 700;">
                                                        Biller: {{ $details[0]->user->name }}</label>
                                                    <u><b></b></u>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sr.No</th>
                                                <th>Product Name</th>
                                                <th>Product unit</th>
                                                <th>Model#</th>
                                                <th>Quantity</th>
                                                <th>Cost</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="items">
                                            @php $total =0; @endphp
                                            @php $totalQty =0; @endphp
                                            @php $price =0; @endphp
                                            @foreach ($details as $key => $detail)
                                                <tr>
                                                    <td>
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td>
                                                        {{ $detail->product->name }}
                                                    </td>
                                                    <td>
                                                        {{ $detail->uoms->uom }}
                                                    </td>
                                                    <td>{{ $detail->product->model_no }}</td>
                                                    <td>
                                                        {{ $detail->qty_in }}
                                                    </td>
                                                    <td>
                                                        {{ $detail->cost }}
                                                    </td>
                                                    <td>
                                                        {{ $detail->total }}
                                                    </td>
                                                </tr>
                                                @php
                                                    $totalQty += $detail->qty_in;
                                                    $total += $detail->total;
                                                @endphp
                                            @endforeach
                                            <tr>
                                                <td colspan="4"><b>Total</b></td>
                                                <td><b>{{ number_format($totalQty) }}</b></td>
                                                <td><b></b></td>
                                                <td><b>{{ number_format($total) }}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @include('include.footer')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</body>

</html>
