@extends('layouts.master')
@section('before-css')
{{-- css link sheet  --}}
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_dots.min.css')}}">
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/choices.min.css') }}">
@section('main-content')


<style>
    .card {
        padding: 5% 5% 5% 5%;
    }

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
</style>
<div class="card col-md-12">
    <button class="popup-button col-md-2" style="background-color: antiquewhite; color: black;" onclick="toggleFilters()">Product Filters</button><br><br>
    <div class="filter-card" id="filterCard">
        <div class="filter-row d-flex gap-4">
            <label for="nameFilter" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Product Name:</label>
            <div class=" col-lg-3 mt-auto">
            <select  id="choices-multiple-remove-button" name="colors[]" class="form-select" placeholder="Select Product (Maximum Lenght 5)"  multiple >
                @foreach ($data as $key => $product)
                        <option value="{{ $product->name }}">{{ $product->name }}</option>
                @endforeach
            </select>
            </div>
            <label for="modelFilter">Model#:</label>
            <select id="modelFilter" class="form-select">
                <option value="" selected>select</option>
                @foreach ($data as $key => $product)
                <option value="{{ $product->model_no }}">{{ $product->model_no }}</option>
                @endforeach
            </select>&NonBreakingSpace; &NonBreakingSpace;
            <label for="categoriesFilter" class="col-form-label">Categories:</label>
            <select id="categoriesFilter" class="form-select">
                <option value="" selected>select</option>
                @foreach ($categories as $categories)
                <option value="{{ $categories->name }}">
                    @if ($categories->name)
                    {{ $categories->name ?? null }}
                    @endif
                </option>
                @endforeach
            </select>&NonBreakingSpace; &NonBreakingSpace;
            <label for="subcategoriesFilter">Sub Category:</label>
<select id="subcategoriesFilter" name="subcategories[]" class="form-control" placeholder="Select Subcategory (Maximum Length 5)" multiple>
    <option value="" selected>select</option>
    @foreach ($subcategories as $subcategory)
        <option value="{{ $subcategory->name }}">
            @if ($subcategory->name)
                {{ $subcategory->name }}
            @endif
        </option>
    @endforeach
</select>

        </div>
        <br><br>
        <div class="filter-row d-flex gap-4">
            <label for="makeFilter" class="col-form-label">Supplier Name:</label>
            <select id="makeFilter" class="form-select">
                <option value="" selected>select</option>
                @foreach ($data as $product)
                <option value="{{ $product->make }}">{{ $product->make ?? null}}</option>
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
        <br><br>
        <div class="filter-row d-flex gap-4">
            <!-- <label for="min_orderFilter" class="col-form-label">MOQ:</label>
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
                    {{ $brand->brand_name ?? null }}
                </option>
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
            </select> -->

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

<script>
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
        $('#nameFilter, #modelFilter, #startDateFilter, #categoriesFilter, , #subcategoriesFilter #endDateFilter').on('input change',
            function() {
                applyFilters();
            });
    });
</script>


<div class="breadcrumb">
    <div class="col-md-6">
        <h1>Product's Management</h1>
    </div>
    <div class="col-md-6" style="text-align: right;  margin-left: auto;">
        <a href="{{ route('products.create')}}"><button class="btn btn-outline-secondary  ladda-button example-button m-1" data-style="expand-left"><span class="ladda-label">Add Product</span></button></a>

    </div>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="col-md-12 mb-4">
    <div class="card text-start">

        <div class="card-body">
            <h4 class="card-title mb-3">All Product's</h4>
            <div class="table-responsive">
                <table id="deafult_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                    @include('datatables.table_content')

                </table>
            </div>

        </div>

    </div>
</div>
@section('page-js')

<script>
    $(document).ready(function () {
        $('#smartwizard').smartWizard({
            selected: 0,  // Initial step
            keyNavigation: false, // Enable keyboard navigation

        });
    });
</script>


