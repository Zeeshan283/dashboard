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

        .col-md-2 {
            max-width: 20%;
        }

        .dropdown-menu {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ced4da;
            padding: 12px;
            max-height: 280px;
            max-width: 250px;
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

        input:focus {
            border-color: #ced4da;
            outline: none;
        }

        .datetimerange {
            border-color: #ccc !important;
            max-width: 300px;
            border: 2px solid;
            padding-top: 9px;
            padding-bottom: 9px;
            padding-right: 70px;
            padding-left: 70px;
            background-color: #f8f9fa;
        }

        .content-box {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .slider {
            position: relative;
            width: 400px;
            height: 30px;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 10px;
            padding-right: 15px;
            margin-left: 10px;
            background: #fcfcfc;
            border-radius: 25px;
            display: flex;
            box-shadow: 0px 15px 40px #7E6D5766;
        }

        .slider label {
            font-size: 28px;
            font-weight: 600;
            font-family: Open Sans;
            padding-left: 30px;
            color: black;
        }

        .slider input[type="range"] {
            width: 320px;
            height: 4px;
            background: black;
            border: none;
            outline: none;
        }

        .range input {
            margin-top: 10%;
            -webkit-transform: rotate(40deg);
            -moz-transform: rotate(40deg);
            -o-transform: rotate(40deg);
            transform: rotate(270deg);
            max-height: 5%;
        }

        .p {
            text-align: left;
            text-color: rgb(113, 107, 107);
            font-weight: 300;
            font-size: 18px;
        }

        .dropdown-toggle {
            display: flex;
            max-width: 300px;
            padding-right: 100px;
            padding-left: 30px;
            background-color: #f8f9fa;
            border: 2px solid #e2eaf1;
            cursor: pointer;
            padding-top: 10px;
            padding-bottom: 5px;
            overflow: hidden;
        }

        .text-left {
            margin-right: auto;
        }

        #quantity {
            max-width: 300px;
            padding-right: 40px;
            padding-left: 40px;
            background-color: #f8f9fa;
            border: 3px solid #e2eaf1;
            cursor: pointer;
            padding-top: 12px;
            padding-bottom: 12px;
            overflow: hidden;
        }

        .input-bar {
            background-color: #f8f9fa;
            border: 3px solid #e2eaf1;
        }

        .vertical-slider {
            margin-bottom: 0px;
            transform: rotate(270deg);
        }

        .filter-card {
            margin-right: 0px;
            overflow: hidden;
            margin-left: 10px;
        }
    </style>


    <div class="card-body">
        <button class="popup-button btn btn-secondary col-md-1"
            style="color: white; position: relative; top: 10px; right: 5px;" onclick="toggleFilters()">Products
            Filters</button><br><br>
        <div class="filter-card" id="filterCard" style="display: none;">
            <form action="{{ route('products.index') }}" method="GET">
                <button type="submit" class="btn btn-secondary" style="margin-left: 1300px">Submit</button>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-md-2">
                        <div class="dropdown" id="nameDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Product Name</p>
                                
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="nameSearchInput" placeholder="Search...">
                                <div class="dropdown-options">
                                    <label class="nameFilter" for="nameFilter">
                                        <input type="checkbox" id="selectAllNames" class="nameFilter">
                                        <span class="option-text" name="name[]">Select All</span>
                                    </label>
                                    @foreach ($products as $key => $product)
                                        <label class="nameFilter">
                                            <input type="checkbox" name="name[]" value="{{ $product->name ?? null }}">
                                            <span class="option-text" name="name[]">{{ $product->name ?? null }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectednameList"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="dropdown" id="model_noDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Model No</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <input type="text" id="model_noSearchInput" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($products as $key => $product)
                                        <label class="model_noFilter">
                                            <input type="checkbox" name="model_no[]"
                                                value="{{ $product->model_no ?? null }}">
                                            <span class="option-text">{{ $product->model_no ?? null }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedModelNoList"></div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2">
                        <div class="dropdown" id=" suppliernameDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Supplier Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="suppliernameSearchInput" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($products as $key => $product)
                                        <label class="makeFilter">
                                            <input type="checkbox" name="make[]" value="{{ $product->make ?? null }}">
                                            <span class="option-text">{{ $product->make ?? null }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedsuppliernameList"></div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-2">
                        <div class="dropdown" id=" colorDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Colors</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="colorSearchInput" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($colors as $value)
                                        <label class="nameFilter">
                                            <input type="checkbox" name="name[]" value="{{ $value->name }}">
                                            <span class="option-text">{{ $value->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedcolorList"></div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-2">
                        <div class="dropdown" id="menuDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Menu</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="nameSearchInput" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($menus as $menu)
                                        <label class="nameFilter">
                                            <input type="checkbox" name="name[]" value="{{ $menu->name }}">
                                            <span class="option-text">{{ $menu->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectednameList"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="content-box">
                            <label for="min_order">
                                <input type="number" id="quantity" name="min_order[]" min="1" max="500"
                                    placeholder="MOQ"></label>
                        </div>
                    </div>


                </div>

                <div class="row" style="margin-top: 10px;">

                    <div class="col-md-2">
                        <div class="dropdown" id="menuDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Categories</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="nameSearchInput" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($categories as $category)
                                        <label class="categoriesFilter">
                                            <input type="checkbox" name="name[]" value="{{ $category->id }}"
                                                onclick="filterSubcategories(this)">
                                            <span class="option-text">{{ $category->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedcategoriesList"></div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="dropdown" id="menuDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Sub Categories</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="nameSearchInput" placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($subcategories as $subcat)
                                        <label class="subcategoriesFilter">
                                            <input type="checkbox" name="name[]" value="{{ $subcat->name }}">
                                            <span class="option-text">{{ $subcat->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedcategoriesList"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton8" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Brand</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton8" style="max-width: 1000px;">
                                <input type="text" id="searchInput" onkeyup="filterOptions()"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($brand as $brand)
                                        <label class="brand_nameFilter d-flex">
                                            <input type="checkbox" style="margin-bottom: 3px;"
                                                value="{{ $brand->brand_name ?? null }} {{ $brand->logo ?? null }}">
                                            <span class="option-text d-flex"> {{ $brand->brand_name ?? null }} <img
                                                    src="{{ asset($brand->logo) }}" width="50" height="50"
                                                    alt="{{ $brand->brand_name ?? null }}">
                                            </span>
                                        </label>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-2" style="margin-left: 0px;">
                        <label>Condition:</label>

                        <div class="row">
                            <div class="col">
                                <label>New:</label>
                            </div>
                            <div class="col">
                                <input type="checkbox" checked style="--s:30px">
                            </div>
                            <div class="col">
                                <label>Refurbished:</label>
                            </div>
                            <div class="col">
                                <input type="checkbox">
                            </div>
                        </div>

                    </div>

                    <div class="col-md-2" style="margin-left: 0px;">
                        <div class="content-box">
                            <input type="text" name="dateTime" class="datetimerange" />
                        </div>
                    </div>
                   
                    <script>
                        $(function() {
                            $('.datetimerange').daterangepicker({
                                timePicker: true,
                                timePickerIncrement: 30,
                                locale: {
                                    format: 'MM/DD/YYYY h:mm A'
                                }
                            });
                        });
                    </script>


                </div>

                <div class="row d-flex">

                    <div class="col-lg-3" style="margin-left: 0px; display: flex;">
                        <div class="content-box d-flex">
                            <div class="input-bar">
                                <label for="priceInput1">Enter Price:</label>
                                <input type="number" id="priceInput1" min="0" max="100000" value="1000"
                                    oninput="updatePriceSlider(this.value, 'rangeValue1')">
                            </div>
                            <div class="slider">
                                <b>Price:</b>
                                <input type="range" min="0" max="1000000" value="100"
                                    oninput="updatePriceValue(this.value, 'rangeValue1')">
                                <p id="rangeValue1">1000</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3" style="margin-left: 50px;">
                        <div class="content-box d-flex">
                            <div class="input-bar" style="margin-left: 250px;">
                                <label for="priceInput2">Enter Price:</label>
                                <input type="number" id="priceInput2" min="0" max="100000" value="1000"
                                    oninput="updatePriceSlider(this.value, 'rangeValue2')">
                            </div>
                            <div class="slider">
                                <b>Price:</b>
                                <input type="range" min="0" max="1000000" value="100"
                                    oninput="updatePriceValue(this.value, 'rangeValue2')">
                                <p id="rangeValue2">1000</p>
                            </div>


                        </div>
                    </div>



                </div>

                <div class="row d-flex" style="margin-top: 40px;">
                    <div class="col-md-3">
                        <div class="content-box d-flex">
                            <div class="input-bar">
                                <label for="priceInput3">Enter Price:</label>
                                <input type="number" id="priceInput3" min="0" max="100000" value="100"
                                    oninput="updatePriceSlider(this.value, 'rangeValue3')">
                            </div>
                            <div class="slider"><b>ReturnDays:</b>
                                <label for="fader"></label><input type="range" min="0" max="100"
                                    value="50" id="fader" step="20" list="volsettings"
                                    oninput="updatePriceValue(this.value, 'rangeValue3')">
                                <p id="rangeValue3">100</p>
                                <datalist id="volsettings">
                                    <option>0</option>
                                    <option>20</option>
                                    <option>40</option>
                                    <option>60</option>
                                    <option>80</option>
                                    <option>100</option>
                                </datalist>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-3" style="margin-left: 50px;">
                        <div class="content-box d-flex">
                            <div class="input-bar" style="margin-left: 250px;">
                                <label for="priceInput4">Enter Price:</label>
                                <input type="number" id="priceInput4" min="0" max="1000000" value="100"
                                    oninput="updatePriceSlider(this.value, 'rangeValue4')">
                            </div>
                            <div class="slider"><b>WarrantyDays:</b>
                                <label for="fader"></label><input type="range" min="0" max="100"
                                    value="50" id="fader" step="20" list="volsettings"
                                    oninput="updatePriceValue(this.value, 'rangeValue4')">
                                <p id="rangeValue4">100</p>
                                <datalist id="volsettings">
                                    <option>0</option>
                                    <option>20</option>
                                    <option>40</option>
                                    <option>60</option>
                                    <option>80</option>
                                    <option>100</option>
                                </datalist>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="row d-flex" style="margin-top: 40px;">

                    <div class="col-md-3" style="margin-left: 200px;">
                        <div class="content-box d-flex">
                            <div class="input-bar" style="margin-left: 120px;">
                                <label for="priceInput5">Enter Price:</label>
                                <input type="number" id="priceInput5" min="0" max="1000000" value="100"
                                    oninput="updatePriceSlider(this.value, 'rangeValue5')">
                            </div>
                            <div class="slider"><b>Commission:</b>
                                <label for="fader"></label><input type="range" min="0" max="100"
                                    value="50" id="fader" step="20" list="volsettings"
                                    oninput="updatePriceValue(this.value, 'rangeValue5')">
                                <p id="rangeValue5">100</p>
                                <datalist id="volsettings">
                                    <option>10000</option>
                                    <option>20000</option>
                                    <option>40000</option>
                                    <option>60000</option>
                                    <option>80000</option>
                                    <option>100000</option>
                                </datalist>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                    function updatePriceValue(value, outputId) {
                        document.getElementById(outputId).textContent = value;
                    }

                    function updatePriceSlider(value, sliderId) {
                        document.getElementById(sliderId).textContent = value;
                        document.querySelector('input[type="range"]').value = value;
                    }
                </script>
        </div>
        </form>
        <script>
            function updatePriceValue(value, targetId) {
                document.getElementById(targetId).innerText = value;
            }
            $(document).ready(function() {
                $('#selectAllNames').change(function() {
                    $('.nameFilter input[type="checkbox"]').prop('checked', $(this).prop('checked'));
                });
            });

            $('.btn-primary').click(function() {
                $('form').submit();
            });
        </script>

    </div>
    </div>


    <div class="separator-breadcrumb border-top"></div>
    <div class="breadcrumb col-lg-12">
        <div class="col-md-6 col-sm-6">
            <h1>All Products</h1>
        </div>
        <div class="col-md-6 col-sm-6" style="text-align: right;  margin-left: auto;">
            <a href="{{ route('products.create') }}"><button
                    class="btn btn-outline-secondary ladda-button example-button m-1" data-style="expand-left"><span
                        class="ladda-label">Add Product</span></button></a>
        </div>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">All Products</h4>
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
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>


    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
