@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endsection
@section('main-content')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
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
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 10px;
            padding-left: 10px;
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
            margin-left: 150px;
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
        <button class="popup-button btn btn-primary col-md-1"
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Product
            Filters</button><br><br>
            <form action="{{ route('products.index') }}" method="GET">
                <button type="submit" class="btn btn-primary" style="margin-left: 1300px" >Submit</button>
        <div class="filter-card" id="filterCard">

            <div class="row" style="margin-top: 10px;">

                <div class="col-md-2">
                        <div class="dropdown" id="productNameDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Product Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="productNameSearchInput"
                                    placeholder="Search...">
                                    <div class="dropdown-options">
                                        <label class="nameFilter">
                                            <input type="checkbox" id="selectAllNames">
                                            <span class="option-text">Select All</span>
                                        </label>
                                        @foreach ($products as $key => $product)
                                            <label class="nameFilter">
                                                <input type="checkbox" name="name[]" value="{{ $product->name }}">
                                                <span class="option-text">{{ $product->name }}</span>
                                            </label>
                                        @endforeach
                                </div>
                                <div id="selectedProductNamesList"></div>
                            </div>
                        </div>

                </div>
                <div class="col-md-2">

                        <div class="dropdown" id="ModelNoDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Model No</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="ModelNoSearchInput"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($products as $key => $product)
                                        <label class="model_noFilter">
                                            <input type="checkbox" name="model_no[]" value="{{ $product->model_no }}"
                                                >
                                            <span class="option-text">{{ $product->model_no }}</span>
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
                                <input type="text" id="suppliernameSearchInput"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($products as $key => $product)
                                        <label class="makeFilter">
                                            <input type="checkbox" name="make[]" value="{{ $product->make }}"
                                                >
                                            <span class="option-text">{{ $product->make }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedsuppliernameList"></div>
                            </div>
                        </div>

                </div>

                <div class="col-md-2">
                        <div class="dropdown" id=" suppliernameDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Colors</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="suppliernameSearchInput"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($colors as $value)
                                    <label class="nameFilter">
                                            <input type="checkbox" name="name[]" value="{{ $value->name }}">
                                            <span class="option-text">{{ $value->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectednameList"></div>
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
                                <input type="text" id="nameSearchInput"
                                    placeholder="Search...">
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
                    </form>
                </div>

                <div class="col-md-2">
                    <div class="content-box">
                            <input type="number" id="quantity" name="min_order[]" min="1" max="500"
                                placeholder="MOQ" onchange="filterQuantity()">
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
                                <input type="text" id="nameSearchInput"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($categories as $category)
                                    <label class="categoriesFilter">
                                        <input type="checkbox" name="name[]" value="{{ $category->id }}" onclick="filterSubcategories(this)">
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
                                <input type="text" id="nameSearchInput"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($subcategories as $subcat)
                                    <label class="subcategoriesFilter">
                                        <input type="checkbox" name="name[]" value="{{ $subcat->name}}">
                                        <span class="option-text">{{ $subcat->name}}</span>
                                    </label>
                                @endforeach
                                </div>
                                <div id="selectedcategoriesList"></div>
                            </div>
                        </div>
                </div>
<script>
      $('#menu_id').change(function() {
            var menu_id = $(this).val();
            $.ajax({
                url: "{{ asset('get-categories') }}?menu_id=" + menu_id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.length > 0) {
                        var option = '<option value="" selected>Select Category</option>';
                        $.each(response, function(i, v) {
                            option += `<option value="${v.id}">${v.name}</option>`;
                        });
                        $('#category_id').html(option);
                    } else {
                        var option = '<option value="" selected>Category Not Found</option>';
                        $('#category_id').html(option);
                    }
                }
            });
        });
        // End Here

        // Change Categories

        $('#category_id').change(function() {
            var cat_id = $(this).val();
            $.ajax({
                url: "{{ asset('get-subcategories') }}?cat_id=" + cat_id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.length > 0) {
                        var option = '<option value="" selected>Select Sub Category</option>';
                        $.each(response, function(i, v) {
                            option += `<option value="${v.id}">${v.name}</option>`;
                        });
                        $('#subcategory_id').html(option);
                    } else {
                        var option = '<option value="" selected>Sub Category Not Found</option>';
                        $('#subcategory_id').html(option);
                    }
                }
            });
        });