<script>
$(document).ready(function() {
    $("#m_unit").change(function() {
        var selectedValue = $(this).val();

        $("#W_Fields, #H_Fields, #D_Fields, #W_L, #H_L, #D_L").hide();

        if (selectedValue === "Millimeter" || selectedValue === "Centimeter" || selectedValue === "Inch" || selectedValue === "Meter") {
            $("#W_Fields, #H_Fields, #D_Fields, #W_L, #H_L, #D_L").show();
        };
    });

    $("#weight_unit").change(function() {
        var selectedValue = $(this).val();

        $("#Weight_Field,#Weight_L").hide();

        if (selectedValue === "Ounce" || selectedValue === "Milligram" || selectedValue === "Gram" || selectedValue === "Kilogram" || selectedValue === "MetricTon" ) {
            $("#Weight_Field,#Weight_L").show();
        };
    });

    // $("#tax_type").change(function() {
    //     var selectedValue = $(this).val();

    //     $(" #tax_charges").hide();

    //     if (selectedValue === "Amount" || selectedValue === "Percentage" ) {
    //         $("#tax_charges").show();
    //     };
    // });
});


</script>
<!-- Multi Select Dropdown -->
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script>
        function changeBackgroundColor() {
            var colorMap = {
                '1': '#FF0000',
                '2': '#0000FF',
                '3': '#FFFDD0',
                '4': '#FFFF33',
                '5': '#006400',
                '6': '#FFFFFF',
                '7': '#FF6600',
                '8': '#964B00',
                '9': '#000000',
                '10': '#007FFF',
                '11': '#FFFFF0',
                '12': '#A020F0',
                '13': '#C3B091',
                '14': '#FFC0CB',
                '15': '#FFD700',
                '16': '#808000',
                '17': '#00FFFF',
                '18': '#673147',
                '19': '#808080',
                '20': '#C0C0C0',
                '21': '#000080',
                '22': '#FAF9F6'
            };

            var selectedOptions = $('#choices-multiple-remove-button').val();

            $('.choices__list--multiple .choices__item').each(function(index, element) {
                var dataValue = $(element).attr('data-value');
                var backgroundColor = selectedOptions.includes(dataValue) ? colorMap[dataValue] : '';
                $(element).css('background-color', backgroundColor);
            });
        }

        $(document).ready(function() {
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: false,
                maxItemCount: 5,
                // searchResultLimit:5,
                // renderChoiceLimit:5

                // classNames: {
                //     button: 'choices-custom-button', // Add a custom class for the button
                //     },

            });
            $('#choices-multiple-remove-button').on('change', changeBackgroundColor);

            document.addEventListener('click', function() {
                changeBackgroundColor();
            });

            $(document).ready(function() {
                changeBackgroundColor();
            });

            var multipleCancelButton = new Choices('#choices-multiple-remove-button1', {
                removeItemButton: true,
                // maxItemCount:5,
                // searchResultLimit:5,
                // renderChoiceLimit:5
            });

        });
    </script>


<script>

    function onlyNumberKey(evt) {
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    function onlyDecimalNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>


<script>
    const imageInput = document.getElementById('imageInput');
    const thumbnailContainer = document.getElementById('thumbnailContainer');

    imageInput.addEventListener('change', function () {
        thumbnailContainer.innerHTML = ''; // Clear existing thumbnails

        Array.from(imageInput.files).forEach(file => {
            const reader = new FileReader();

            reader.onload = function (event) {
                const thumbnail = document.createElement('img');
                thumbnail.classList.add('thumbnail');
                thumbnail.src = event.target.result;
                thumbnailContainer.appendChild(thumbnail);
            };

            reader.readAsDataURL(file);
        });
    });
</script>


<script src="{{asset('assets/js/vendor/jquery.smartWizard.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="{{asset('assets/js/vendor/quill.min.js')}}"></script>


<script>
        //Change Menus
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


        // End Here
    </script>



{{-- <script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script> --}}

    {{-- @if ($errors->any())
    <script>
        toastr.error("{{ $errors->first() }}");
    </script>
    @endif --}}

    {{-- {!! Toastr::message() !!} --}}

<script>
    function selectMenu(menuText, inputId) {
        document.getElementById(inputId).value = menuText;
    }
</script>




<script src="{{ asset('website-assets/js/multiple_images_uploading.js') }}"></script>

<!-- include TinyMceEditor js -->
<script src="https://cdn.tiny.cloud/1/ki85z92gad4jwy6pn6wzw9uctxkdmgs0nn8tawovzdc0j1zb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
{{-- <script src="https://cdn.tiny.cloud/1/ki85z92gad4jwy6pn6wzw9uctxkdmgs0nn8tawovzdc0j1zb/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
@endsection
@section('bottom-js')
<script src="{{asset('assets/js/smart.wizard.script.js')}}"></script>
<script src="{{asset('assets/js/quill.script.js')}}"></script>
@endsection
@section('page-js')
<script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
@endsection
