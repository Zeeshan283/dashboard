@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/nuslider.min.css') }}">
@endsection
@section('main-content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
    <style>
        {
            background-color: blue;
        }

        .btn {
            color: inherit;
        }

        * {
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
            color: #379937;
        }

        body {
            margin: 40px;
        }

        .dropdown {
            position: relative;
            font-size: 14px;
            color: #333;

            .dropdown-list {
                padding: 12px;
                background: #fff;
                position: absolute;
                top: 30px;
                left: 2px;
                right: 2px;
                box-shadow: 0 1px 2px 1px rgba(0, 0, 0, .15);
                transform-origin: 50% 0;
                transform: scale(1, 0);
                transition: transform .15s ease-in-out .15s;
                max-height: 66vh;
                overflow-y: scroll;
            }

            .dropdown-option {
                display: block;
                padding: 8px 12px;
                opacity: 0;
                transition: opacity .15s ease-in-out;
            }

            .dropdown-label {
                display: block;
                height: 30px;
                background: #fff;
                border: 1px solid #ccc;
                padding: 6px 12px;
                line-height: 1;
                cursor: pointer;

                &:before {
                    content: '▼';
                    float: right;
                }
            }

            &.on {
                .dropdown-list {
                    transform: scale(1, 1);
                    transition-delay: 0s;

                    .dropdown-option {
                        opacity: 1;
                        transition-delay: .2s;
                    }
                }

                .dropdown-label:before {
                    content: '▲';
                }
            }

            [type="checkbox"] {
                position: relative;
                top: -1px;
                margin-right: 4px;
            }
        }
    </style>
    {{-- <div class="card-body">
        <button class="popup-button btn btn-primary col-md-1"
            style="color: black; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Product
            Filters</button><br><br>
        <div class="filter-card" id="filterCard">
            <div class="card-body">
                <div class="form-group row">
                    <label for="nameFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Product
                        Name:</label>
                    <div class="col-lg-2">
                        <select for="nameFilter" id="choices-multiple-remove-button" name="colors[]" class="form-select"
                            placeholder="Select Product (Maximum Lenght 1)" multiple>
                            @foreach ($data as $key => $product)
                                <option value="{{ $product->name }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="model_noFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Model
                        No:</label>
                    <div class="col-lg-2">
                        <select id="choices-multiple-remove-button" name="colors[]" class="form-select"
                            placeholder="Select Product (Maximum Lenght 1)" for="model_noFilter" multiple>
                            @foreach ($data as $key => $product)
                                <option value="{{ $product->model_no }}">{{ $product->model_no }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="skuFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">SKU:</label>
                    <div class="col-lg-2">
                        <select id="choices-multiple-remove-button" name="colors[]" class="form-select"
                            placeholder="Select Product (Maximum Lenght 1)" for="skuFilter" multiple>
                            @foreach ($data as $key => $product)
                                <option value="{{ $product->sku }}">{{ $product->sku }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Color</label>
                    <div class=" col-lg-2">
                        <select id="choices-multiple-remove-button" name="colors[]" class="form-control"
                            placeholder="Select Color (Maximum Lenght 1)" for="nameFilter" multiple>
                            @foreach ($colors as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="categoriesFilter"
                        class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Categories:</label>
                    <div class="col-lg-2">
                        <select id="choices-multiple-remove-button"for="categoriesFilter" name="colors[]"
                            class="form-select" placeholder="Select Product (Maximum Lenght 1)" multiple>
                            @foreach ($categories as $categories)
                                <option value="{{ $categories->name }}">
                                    @if ($categories->name)
                                        {{ $categories->name ?? null }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <label for="subcategoriesFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Sub
                        Categories:</label>
                    <div class=" col-lg-2">
                        <select id="choices-multiple-remove-button" name="colors[]" class="form-select"
                            placeholder="Select Product (Maximum Lenght 1)" multiple>
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->name }}">
                                    @if ($subcategory->name)
                                        {{ $subcategory->name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <label for="makeFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Supplier
                        Name:</label>
                    <div class="col-lg-2">
                        <select id="choices-multiple-remove-button" name="colors[]" class="form-select"
                            placeholder="Select Product (Maximum Lenght 1)" multiple>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->first_name }} {{ $vendor->last_name }}">
                                    {{ $vendor->first_name }} {{ $vendor->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="brand_idFilter"
                        class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Brand</label>
                    <div class="col-lg-2">
                        <select id="choices-multiple-remove-button" name="colors[]" class="form-control"
                            placeholder="Select Color (Maximum Lenght 1)" multiple>
                            @foreach ($brand as $brand)
                                <option value="{{ $brand->brand_name ?? null }}">
                                    {{ $brand->brand_name ?? null }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="startDateFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Start Date:
                    </label>
                    <div class="col-lg-2">
                        <input type="date" id="startDateFilter" class="form-control">
                        <span style="color: red">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <label for="endDateFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">End Date:
                    </label>
                    <div class="col-lg-2"><input type="date" id="endDateFilter" class="form-control"></div>
                    <label for="conditionFilter"
                        class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Condition:&NonBreakingSpace;
                    </label>
                    <div class="col-lg-2 d-flex mt-20">
                        <label class="checkbox checkbox-primary mt-10">
                            <input type="checkbox" checked="">
                            <span>New</span>
                            <span class="checkmark"></span></label>&NonBreakingSpace;&NonBreakingSpace;
                        <label class="checkbox checkbox-primary">
                            <input type="checkbox">
                            <span>Refurbished</span>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <!-- Slider 1 -->
                    <label for="priceFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label"
                        style="font-size: 16px">Price: </label>&NonBreakingSpace;&NonBreakingSpace;
                    <div class="slider-example col-lg-2">
                        <div class="mb-3 slider-default noUi-target noUi-ltr noUi-horizontal" id="slider-non-linear-1">
                            <div class="noUi-base">
                                <div class="noUi-connect" style="left: 0%; right: 0%;"></div>
                                <div class="noUi-origin" style="left: 100%;">
                                    <div class="noUi-handle noUi-handle-lower"></div>
                                </div>
                            </div>
                        </div>
                        <p>Value: <span id="slider-non-linear-value-1">2000.00</span></p>
                    </div>

                    <!-- Slider 2 -->
                    <label for="priceFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label"
                        style="font-size: 16px">Tax Price: </label>&NonBreakingSpace;&NonBreakingSpace;
                    <div class="slider-example col-lg-2">
                        <div class="mb-3 slider-default noUi-target noUi-ltr noUi-horizontal" id="slider-non-linear-2">
                            <div class="noUi-base">
                                <div class="noUi-connect" style="left: 0%; right: 0%;"></div>
                                <div class="noUi-origin" style="left: 100%;">
                                    <div class="noUi-handle noUi-handle-lower"></div>
                                </div>
                            </div>
                        </div>
                        <p>Value: <span id="slider-non-linear-value-2">2000.00</span></p>
                    </div>

                    <!-- Slider 3 -->
                    <label for="priceFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label"
                        style="font-size: 16px">Commission Price: </label>&NonBreakingSpace;&NonBreakingSpace;
                    <div class="slider-example col-lg-2">
                        <div class="mb-3 slider-default noUi-target noUi-ltr noUi-horizontal" id="slider-non-linear-3">
                            <div class="noUi-base">
                                <div class="noUi-connect" style="left: 0%; right: 0%;"></div>
                                <div class="noUi-origin" style="left: 100%;">
                                    <div class="noUi-handle noUi-handle-lower"></div>
                                </div>
                            </div>
                        </div>
                        <p>Value: <span id="slider-non-linear-value-3">2000.00</span></p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <!-- Slider 4 -->
                    <label for="priceFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label"
                        style="font-size: 16px">Return Days: </label>&NonBreakingSpace;&NonBreakingSpace;
                    <div class="slider-example col-lg-2">
                        <div class="mb-3 slider-default noUi-target noUi-ltr noUi-horizontal" id="slider-non-linear-4">
                            <div class="noUi-base">
                                <div class="noUi-connect" style="left: 0%; right: 0%;"></div>
                                <div class="noUi-origin" style="left: 100%;">
                                    <div class="noUi-handle noUi-handle-lower"></div>
                                </div>
                            </div>
                        </div>
                        <p>Value: <span id="slider-non-linear-value-4">2000.00</span></p>
                    </div>

                    <!-- Slider 5 -->
                    <label for="priceFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label"
                        style="font-size: 16px">Warranty Days: </label>&NonBreakingSpace;&NonBreakingSpace;
                    <div class="slider-example col-lg-2">
                        <div class="mb-3 slider-default noUi-target noUi-ltr noUi-horizontal" id="slider-non-linear-5">
                            <div class="noUi-base">
                                <div class="noUi-connect" style="left: 0%; right: 0%;"></div>
                                <div class="noUi-origin" style="left: 100%;">
                                    <div class="noUi-handle noUi-handle-lower"></div>
                                </div>
                            </div>
                        </div>
                        <p>Value: <span id="slider-non-linear-value-5">2000.00</span></p>
                    </div>
                </div>
            </div>

            <p>Total Price: <span id="total-price">0.00</span></p>
        </div>
    </div> --}}

    <form action="{{ route('products.index') }}" method="GET">

        <select for="nameFilter" id="choices-multiple-remove-button" name="name[]" class="form-select"
            placeholder="Select Product (Maximum Lenght 1)" multiple>
            @foreach ($products as $key => $product)
                <option value="{{ $product->name }}">{{ $product->name }}</option>
            @endforeach
        </select>
        <input type="text" name="model_no" placeholder="Product Model">
        <input type="text" name="sku" placeholder="Product sku">
        <select name="make">
            <option value="">Select Supplier</option>
            @foreach ($supplier as $item)
                <option value="{{ $item->name }}">{{ $item->name }}</option>
            @endforeach
        </select>
        <!-- Include more input fields and select dropdowns for other filters -->
        <button type="submit">Apply Filter</button>
    </form>
    <div class="breadcrumb col-lg-12">
        <div class="col-md-6 col-sm-6">
            <h1>All Product</h1>
        </div>
        <div class="col-md-6 col-sm-6" style="text-align: right;  margin-left: auto;">
            <a href="{{ route('products.create') }}"><button
                    class="btn btn-outline-secondary  ladda-button example-button m-1" data-style="expand-left"><span
                        class="ladda-label">Add Product</span></button></a>
        </div>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">All Product</h4>
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
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script src="{{ asset('assets/js/vendor/nuslider.min.js') }}"></script>
    <script src="{{ asset('assets/js/nuslider.script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.1/nouislider.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var sliders = []; // Array to store slider instances
            var sliderValues = []; // Array to store slider value elements
            var totalPriceElement = $('#total-price'); // Element to display total price

            // Initialize 5 sliders
            for (var i = 1; i <= 5; i++) {
                var slider = document.getElementById('slider-non-linear-' + i);
                var sliderValue = document.getElementById('slider-non-linear-value-' + i);
                noUiSlider.create(slider, {
                    start: 2000, // Initial value
                    range: {
                        'min': 0,
                        'max': 5000
                    },
                    step: 100, // Slider step
                    format: {
                        to: function(value) {
                            return value.toFixed(2);
                        },
                        from: function(value) {
                            return parseFloat(value);
                        }
                    }
                });

                sliders.push(slider);
                sliderValues.push(sliderValue);
            }

            // Function to update total price
            function updateTotalPrice() {
                var totalPrice = 0;
                // Calculate total price from all slider values
                sliderValues.forEach(function(sliderValue) {
                    totalPrice += parseFloat(sliderValue.innerHTML);
                });
                // Display total price
                totalPriceElement.text(totalPrice.toFixed(2));
            }

            // Update the value display when each slider is moved
            sliders.forEach(function(slider, index) {
                slider.noUiSlider.on('update', function(values, handle) {
                    sliderValues[index].innerHTML = values[handle];
                    updateTotalPrice(); // Update total price when any slider is moved
                });
            });
        });

        function toggleFilters() {
            var filterCard = document.getElementById("filterCard");
            filterCard.style.display = (filterCard.style.display === "none" || filterCard.style.display === "") ? "block" :
                "none";
        }
        $(document).ready(function() {
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount: 5,
                callbackOnCreateTemplates: function(template) {
                    return {
                        itemRemoveButton: function(classNames, data) {
                            return '<button type="button" class="' + classNames.button + ' ' +
                                classNames.button +
                                '--remove" aria-label="Remove item" data-button="' + data +
                                '">×</button>';
                        },
                    };
                },
            });

            // Change highlight color to light gray
            $('.choices__list--multiple .choices__item').css('background-color', '#d3d3d3');

            // Change background color on selection change
            $('#choices-multiple-remove-button').on('change', function() {
                changeBackgroundColor();
            });
        });

        function changeBackgroundColor() {
            var colorMap = {};
            var selectedOptions = $('#choices-multiple-remove-button').val();

            $('.choices__list--multiple .choices__item').each(function(index, element) {
                var dataValue = $(element).attr('data-value');
                var backgroundColor = selectedOptions.includes(dataValue) ? '#d3d3d3' : '';
                $(element).css('background-color', backgroundColor);
            });
        }
    </script>
@endsection
