@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/choices.min.css') }}">
@endsection

@section('main-content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <style>
        .thumbnail {
            max-width: auto;
            max-height: 100px;
            margin: 5px;
        }

        .choices__input {
            background: #f3f4f6;
        }

        .choices__list--multiple .choices__item {
            /* width: 3%; */
            font-size: 14px;
            font-family: initial;
            /* background-color: #6b7280; */
            /* background-color: #e9ecef; */
            color: black;
            border-radius: 42px;
            /* height: 28px; */
            border: transparent;
        }

        .choices[data-type*=select-multiple] .choices__button {
            border-left: white;
            display: none;
        }

        .popup-button {
            padding: 5px 5px;
            font-size: 16px;
            background-color: gray;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .card {
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .container {
            margin-left: 0;
        }
    </style>
    <div class="breadcrumb">
        <div class="col-md-6">
            <h1>Product's Management</h1>
        </div>
        <div class="col-md-6" style="text-align: right;  margin-left: auto;">
            <a href="{{ route('products.create') }}"><button
                    class="btn btn-outline-secondary  ladda-button example-button m-1" data-style="expand-left"><span
                        class="ladda-label">Add Product</span></button></a>
        </div>
    </div>
    <div class="card">
        <div class="container m-0">
            <button class="popup-button" onclick="toggleFilters()">Product Filters</button><br><br>
            <div class="filter-card" id="filterCard">
                <col-lg-12>
                    <div class="filter-row d-flex gap-4">
                        <label for="nameFilter">Product Name:</label>
                        <select id="nameFilter" class="form-select">
                            <option value="" selected>select</option>
                            @foreach ($data as $key => $product)
                                <option value="{{ $product->name }}">{{ $product->name }}</option>
                            @endforeach
                        </select>&NonBreakingSpace; &NonBreakingSpace;
                        <label for="modelFilter">Model#:</label>
                        <select id="modelFilter" class="form-select">
                            <option value="" selected>select</option>
                            @foreach ($data as $key => $product)
                                <option value="{{ $product->model_no }}">{{ $product->model_no }}</option>
                            @endforeach
                        </select>&NonBreakingSpace; &NonBreakingSpace;
                        <label for="nameFilter" class="col-form-label">Categories:</label>
                        <select id="nameFilter" class="form-select">
                            <option value="" selected>select</option>
                            @foreach ($categories as $categories)
                                <option value="{{ $categories->name }}">
                                    @if ($categories->name)
                                        {{ $categories->name ?? null }}
                                    @endif
                                </option>
                            @endforeach
                        </select>&NonBreakingSpace; &NonBreakingSpace;
                        <label for="subcategoriesFilter" class="col-form-label">Sub Category:</label>
                        <select id="subcategoriesFilter" class="form-select">
                            <option value="" selected>select</option>
                            @foreach ($data as $donor)
                                <option value="{{ $donor->name }}">
                                    @if ($donor->categories)
                                        {{ $donor->categories->name ?? null }}
                                    @endif
                                </option>
                            @endforeach
                        </select>&NonBreakingSpace; &NonBreakingSpace;
                    </div>
                </col-lg-12>
                <br><br>
                <col-lg-12>
                    <div class="filter-row d-flex gap-4">
                        <label for="makeFilter" class="col-form-label">Supplier Name:</label>
                        <select id="makeFilter" class="form-select">
                            <option value="" selected>select</option>
                            @foreach ($data as $key => $product)
                                <option value="{{ $product->make }}">{{ $product->make }}</option>
                            @endforeach
                        </select>

                        <label for="new_priceFilter" class="col-form-label">Price:</label>
                        <select id="new_priceFilter" class="form-select">
                            <option value="" selected>select</option>
                            @foreach ($data as $key => $product)
                                <option value="{{ $product->new_price }}">{{ $product->new_price }}</option>
                            @endforeach
                        </select>

                        <label for="new_warranty_daysFilter" class="col-form-label">Warrenty Days:</label>
                        {{-- <select id="new_warranty_daysFilter" class="form-select">
                            <option value="" selected>select</option>
                            @foreach ($data as $key => $product)
                                <option value="{{ $product->new_warranty_days }}">{{ $product->new_warranty_days }}
                                </option>
                            @endforeach
                        </select> --}}
                        <input type="text">

                        <label for="new_return_daysFilter" class="col-form-label">Return Days:</label>
                        <select id="new_return_daysFilter" class="form-select">
                            <option value="" selected>select</option>
                            @foreach ($data as $key => $product)
                                <option value="{{ $product->new_return_days }}">{{ $product->new_return_days }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </col-lg-12>
                <br><br>
                <col-lg-12>
                    <div class="filter-row d-flex gap-4">
                        <label for="min_orderFilter" class="col-form-label">MOQ:</label>
                        <select id="min_orderFilter" class="form-select">
                            <option value="" selected>select</option>
                            @foreach ($data as $key => $product)
                                <option value="{{ $product->min_order }}">{{ $product->min_order }}</option>
                            @endforeach
                        </select>
                        <label for="brand_idFilter" class="col-form-label">Brand:</label>
                        <select id="brand_idFilter" class="form-select">
                            <option value="" selected>select</option>
                            @foreach ($brand as $brand)
                                <option value="{{ $brand->brand_name ?? null }}">
                                    {{ $brand->brand_name ?? null }}</option>
                            @endforeach
                        </select>

                        <label for="tax_chargesFilter" class="col-form-label">Tax:</label>
                        <select id="tax_chargesFilter" class="form-select">
                            <option value="" selected>select</option>
                            @foreach ($data as $key => $product)
                                <option value="{{ $product->tax_charges }}">{{ $product->tax_charges }}</option>
                            @endforeach
                        </select>


                        <label for="commissionFilter" class="col-form-label">Sub Category Comission:</label>
                        <select id="commissionFilter" class="form-select">
                            <option value="" selected>select</option>
                            @foreach ($data as $key => $donor)
                                <option value="{{ $donor->commission }}">{{ $donor->Categories->commission ?? null }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </col-lg-12><br><br>
                <div class="filter-row d-flex gap-4">
                    <label for="startDateFilter">Start Date:</label>
                    <input type="date" id="startDateFilter">&NonBreakingSpace; &NonBreakingSpace;
                    <label for="endDateFilter">End Date:</label>
                    <input type="date" id="endDateFilter">
                </div>
            </div>
            <!-- Add more filter inputs for other columns if needed -->
        </div>
    </div>

    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     // Initialize Choices with search enabled
        //     var choicesSelect = new Choices('#choices-multiple-remove-button', {
        //         removeItemButton: true,
        //         searchEnabled: true,
        //         placeholder: true,
        //         placeholderValue: 'Select product (Maximum Length 5)',
        //     });
        // });

        function toggleFilters() {
            var filterCard = document.getElementById("filterCard");
            filterCard.style.display = (filterCard.style.display === "none" || filterCard.style.display === "") ? "block" :
                "none";
        }


        $(document).ready(function() {
            // Function to apply filters
            function applyFilters() {
                var nameFilter = $('#nameFilter').val().toLowerCase();
                var modelFilter = $('#modelFilter').val().toLowerCase();
                var categoriesFilter = $('#categoriesFilter').val().toLowerCase();
                var subcategoriesFilter = $('#subcategoriesFilter').val().toLowerCase();
                var makeFilter = $('#makeFilter').val().toLowerCase();
                var new_priceFilter = $('#new_priceFilter').val().toLowerCase();
                var new_warranty_daysFilter = $('#new_warranty_daysFilter').val().toLowerCase();

                var startDateFilter = $('#startDateFilter').val();
                var endDateFilter = $('#endDateFilter').val();

                // Loop through each row in the tbody
                $('tbody tr').each(function() {
                    var name = $(this).find('td:eq(1)').text().toLowerCase();
                    var model_no = $(this).find('td:eq(2)').text().toLowerCase();
                    var categories = $(this).find('td:eq(4)').text().toLowerCase();
                    var subcategories = $(this).find('td:eq(4)').text().toLowerCase();
                    var make = $(this).find('td:eq(5)').text().toLowerCase();
                    var new_price = $(this).find('td:eq(9)').text().toLowerCase();
                    var new_warranty_days = $(this).find('td:eq(10)').text().toLowerCase();
                    var date = $(this).find('td:eq(8)').text();

                    // Check if the row should be visible based on filters
                    if (
                        name.includes(nameFilter) &&
                        model.includes(modelFilter) &&
                        (!startDateFilter || new Date(date) >= new Date(startDateFilter)) &&
                        (!endDateFilter || new Date(date) <= new Date(endDateFilter))
                    ) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            // Event listeners for filter inputs
            $('#nameFilter, #modelFilter, #startDateFilter, #categoriesFilter, #endDateFilter').on('input change',
                function() {
                    applyFilters();
                });
        });
    </script>


    <div class="separator-breadcrumb border-top"></div>

    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">All Product's</h4>
                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%">
                        @include('datatables.table_content')

                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
