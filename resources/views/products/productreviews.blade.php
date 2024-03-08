@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endsection
@section('main-content')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <style>
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ced4da;
            padding: 8px;
            max-height: 160px;
            max-width: 400px;
            overflow-y: auto;
        }

        .dropdown-options {
            margin-top: 30px;
        }

        .dropdown-options label {
            display: block;
            margin-bottom: 5px;
        }

        .option-text {
            margin-left: 5px;
        }

        /* Simplify focus outline for search inputs */
        input:focus {
            border-color: #ced4da;
            outline: none;
        }

        .dropdown-toggle {
            display: flex;
            max-width: 280px;
            padding-right: 100px;
            padding-left: 30px;
            background-color: #f8f9fa;
            border: 2px solid #e2eaf1;
            cursor: pointer;
            padding-top: 10px;
            padding-bottom: 5px;
            overflow: hidden;
            margin-bottom: 150px;
        }

        .filter-card {
            margin-left: 100px;
        }

        .text-left {
            margin-right: auto;
        }

        .datetimerange {
            border-color: #ccc !important;
            max-width: 350px;
            border: 2px solid;
            padding-top: 9px;
            padding-bottom: 9px;
            padding-right: 70px;
            padding-left: 70px;
            background-color: #f8f9fa;
        }

        .star-rating {
            font-size: 0;
        }

        .star {
            display: inline-block;
            width: 20px;
            /* Adjust the width as needed */
            height: 20px;
            /* Adjust the height as needed */
            background: gray;
            /* Default color for uncolored stars */
            clip-path: polygon(50% 0%,
                    61.8% 35.3%,
                    98.2% 35.3%,
                    68.2% 57.3%,
                    79.1% 91.2%,
                    50% 70.9%,
                    20.9% 91.2%,
                    31.8% 57.3%,
                    1.8% 35.3%,
                    38.2% 35.3%);
        }

        .star-filled {
            background: yellow;
            /* Color for filled (rated) stars */
        }

        .star-partial {
            background: gray;
            /* Color for uncolored stars */
        }
    </style>
    <div class="card-body">
        <button class="popup-button btn btn-secondary col-md-2"
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Product Reviews
            Filters</button><br><br>
        <div class="filter-card" id="filterCard" style="display: none;">
            <button type="submit" class="btn btn-secondary" style="margin-left: 1200px">Submit</button>
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-2">
                    <form action="{{ route('productreviews') }}" method="GET">
                        <div class="dropdown" id="order_item_idDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Parcel ID#</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="order_item_idSearchInput" name="order_item_id[]" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($review as $item)
                                    <label class="order_item_idFilter">
                                        <input type="checkbox" name="order_item_id[]" value="{{ $item->order_item_id }}">
                                        <span class="option-text" name="order_item_id[]">{{ $item->order_item_id }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="col-md-2">
                    <form action="{{ route('productreviews') }}" method="GET">
                        <div class="dropdown" id="productdetailDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Product Detail</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <input type="text" id="productdetailSearchInput" name="productdetail[]" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($review as $item)
                                    <label class="productdetailFilter">
                                        <input type="checkbox" name="productdetail[]" value="{{ $item->product->id ?? null }} .<br>{{ $item->product->name ?? null }} . <br> {{ $item->product->model_no ?? null }} . <br> {{ $item->product->sku ?? null }} . <br> ${{ $item->product->new_sale_price ?? null }} ">
                                        <span class="option-text" name="productdetail[]">{{ $item->product->id ?? null }} .<br>{{ $item->product->name ?? null }} . <br> {{ $item->product->model_no ?? null }} . <br> {{ $item->product->sku ?? null }} . <br> ${{ $item->product->new_sale_price ?? null }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                    <form action="{{ route('productreviews') }}" method="GET">
                        <div class="dropdown" id="ratingDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton3" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Rating</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <input type="text" id="ratingSearchInput" name="rating[]" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($review as $item)
                                    <label class="ratingFilter">
                                        <input type="checkbox" name="rating[]" value="{{ $item->rating }}">
                                        <span class="option-text" name="rating[]">
                                        {{ $item->rating }}
                                        </span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-3">
                    <div class="content-box">
                        <form action="{{ route('productreviews') }}" method="GET">
                                <input type="text" name="dateTime" class="datetimerange"  />
                        </form>
                    </div>
                </div>


            </div>

        </div>
    </div>
    <div class="breadcrumb">
        <h1>Product Reviews</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">Product Reviews</h4>

                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%">
                        <thead>
                            <th>Parcel Id</th>
                            <th>Product Detail</th>
                            <th>Rating</th>
                            <th>Comments</th>
                        </thead>
                        <tbody>
                            @foreach ($review as $item)
                                <tr>
                                    <td>{{ $item->order_item_id }}</td>
                                    <td style="width:250px">
                                        <span style=" font-weight: 600; ">Id:
                                            {{ $item->product->id ?? null }} </span> <br>
                                            <span style=" font-weight: 600; ">Name:
                                            {{ $item->product->name ?? null }} </span> <br>
                                        <span style=" font-weight: 600; ">Model #:
                                        </span>{{ $item->product->model_no ?? null }}<br>
                                        <span style=" font-weight: 600; ">SKU:
                                        </span>{{ $item->product->sku ?? null }}<br>
                                        <span style=" font-weight: 600; ">Price:
                                        </span>${{ $item->product->new_sale_price ?? null }}<br>

                                    </td>

                                    <td>
                                        @php
                                            $rating = $item->rating;
                                            $maxRating = 5;
                                            $numStars = 5;
                                            $percentage = ($rating / $maxRating) * 100;
                                            $fullStars = floor($percentage / (100 / $numStars));
                                            $emptyStars = $numStars - $fullStars;
                                        @endphp
                                        <div class="star-rating">
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <span class="star star-filled"></span>
                                            @endfor
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <span class="star star-partial"></span>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>{{ $item->comment }}</td>
                                    {{-- <td class="star-rating">
                                    <span class="star star-filled"></span>&nbsp;&nbsp;
                                    <span class="star star-filled"></span>&nbsp;&nbsp;
                                    <span class="star star-filled"></span>&nbsp;&nbsp;
                                    <span class="star star-filled"></span>&nbsp;&nbsp;
                                    <span class="star star-partial"></span>&nbsp;&nbsp;
                                </td> --}}

                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>

                            <th>Parcel Id</th>
                            <th>Product Detail</th>
                            <th>Rating</th>
                            <th>Action</th>

                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('page-js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
