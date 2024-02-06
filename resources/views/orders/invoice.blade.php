<!DOCTYPE html>
<html class="no-js" lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <!-- Site Title -->
    <title>Industry Mall | Invoice</title>
    <link rel="stylesheet" href="{{ asset('invoice/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}
    <link rel="icon" href="{{ asset('upload/logo/logo.png') }}" type="image/x-icon">
    <style>
        .tm_invoice_head .row {
            display: flex;
            flex-wrap: wrap;
        }

        .tm_invoice_head .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            box-sizing: border-box;
        }

        /* Add your custom styles here */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px;
        }

        .col-2 {
            flex: 0 0 16.66667%;
            max-width: 16.66667%;
            text-align: center;
        }

        .anton {
            text-align: center;
            font-weight: 100;
            color: rgb(0, 0, 0);
        }
    </style>
</head>

<body>
    <div class="tm_container">
        <div class="tm_invoice_wrap">
            <div class="tm_invoice tm_style1" id="tm_download_section">
                <div class="tm_invoice_in">
                    <div class="tm_invoice_head tm_align_center tm_mb20">
                        <div class="tm_invoice_left">
                            <div class="tm_logo"><img src="/{{ $invoice->vendorProfile->logo }}" alt="Logo"></div>
                        </div>
                        <div class="tm_invoice_right tm_text_right">
                            <div class="tm_primary_color tm_f50 tm_text_uppercase">Invoice </div>
                        </div>
                    </div>
                    <div class="tm_invoice_info tm_mb20">
                        <div class="tm_invoice_seperator tm_gray_bg"></div>
                        <div class="tm_invoice_info_list">
                            <p class="tm_invoice_number tm_m0">Order #: <b
                                    class="tm_primary_color">#{{ $invoice->order->id }}</b></p>
                            <p class="tm_invoice_date tm_m0">Order Date: <b
                                    class="tm_primary_color">{{ $invoice->order->date }}</b></p>
                        </div>
                    </div>
                    <div class="tm_invoice_head tm_mb10">
                        <div class="row">


                            <div class="tm_padd_20 tm_border tm_accent_border_20 tm_mb25">
                                <p class="tm_primary_color tm_mb2 tm_f16 tm_bold">Billing To:</p>
                                <div class="tm_grid_row tm_col_3 tm_align_center">
                                    <div class="tm_border_right tm_accent_border_20 tm_border_none_sm">
                                        <span style=" font-weight: 600; ">Customer Id #: &nbsp
                                        </span>{{ $invoice->order->customer_id }} <br>
                                        <span style=" font-weight: 600; ">Customer Name : &nbsp </span>
                                        {{ $invoice->order->first_name }}
                                        {{ $invoice->order->last_name }} <br>
                                        <span style=" font-weight: 600; ">Company : &nbsp </span>
                                        {{ $invoice->order->company }}<br>
                                        <span style=" font-weight: 600; ">Email : &nbsp </span>
                                        {{ $invoice->order->email }}<br>
                                        <span style=" font-weight: 600; ">Phone #: &nbsp </span>
                                        {{ $invoice->order->phone1 }}<br>

                                    </div>
                                    <div class="tm_border_right tm_accent_border_20 tm_border_none_sm">
                                        <span style=" font-weight: 600; ">Address: &nbsp </span>
                                        {{ $invoice->order->address_01 }},<br>
                                        {{ $invoice->order->city }},
                                        {{ $invoice->order->state }} {{ $invoice->order->postal_code }},
                                        {{ $invoice->order->country }}

                                    </div>
                                    <?php
                                    use Carbon\Carbon;
                                    
                                    ?>
                                    <div class="row" style=" gap: 10px;">
                                        <div class="col-4">
                                            <span style=" font-weight: 600; ">invoice # :</span>
                                            {{ $invoice->order->id }} <br>
                                            <span style=" font-weight: 600; ">invoice Date :</span>
                                            {{ Carbon::now()->toDateString() }}

                                        </div>
                                        <div class="col-4">
                                            <div style=" ">
                                                <img src="{{ asset('invoice/assets/img/qeIM.png') }}" width="50px"
                                                    alt="Logo">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tm_table tm_style1 tm_mb30">
                        <div class="tm_round_border">
                            <div class="tm_table_responsive">
                                <table>
                                    <thead>
                                        <tr>

                                            <th class="tm_width_1 tm_semi_bold tm_primary_color tm_gray_bg">Sr#</th>
                                            <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">Product
                                            </th>
                                            <th class="tm_width_8    tm_semi_bold tm_primary_color tm_gray_bg">
                                                Description
                                            </th>
                                            <!-- <th class="tm_width_4 tm_semi_bold tm_primary_color tm_gray_bg">Model</th> -->
                                            {{-- <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">SKU</th> --}}
                                            {{-- <th class="tm_width_4 tm_semi_bold tm_primary_color tm_gray_bg">Tax(vat)</th> --}}
                                            <th class="tm_width_1 tm_semi_bold tm_primary_color tm_gray_bg">Qty</th>

                                            <th class="tm_width_1 tm_semi_bold tm_primary_color tm_gray_bg">Price</th>
                                            <th
                                                class="tm_width_1 tm_semi_bold tm_primary_color tm_gray_bg tm_text_right">
                                                Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $subtotalWithTax = 0;
                                        $totalTaxProduct = 0;
                                        ?>
                                        @foreach ($invoiceProduct as $value => $item)
                                            <tr>
                                                <td class="tm_width_1">{{ $value + 1 }}</td>
                                                <td class="tm_width_2">
                                                    <div style="margin-top: -55px;"><img
                                                            src="{{ $item->product->url }}" alt=""></div>
                                                </td>
                                                <td class="tm_width_8"> <span style=" font-weight: 600; ">
                                                        {{ $item->product->name }}</span> <br>
                                                    <span style=" font-weight: 600; ">Model #:
                                                    </span>{{ $item->product->model_no }}<br>
                                                    <span style=" font-weight: 600; ">SKU:
                                                    </span>{{ $item->product->sku }}<br><br>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <span style=" font-weight: 600; ">Estimated Delivery
                                                                Between:</span><br>
                                                            saturday, jan 28 2024 | tuesday, feb 01 2024 <br>

                                                        </div>
                                                        <div class="col-6">

                                                            <span style=" font-weight: 600; ">Tracking Number
                                                                $:</span><br>
                                                            {{ $item->id }} <br>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-4">

                                                            <span style=" font-weight: 600; ">Tax US $:</span><br>
                                                            {{ $item->product->tax_charges }}%
                                                        </div>
                                                        <div class="col-4">

                                                            <span style=" font-weight: 600; ">Coupon Discount
                                                                :</span><br>
                                                            0% ,
                                                        </div>
                                                        <div class="col-4">

                                                            <span style=" font-weight: 600; ">Shipping Charges US
                                                                $:</span><br>
                                                            $ 0.00 ,
                                                        </div>

                                                    </div>
                                                </td>
                                                {{-- <!-- <td class="tm_width_3">{{ $item->product->model_no }}</td> --> --}}
                                                {{-- <td class="tm_width_2">{{ $item->product->sku }}</td> --}}
                                                {{-- <td class="tm_width_3">{{ $item->product->tax_charges }}%</td> --}}
                                                <td class="tm_width_1">{{ $item->quantity }}</td>
                                                <td class="tm_width_1">${{ $item->p_price }}</td>
                                                <?php
                                                $total = $item->p_price * $item->quantity;
                                                $taxAmount = ($item->product->tax_charges / 100) * $total;
                                                $totalWithTax = $total + $taxAmount;
                                                
                                                $totalTaxProduct += $taxAmount;
                                                // {{--$subtotalWithTax += $totalWithTax --}}
                                                ?>
                                                <td class="tm_width_1 tm_text_right">${{ $total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tm_invoice_footer">
                            <div class="tm_left_footer">
                                <!-- <p class="tm_mb2"><b class="tm_primary_color">Payment info:</b></p>
                <p class="tm_m0">Credit Card - 236***********928 <br>Amount: $1732</p> -->
                            </div>

                            {{-- <div class="tm_right_footer">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_bold">Subtotal</td>
                                            <td
                                                class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_bold">
                                                ${{ $invoiceProduct->sum(function ($item) {
                                                    return $item->p_price * $item->quantity;
                                                }) }}
                                            </td>
                                        </tr>
                                        <?php
                                        $subtotal = $invoiceProduct->sum(function ($item) {
                                            return $item->p_price * $item->quantity;
                                        });
                                        
                                        $grand_total = $subtotal + $totalTaxProduct;
                                        ?>
                                        <tr>
                                            <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Tax <span
                                                    class="tm_ternary_color"></span></td>
                                            <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">
                                                +${{ $totalTaxProduct }}</td>
                                        </tr>
                                        <tr class="tm_border_top tm_border_bottom">
                                            <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color">
                                                Grand
                                                Total </td>
                                            <td
                                                class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color tm_text_right">
                                                ${{ $grand_total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}
                        </div>
                    </div>
                    {{-- <div class="tm_padd_15_20 tm_round_border">
                        <p class="tm_mb5"><b class="tm_primary_color">Terms & Conditions:</b></p>
                        <ul class="tm_m0 tm_note_list">
                            <li>All claims relating to quantity or shipping errors shall be waived by Buyer
                                unless made in writing to Seller within thirty (30) days after delivery of goods
                                to the address stated.</li>
                            <!-- <li>Delivery dates are not guaranteed and Seller has no liability for damages that may be incurred due to any delay in shipment of goods hereunder. Taxes are excluded unless otherwise stated.</li> -->
                        </ul>
                    </div>  --}}
                    <div class="tm_padd_20 tm_border tm_accent_border_20 tm_mb25">
                        <p class="tm_primary_color tm_mb2 tm_f16 tm_bold">Shipping To:</p>
                        <div class="tm_grid_row tm_col_3 tm_align_center">
                            <div class="tm_border_right tm_accent_border_20 tm_border_none_sm">
                                <i class="fas fa-user tm_icon"></i> {{ $invoice->order->shipping_full_name }} <br>
                                <i class="fas fa-building tm_icon"></i>
                                {{ $invoice->order->shipping_company_name }}<br>


                            </div>
                            <div class="tm_border_right tm_accent_border_20 tm_border_none_sm">
                                <i class="fas fa-envelope tm_icon"></i> {{ $invoice->order->shipping_email }}<br>
                                <i class="fas fa-phone tm_icon"></i>
                                {{ $invoice->order->shipping_contact_number }}<br>

                            </div>
                            <div class="  tm_accent_border_20 tm_border_none_sm">
                                <i class="fas fa-map-marker-alt tm_icon"></i>
                                {{ $invoice->order->shipping_address }},<br>
                                {{ $invoice->order->shipping_city }},
                                {{ $invoice->order->shipping_state }} {{ $invoice->order->shipping_zipcode }},
                                {{ $invoice->order->shipping_country }}<br>

                            </div>


                        </div>
                    </div>

                    <div class="tm_padd_20 tm_border tm_accent_border_20 tm_mb25">
                        <p class="tm_primary_color tm_mb2 tm_f16 tm_bold">Payment Summary:</p>
                        <div class="tm_table_responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="tm_width_1 tm_semi_bold tm_primary_color tm_gray_bg">Total </th>
                                        <th class="tm_width_1 tm_semi_bold tm_primary_color tm_gray_bg">Payment Mode
                                        </th>
                                        <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">Total Coupon
                                            Discount US$</th>
                                        <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">Shipping
                                            Charges US $</th>
                                        <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">Shipping
                                            Discount US$</th>
                                        <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">Total TAX US$
                                        </th>
                                        <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">Sub Total</th>
                                        <th class="tm_width_2 tm_semi_bold tm_primary_color tm_gray_bg">Grand Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subtotal = $invoiceProduct->sum(function ($item) {
                                        return $item->p_price * $item->quantity;
                                    });
                                    
                                    $grand_total = $subtotal + $totalTaxProduct;
                                    ?>
                                    <tr>
                                        <td class="tm_width_1 tm_text_left">$
                                            {{ $invoiceProduct->sum(function ($item) {
                                                return $item->p_price * $item->quantity;
                                            }) }}
                                        </td>
                                        <td class="tm_width_1 tm_text_left">Online</td>
                                        <td class="tm_width_2 tm_text_left">$ 0</td>
                                        <td class="tm_width_2 tm_text_left">$ 0</td>
                                        <td class="tm_width_2 tm_text_left">$ 0</td>
                                        <td class="tm_width_2 tm_text_left">+${{ $totalTaxProduct }}</td>
                                        <td class="tm_width_2 tm_text_left">${{ $grand_total }}</td>
                                        <td class="tm_width_2 tm_text_left">${{ $grand_total }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>




                    <div class="container">
                        <div class="row gx-0 justify-content-between" style="padding: 1px; ">
                            <div class="col-2">
                                <h6 class="tm_border_top_0 tm_bold tm_f16 tm_primary_color"
                                    style="text-align:center;">
                                    Contact #
                                </h6>
                                <p style="text-align:center;color:rgb(63, 63, 63);font-weight:500;">
                                    111-111-111-111</p>
                            </div>

                            <p style="font-weight:700;">|</p>
                            <div class="col-2">
                                <h6 class="tm_border_top_0 tm_bold tm_f16 tm_primary_color"
                                    style="text-align:center;">
                                    Email:</h6>
                                <p style="text-align:center;color:rgb(63, 63, 63);font-weight:500;">
                                    info@Industrymall.net</p>
                            </div>
                            <p style="font-weight:700;">|</p>
                            <div class="col-2">
                                <h6 class="tm_border_top_0 tm_bold tm_f16 tm_primary_color"
                                    style="text-align:center;">
                                    Company:</h6>
                                <p style="text-align:center;color:rgb(63, 63, 63);font-weight:500;">
                                    IndustryMall</p>
                            </div>
                            <p style="font-weight:700;">|</p>
                            <div class="col-2 ">
                                <img src="{{ asset('upload/logo/logo.png') }}" style="height: 50px; width: 100px;">

                            </div>
                        </div>
                    </div>



                </div>
                <!-- <div class="row " style="margin-top: 10px;">
                    <div class="tm_logo tm_text_right "><img src="{{ asset('/upload/logo/logo.png') }}" alt="Logo"></div>
                </div> -->

            </div>

            <div class="tm_invoice_btns tm_hide_print">
                <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
                    <span class="tm_btn_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <path
                                d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                                fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32"
                                fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none"
                                stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <circle cx="392" cy="184" r="24" fill='currentColor' />
                        </svg>
                    </span>
                    <span class="tm_btn_text">Print</span>
                </a>
                <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
                    <span class="tm_btn_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <path
                                d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                        </svg>
                    </span>
                    <span class="tm_btn_text">Download</span>
                </button>
            </div>
        </div>
    </div>
    <script src="{{ asset('invoice/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('invoice/assets/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('invoice/assets/js/html2canvas.min.js') }}"></script>
    <script src="{{ asset('invoice/assets/js/main.js') }}"></script>

</body>

</html>
