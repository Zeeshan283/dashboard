<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ORDER RECEIPT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton">
    <link href="{{ asset('css/test.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton">
    <script src="{{ asset('js/test.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        
        body {
            margin-top: 20px;
            /* background: #f8f8f8 */
            color: black !important;
            background: #F2F6F8;
        }
        .heading{
            font-family: Anton;
        }

        tr {
            border:1px solid black;
        }
        .table td, .table th {
        border-color: black !important;
        }
        .table thead th tr{
            border-bottom: 1px solid black;
        }
        p {
            margin-bottom:0px !important;
        }
        .anton{
        font-family: Anton;
        }
        .line {
            margin:5px 0;
            height:2px;
            background:
            repeating-linear-gradient(90deg,rgb(92, 92, 92) 0 10px,#0000 0 12px)
            /*10px red then 2px transparent -> repeat this!*/
       }
       i{
        font-size: 13px !important;
        width:15px;
        height:15px;
       }
       @media print 
{
    .page 
    {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
        
    }
    
    .table .thead_class {
        background-color: rgb(44 45 58 / 16%);
    }
    
}
.table .thead_class {
        background-color: rgb(44 45 58 / 16%);
    }

    .th_font{
        /* text-align:center; */
        /* font-weight:100; */
        color:rgb(0, 0, 0);
    }
        /* .col-5 .col-6 {
            padding-left: 29px;
            margin-bottom: -20px;
        } */
    </style>
</head>

<body>
@php
use App\Models\Settings;
$settings = Settings::where('id', '=', '1')->get();
use App\Models\SystemLogo;
$system = SystemLogo::first();
@endphp
    <div class="container">
        <div class="row flex-lg-nowrap">
            {{-- <div class="col"> --}}
                <div class="row">
                    
                    <div class="col mb-3">
                        <div class="card">
                            <div class="card-body" >

                                <button class="btn btn-primary" onclick="this.style.display='none';window.print()">Print <i
                                    class="fa fa-print"></i></button>
                                <div class="e-profile">
                                    <br />
                                    {{-- <div class="row" style="border-bottom: 2px solid black;margin-top:-20px;"> --}}
                                    <div class="row" style="margin-top:-20px;">
                                        <div class="col-6">
                                            <div style="width: 140px;">
                                                <img src="{{ asset('/root/upload/users') }}/{{  $order->order_details[0]->vendor->image}}" style="height: 100px; width: 200px;">
                                                {{--<img src="{{ asset('/root/upload/logo') }}/{{ $system->image }}" style="height: 100px; width: 200px;">--}}
                                            </div>
                                        </div>
                                        <div class="col-4 " style="margin-left:0px;margin-top:30px;font-size:20px;">
                                        <em><h4>Industrial Automation Supplier</h4></em>
                                            
                                        </div>
                                        <div class="col-2" style="margin-left:0px;margin-top:30px;font-size:20px;">
                                        <img src="{{ asset('/root/upload/logo') }}/{{ $system->image }}" style="height: 50px; width: 100px;">
                                            
                                        </div>
                                        
                                    </div>
                                    <br><br><br>
                                    <div class="row gx-0 justify-content-between" style="padding:10px;">
                                        <div class="col-8" style="border-bottom: 10px solid rgb(23, 108, 205)">
                                        {{-- <div class="line-dashed"></div> --}}
                                        </div>
                                        <div class="col-2 heading" style="padding: 0px 0px 0px 0px;    margin: -19px -52px -17px -43px;">
                                            <p style="font-family:inherit;     margin: 1px -9px -21px 29px;font-size:25px;">I N V O I C E</p>
                                        </div>
                                        
                                        <div class="col-2" style="border-bottom: 10px solid rgb(246, 83, 29)">
                                                {{-- <div class="line-dashed"></div> --}}
                                        </div>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row gx-0 justify-content-between" style="margin-top:50px;">

                                        
                                        <div class="col-4" style="color:rgb(95, 95, 95);">
                                            <div style="padding:5px;">
                                                    <div style="padding:5px;border: 2px solid rgb(202, 202, 202)">
                                                        {{--<p><b class="anton" style="font-weight: 100">SHIP TO:&emsp;</b>{{  $order->order_details[0]->vendor->name }}</p>--}}
                                                        <p><b class="anton" style="font-weight: 100">SHIP TO:&emsp;</b>{{  $order->company }}</p>
                                                        <p><b class="anton" style="font-weight: 100">Attend.&emsp;</b>{{ $order->first_name}}</p> 
                                                        <hr class="line"></hr>
                                                        <div class="row" style="margin-top:15px;">
                                                            <div class="col-4" style="font-size:11px;">
                                                                {{  $order->address_01 }}
                                                            </div>
                                                            <div class="col-8">
                                                                <p style="font-weight:500;color:black;font-size:13px;"><i class="fa fa-phone" style="padding:2px;font-size:15px!important;"> </i> {{  $order->phone1 }}</p>
                                                                <p style="font-weight:500;color:black;font-size:13px;"><i class="fa fa-mobile" style="padding:2px;font-size:20px!important;"> </i> {{  $order->phone2 }}</p>
                                                                <p style="font-weight:500;color:black;font-size:13px;"><i class="fa fa-envelope" style="padding:2px;font-size:12px!important;"> </i> {{  $order->email }}</p>
                                                                <p style="font-weight:500;color:black;font-size:13px;"><i class="fa fa-globe" style="padding:2px;"> </i>
                                                                    {{ $order->customer->website_link ? $order->customer->website_link : 'N/A' }}
                                                                </p>
                                                                
                                                                <p style="font-weight:500;color:black;font-size:13px;"><i class="fa fa-thumb-tack" style="padding:2px;"> </i> {{  $order->city }}</p>
                                                                {{-- <p style="font-weight:500;color:black;font-size:13px;"><i class="fa fa" style="padding:2px; color:white;"> </i></p> --}}
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                            
                                            <div class="col-4">
                                                <div class="row" style="color:grey;">
                                                    <div class="col-sm-6"><p style="font-size:15px;"><b style="font-weight: 500;">Invoice Date</b></p></div>:<div class="col-sm-5"><p>{{ date("d/m/y", strtotime($order->date) )}}</p></div>
                                                   
                                                    <div class="col-sm-6"><p style="font-size:15px;"><b style="font-weight: 500;">Payment Due By</b></p></div>:<div class="col-sm-5"><p>{{ date("d/m/y", strtotime($order->shipping) )}}</p></div>
                                                   
                                                    <div class="col-sm-6"><p style="font-size:15px;"><b style="font-weight: 500;">Invoice#</b></p></div>:<div class="col-sm-5"><p>{{ $order->order_details[0]->order_id }}-IM</p></div>
                                                   
                                                    <div class="col-sm-6"><p style="font-size:15px;"><b style="font-weight: 500;">Customer ID</b></p></div>:<div class="col-sm-5"><p>{{ $order->order_details[0]->customer_id }}</p></div>
                                                   
                                                    {{--<div class="col-sm-6"><p style="font-size:15px;"><b style="font-weight: 500;">Purchase Order#</b></p></div>:<div class="col-sm-5"><p>{{ $order->id }}</p></div>--}}
                                                   
                                                    {{-- <div class="col-sm-6"><p style="font-size:15px;"><b style="font-weight: 500;">NTN#</b></p></div>:<div class="col-sm-5"><p>{{  $order->order_details[0]->vendor->ntn }}</p></div> --}}
                                                   
                                                    {{-- <div class="col-sm-6"><p style="font-size:15px;"><b style="font-weight: 500;">Sale Tax#</b></p></div>:<div class="col-sm-5"><p>{{  $order->order_details[0]->vendor->strn }}</p></div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <br>
                                    <div class="line"></div>
                                    <br>
                                <table class="table">
                                    <thead class="thead_class">
                                        <tr class="th_font">
                                            <th >Sr#</th>
                                            <th >Model No.</th>
                                            <th >Product Name:</th>
                                            <th>HS Code</th>
                                            <th >Qty</th>
                                            <th>Tax Charges</th>
                                            <th >Unit Price</th>
                                            <th >TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $tQty = 0;
                                            $tPrice = 0;
                                            $shipping_charges = 0;
                                            $imp_charges = 0;
                                            $tax_charges = 0;
                                            $other_charges = 0;
                                            $color=1;
                                        @endphp
                                        @foreach ($order->order_details as $key => $value)
                                            @if($color%2==0)
                                        <tr style="background:#E2DFDF">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->products->model_no }}</td>
                                                <td>{{ $value->product_name }}</td>
                                                <td>{{ $value->products->sku }}</td>
                                                <td>{{ $value->quantity }}</td>
                                                {{-- <td>{{ $settings->currency . '' . number_format($value->t_charges, 2)  }}</td>
                                                <td>{{ $settings->currency . '' . number_format($value->price, 2)  }}</td>
                                                <td>{{ $settings->currency . '' . number_format($value->total, 2)  }}</td>  --}}
                                                
                                                <td>{{$settings[0]->currency . '' . number_format($value->tax_charges,2)}}</td>
                                                
                                                <td>{{$settings[0]->currency . '' . number_format($value->price,2)}}</td>
                                                <td>{{$settings[0]->currency . '' . number_format($value->total,2)}}</td>
                                                {{-- <td>{{ $value->conditionType }}</td>
                                                
                                                <td>{{ $value->oth_charges }}</td>
                                                <td>{{ $value->ship_days }}</td> --}}
                                            </tr>
                                            @else
                                            <tr style="background:#fff">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $value->products->model_no }}</td>
                                                <td>{{ $value->product_name }}</td>
                                                <td>{{ $value->products->sku }}</td>
                                                <td>{{ $value->quantity }}</td>
                                                {{-- <td>{{ $settings->currency . '' . number_format($value->t_charges, 2)  }}</td> --}}
                                                {{-- <td>{{ $settings->currency . '' . number_format($value->price, 2)  }}</td> --}}
                                                
                                                <td>{{$settings[0]->currency . '' . number_format($value->tax_charges,2)}}</td>
                                                <td>{{$settings[0]->currency . '' . number_format($value->price,2)}}</td>
                                                <td>{{$settings[0]->currency . '' . number_format($value->total,2)}}</td>
                                                {{-- <td>{{ $settings->currency . '' . number_format($value->total, 2)  }}</td>  --}}
                                                
                                                {{-- <td>{{ $value->conditionType }}</td>
                                                
                                                <td>{{ $value->oth_charges }}</td>
                                                <td>{{ $value->ship_days }}</td> --}}
                                            </tr>
                                            @endif
                                            @php
                                                $tQty += $value->quantity;
                                                $tPrice += $value->total;
                                                $shipping_charges += $value->ship_charges;
                                                $imp_charges += $value->imp_charges;
                                                $tax_charges += $value->t_charges;
                                                $other_charges += $value->oth_charges;
                                                $color = $color+1;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                <div class="row">
                                <div class="col-3">
                                    <p class="anton" style="color:rgb(75, 75, 75);">Thank you for your order</p>
                                </div>
                                <div class="col-6">

                                </div>
                                <div class="col-3 " >
                                    <div class="row">
                                        <div class="col-sm-6 anton" style="border-bottom: 1px solid black;"><p style="font-size:15px;"><b style="font-weight: 300;">Total Charges</b></p></div>:<div class="col-sm-5" style="border-bottom: 1px solid black;"><p>{{ $settings[0]->currency . '' . number_format($tPrice, 2)  }}</p></div>
                                       
                                        {{-- <div class="col-sm-6 anton"><p style="font-size:15px;"><b style="font-weight: 300;">Shipping Charges</b></p></div>:<div class="col-sm-5"><p>{{ $settings[0]->currency . '' . number_format($shipping_charges, 2)  }}</p></div> --}}
                                       
                                        {{-- <div class="col-sm-6 anton"><p style="font-size:15px;"><b style="font-weight: 300;">Sale Tax Rate</b></p></div>:<div class="col-sm-5"><p>{{ number_format(0, 2)  }}%</p></div> --}}
                                       
                                        <div class="col-sm-6 anton"><p style="font-size:15px;"><b style="font-weight: 300;">Tax Charges</b></p></div>:<div class="col-sm-5"><p>{{ $settings[0]->currency . '' . number_format($tax_charges, 2)  }}</p></div>
                                       
                                        {{-- <div class="col-sm-6 anton"><p style="font-size:15px;"><b style="font-weight: 300;">Import Charges</b></p></div>:<div class="col-sm-5"><p>{{ $settings[0]->currency . '' . number_format($imp_charges, 2)  }}</p></div>  --}}
                                        
                                         {{-- <div class="col-sm-6 anton"><p style="font-size:15px;"><b style="font-weight: 300;">NTN#</b></p></div>:<div class="col-sm-5"><p>1234567</p></div>  --}}
                                       
                                        <div class="col-sm-6 anton" style="color:white;background-color:grey;"><p style="font-size:19px;"><b style="font-weight: 300;">Grand Total</b></p></div><div class="col-sm-5 anton" style="color:white;background-color:grey;"><p style="font-size:19px;"><b style="font-weight: 100;">{{ $settings[0]->currency . '' . number_format($imp_charges+$tax_charges+0+$shipping_charges+$tPrice, 2)  }}</b></p></div>  
                                    </div>
                                </div>                           
                                </div>

                                {{-- term and condition --}}
                                @php
                                use App\Models\TermsConditions;
                                $terms = TermsConditions::where('id', '=', '1')->get();
                                @endphp
                                <br><br>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-9" >
                                            <h5 class="anton" style="font-weight:1;border-top:1px solid black;">Terms & Conditions:</h5>
                                            <div style="font-size:11px;">
                                            <p >{!! $terms[0]->description !!}</p>
                                            </div>
                                        </div>
                                        <div class="col-12" >
                                        
                                        </div>
                                    </div>
                                </div>
                                {{-- end --}}

                                <div class="row gx-0 justify-content-between" style="padding:10px;">
                                    <div class="col-7" style="border-bottom: 10px solid rgb(23, 108, 205)">
                                    {{-- <div class="line-dashed"></div> --}}
                                    </div>
                                    <div class="col-3" >
                                        <p style="border-bottom: 2px solid rgb(0, 0, 0);padding-left:5px;margin-top:20px;"></p>
                                    </div>
                                    
                                    <div class="col-1" style="border-bottom: 10px solid rgb(246, 83, 29)">
                                            {{-- <div class="line-dashed"></div> --}}
                                    </div>
                                    <div class="col-4">
                                        <p style="color:grey"> <b >{{ $settings[0]->title }}</b> (for any queries please contact us)</p>
                                    </div>
                                    <div class="col-3">
                                        <p style="border-bottom: 1.5px solid rgb(111, 110, 110);padding-left:5px;margin-top:15px;"></p>
                                    </div>
                                    <div class="col-5">
                                        <h4 style="margin-left:63px;">Authorized Sign</h4>
                                    </div>
                                    <div class="col-2"></div>
                                    </div>
                                </div>
                                <br>
                                <div class="container">
                                <div class="row gx-0 justify-content-between" style="padding: 10px; ">
                                    <div class="col-2">
                                        <h6 class="anton" style="text-align:center;font-weight:100;color:rgb(0, 0, 0)">Contact #</h6>
                                        <p style="text-align:center;color:rgb(63, 63, 63);font-weight:500;">{{  $order->order_details[0]->vendor->phone }}</p>
                                    </div><p style="font-weight:700;">|</p>
                                    <div class="col-2">
                                        <h6 class="anton" style="text-align:center;font-weight:100;color:rgb(0, 0, 0)">Address:</h6>
                                        <p style="text-align:center;color:rgb(63, 63, 63);font-weight:500;">{{  $order->order_details[0]->vendor->address1 }}</p>
                                    </div><p style="font-weight:700;">|</p>
                                    <div class="col-2">
                                        <h6 class="anton" style="text-align:center;font-weight:100;color:rgb(0, 0, 0)">Email:</h6>
                                        <p style="text-align:center;color:rgb(63, 63, 63);font-weight:500;">{{  $order->order_details[0]->vendor->email }}</p>
                                    </div><p style="font-weight:700;">|</p>
                                    <div class="col-2">
                                        <h6 class="anton" style="text-align:center;font-weight:100;color:rgb(0, 0, 0)">Company:</h6>
                                        <p style="text-align:center;color:rgb(63, 63, 63);font-weight:500;">{{  $order->order_details[0]->vendor->company }}</p>
                                    </div><p style="font-weight:700;">|</p>
                                    <div class="col-2 ">
                                            <img src="{{ asset('/root/upload/users') }}/{{  $order->order_details[0]->vendor->image}}" style="height: 50px; width: 100px;">
                                    
                                        </div>
                                </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>

<script lang="javascript">
function printdiv(printpage) {
    alert(1);
    var headstr = "<html><head><title></title></head><body>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr + newstr + footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
}
</script>