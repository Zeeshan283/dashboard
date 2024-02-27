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
            margin-left: 15px;
        }
    </style>


    <div class="card-body">
        <button class="popup-button btn btn-primary col-md-1"
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Product
            Filters</button><br><br>
        <div class="filter-card" id="filterCard">
            <div class="row" style="margin-top: 10px;">
                <div class="col-md-2">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="dropdown" id="productNameDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Product Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="productNameSearchInput" onkeyup="filterProductNames()"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($products as $key => $product)
                                        <label class="nameFilter">
                                            <input type="checkbox" value="{{ $product->name }}"
                                                onclick="toggleProductName('{{ $product->name }}')">
                                            <span class="option-text">{{ $product->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedProductNamesList"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="dropdown" id="modelNoDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Model No</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <input type="text" id="modelNoSearchInput" onkeyup="filterModelNumbers()"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($products as $key => $product)
                                        <label class="model_noFilter">
                                            <input type="checkbox" value="{{ $product->model_no }}"
                                                onclick="toggleModelNo('{{ $product->model_no }}')">
                                            <span class="option-text">{{ $product->model_no }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedModelNosList"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="dropdown" id="supplierNameDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton3" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Supplier Name</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <input type="text" id="supplierNameSearchInput" onkeyup="filterSupplierNames()"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($products as $key => $product)
                                        <label class="makeFilter">
                                            <input type="checkbox" value="{{ $product->make }}"
                                                onclick="toggleSupplierName('{{ $product->make }}')">
                                            <span class="option-text">{{ $product->make }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div id="selectedSupplierNamesList"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-2">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="dropdown" id="colorDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton4" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Product Colors</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                <input type="text" id="colorSearchInput" onkeyup="filterColors()"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($colors as $value)
                                        <label class="nameFilter" name="color[]">
                                            <input type="checkbox" value="{{ $value->name }}"
                                                onclick="toggleColor('{{ $value->name }}')">
                                            <span class="option-text">{{ $value->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-2">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="dropdown" id="menuDropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton5" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Product Menu</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                                <input type="text" id="menuSearchInput" onkeyup="filterMenus()"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($menus as $menu)
                                        <label class="nameFilter">
                                            <input type="checkbox" value="{{ $menu->name }}"
                                                onclick="toggleMenu('{{ $menu->name }}')">
                                            <span class="option-text">{{ $menu->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-2">
                    <div class="content-box">
                        <form action="{{ route('products.index') }}" method="GET">
                            <input type="number" id="quantity" name="quantity" min="1" max="500"
                                placeholder="MOQ" onchange="filterQuantity()">
                        </form>
                    </div>
                </div>


            </div>

            <div class="row" style="margin-top: 10px;">

                <div class="col-md-2">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton6" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Categories</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                <input type="text" id="searchInput" onkeyup="filterOptions()"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($categories as $category)
                                        <label class="categoriesFilter">
                                            <input type="checkbox" value="{{ $category->name }}">
                                            <span class="option-text">{{ $category->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-2">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton7" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left ">Sub Category</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                <input type="text" id="searchInput" onkeyup="filterOptions()"
                                    placeholder="Search...">
                                <div class="dropdown-options">
                                    @foreach ($subcategories as $subcat)
                                        <label class="categoriesFilter">
                                            <input type="checkbox" value="{{ $subcat->name }}">
                                            <span class="option-text">{{ $subcat->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-2">
                    <form action="{{ route('products.index') }}" method="GET">
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
                                                <input type="checkbox" style="margin-bottom: 3px;" value="{{ $brand->brand_name ?? null }} $nbsp; {{ $brand->logo ?? null }}">
                                                <span class="option-text d-flex">  {{ $brand->brand_name ?? null }}  <img src="{{ asset($brand->logo) }}" width="50" height="50" alt="{{ $brand->brand_name ?? null }}">
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>

                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-2" style="margin-left: 30px;">
                    <label>Condition:</label>
                    <form action="{{ route('products.index') }}" method="GET">
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
                    </form>
                </div>

                <div class="col-md-2">
                    <div class="content-box">
                        <form action="{{ route('products.index') }}" method="GET">
                            <input type="button" class="datetimerange" value="12/31/2017 - 01/31/2018" />
                        </form>
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
                        <form action="{{ route('products.index') }}" method="GET">
                            <div class="slider"><b>Price:</b>
                                <input type="range" min="0" max="200" value="100"
                                    oninput="updatePriceValue(this.value, 'rangeValue1')">
                                <p id="rangeValue1">100</p>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-3" style="margin-left: 100px;">
                    <div class="content-box">
                        <form action="{{ route('products.index') }}" method="GET">
                            <div class="slider"><b>Tax:</b>
                                <input type="range" min="0" max="200" value="100"
                                    oninput="updatePriceValue(this.value, 'rangeValue2')">
                                <p id="rangeValue2">100</p>
                            </div>
                        </form>
                    </div>
                </div>



            </div>

            <div class="row d-flex" style="margin-top: 40px;">
                <div class="col-md-3" style="margin-left: 100px;">
                    <div class="content-box">
                        <form action="{{ route('products.index') }}" method="GET">
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
                        </form>
                    </div>
                </div>

                <div class="col-md-3" style="margin-left: 100px;">
                    <div class="content-box">
                        <form action="{{ route('products.index') }}" method="GET">
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
                        </form>
                    </div>
                </div>

                <div class="col-md-2" style="margin-right: 800px;">
                    <div class="content-box">
                        <form action="{{ route('products.index') }}" method="GET">
                            <div class="slider-container"> Commission:
                                <label for="fader"></label><input type="range" min="0" max="100"
                                    value="50" id="price-slider" class="vertical-slider" step="20"
                                    list="volsettings" oninput="updatePriceValue(this.value, 'rangeValue5')">
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
                        </form>
                    </div>
                </div>

            </div>

            <script>
                function updatePriceValue(value, targetId) {
                    document.getElementById(targetId).innerText = value;
                }
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

    <script>
        function toggleFilters() {
            var filterCard = document.getElementById("filterCard");
            filterCard.style.display = (filterCard.style.display === "none" || filterCard.style.display === "") ? "block" :
                "none";
        }

        let selectedProductNames = new Set();
        let selectedModelNos = new Set();
        let selectedSupplierNames = new Set();

        function filterProductNames() {
            selectedProductNames = new Set();
            let input, filter, div, checkboxes, i;
            input = document.getElementById('productNameSearchInput');
            filter = input.value.toUpperCase();
            div = document.getElementById('productNameDropdown');
            checkboxes = div.querySelectorAll('.nameFilter input[type="checkbox"]');
            for (i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].value.toUpperCase().indexOf(filter) > -1) {
                    checkboxes[i].parentNode.style.display = "";
                    if (checkboxes[i].checked) {
                        selectedProductNames.add(checkboxes[i].value);
                    }
                } else {
                    checkboxes[i].parentNode.style.display = "none";
                }
            }
            updateSelectedProductNamesList();
            filterDataList();
        }

        function toggleProductName(name) {
            if (selectedProductNames.has(name)) {
                selectedProductNames.delete(name);
            } else {
                selectedProductNames.add(name);
            }
            updateSelectedProductNamesList();
            filterDataList();
        }

        function updateSelectedProductNamesList() {
            let list = document.getElementById('selectedProductNamesList');
            list.innerHTML = '';
            selectedProductNames.forEach(name => {
                let item = document.createElement('div');
                item.textContent = name;
                list.appendChild(item);
            });
        }

        function filterModelNumbers() {
            selectedModelNos = new Set();
            let input, filter, div, checkboxes, i;
            input = document.getElementById('modelNoSearchInput');
            filter = input.value.toUpperCase();
            div = document.getElementById('modelNoDropdown');
            checkboxes = div.querySelectorAll('.model_noFilter input[type="checkbox"]');
            for (i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].value.toUpperCase().indexOf(filter) > -1) {
                    checkboxes[i].parentNode.style.display = "";
                    if (checkboxes[i].checked) {
                        selectedModelNos.add(checkboxes[i].value);
                    }
                } else {
                    checkboxes[i].parentNode.style.display = "none";
                }
            }
            updateSelectedModelNosList();
            filterDataList();
        }

        function toggleModelNo(modelNo) {
            if (selectedModelNos.has(modelNo)) {
                selectedModelNos.delete(modelNo);
            } else {
                selectedModelNos.add(modelNo);
            }
            updateSelectedModelNosList();
            filterDataList();
        }

        function updateSelectedModelNosList() {
            let list = document.getElementById('selectedModelNosList');
            list.innerHTML = '';
            selectedModelNos.forEach(modelNo => {
                let item = document.createElement('div');
                item.textContent = modelNo;
                list.appendChild(item);
            });
        }

        function filterSupplierNames() {
            selectedSupplierNames = new Set();
            let input, filter, div, checkboxes, i;
            input = document.getElementById('supplierNameSearchInput');
            filter = input.value.toUpperCase();
            div = document.getElementById('supplierNameDropdown');
            checkboxes = div.querySelectorAll('.makeFilter input[type="checkbox"]');
            for (i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].value.toUpperCase().indexOf(filter) > -1) {
                    checkboxes[i].parentNode.style.display = "";
                    if (checkboxes[i].checked) {
                        selectedSupplierNames.add(checkboxes[i].value);
                    }
                } else {
                    checkboxes[i].parentNode.style.display = "none";
                }
            }
            updateSelectedSupplierNamesList();
            filterDataList();
        }

        function toggleSupplierName(supplierName) {
            if (selectedSupplierNames.has(supplierName)) {
                selectedSupplierNames.delete(supplierName);
            } else {
                selectedSupplierNames.add(supplierName);
            }
            updateSelectedSupplierNamesList();
            filterDataList();
        }

        function updateSelectedSupplierNamesList() {
            let list = document.getElementById('selectedSupplierNamesList');
            list.innerHTML = '';
            selectedSupplierNames.forEach(supplierName => {
                let item = document.createElement('div');
                item.textContent = supplierName;
                list.appendChild(item);
            });
        }

        function filterDataList() {
            let rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                let productName = row.querySelector('td:nth-child(2)').textContent;
                let modelNo = row.querySelector('td:nth-child(3)').textContent;
                let supplierName = row.querySelector('td:nth-child(6)').textContent;
                if ((selectedProductNames.size === 0 || selectedProductNames.has(productName)) &&
                    (selectedModelNos.size === 0 || selectedModelNos.has(modelNo)) &&
                    (selectedSupplierNames.size === 0 || selectedSupplierNames.has(supplierName))) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        filterProductNames();
        filterModelNumbers();
        filterSupplierNames();
    </script>


@endsection

@section('page-js')
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
@endsection