</script>
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
                                                <input type="checkbox" style="margin-bottom: 3px;" value="{{ $brand->brand_name ?? null }} {{ $brand->logo ?? null }}">
                                                <span class="option-text d-flex">  {{ $brand->brand_name ?? null }}  <img src="{{ asset($brand->logo) }}" width="50" height="50" alt="{{ $brand->brand_name ?? null }}">
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>

                            </div>
                        </div>

                </div>

                <div class="col-md-2" style="margin-left: 30px;">
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

                <div class="col-md-2">
                    <div class="content-box">

                            <input type="button" class="datetimerange" value="12/31/2017 - 01/31/2018" />

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

                <div class="col-lg-3" style="margin-left: 100px;">
                    <div class="content-box">

                        <div class="slider">
                            <b>Price:</b>
                            <input type="range" min="0" max="1000000" value="100" oninput="updatePriceValue(this.value, 'rangeValue1')">
                            <p id="rangeValue1">100</p>
                        </div>
                        <div class="input-bar">
                            <label for="priceInput1">Enter Price:</label>
                            <input type="number" id="priceInput" min="0" max="1000000" value="100" oninput="updatePriceSlider(this.value, 'rangeValue1')">
                        </div>


                    </div>
                </div>

                <div class="col-lg-3" style="margin-left: 100px;">
                    <div class="content-box">

                        <div class="slider">
                            <b>Price:</b>
                            <input type="range" min="0" max="1000000" value="100" oninput="updatePriceValue(this.value, 'rangeValue2')">
                            <p id="rangeValue2">100</p>
                        </div>
                        <div class="input-bar">
                            <label for="priceInput2">Enter Price:</label>
                            <input type="number" id="priceInput" min="0" max="1000000" value="100" oninput="updatePriceSlider(this.value, 'rangeValue2')">
                        </div>


                    </div>
                </div>



            </div>

            <div class="row d-flex" style="margin-top: 40px;">
                <div class="col-md-3" style="margin-left: 10px;">
                    <div class="content-box">

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
                            <div class="input-bar">
                                <label for="priceInput">Enter Price:</label>
                                <input type="number" id="priceInput3" min="0" max="1000000" value="100" oninput="updatePriceSlider(this.value, 'rangeValue3')">
                            </div>

                    </div>
                </div>

                <div class="col-md-3" style="margin-left: 50px;">
                    <div class="content-box">

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

                <div class="col-md-3" style="margin-left: 50px;">
                    <div class="content-box">

                            <div class="slider"><b>Commission:</b>
                                <label for="fader"></label><input type="range" min="0" max="100"
                                    value="50" id="fader" step="20" list="volsettings"
                                    oninput="updatePriceValue(this.value, 'rangeValue5')">
                                <p id="rangeValue5">100</p>
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


                <script>
                    function updatePriceValue(value, outputId) {
                        document.getElementById(outputId).textContent = value;
                    }

                    function updatePriceSlider(value, sliderId) {
                        document.getElementById(sliderId).textContent = value;
                        document.querySelector('input[type="range"]').value = value;
                    }

                    function filterProducts() {
                        // Add your filtering logic here
                        let price = document.getElementById('priceInput').value;
                        console.log('Filtering products with price less than or equal to: ' + price);
                    }
                </script>


            </div>
        </form>
            <script>
                function updatePriceValue(value, targetId) {
                    document.getElementById(targetId).innerText = value;
                }
                    document.getElementById('selectAllNames').addEventListener('change', function() {
                        var checkboxes = document.querySelectorAll('#productNameDropdown input[type="checkbox"]');
                        checkboxes.forEach(function(checkbox) {
                            checkbox.checked = this.checked;
                        }, this);
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
