@extends('layouts.master')
@section('before-css')

    
@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Add Purchase</h1>
            </div>
 
            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Add Purchase</h3>
                                </div>

                                <form method="post" action="{{ route('purchase.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Date:</label>
                                                <input type="date" class="form-control" id="date" placeholder="Select Date"  >
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your  name
                                                </small> --}}
                                            </div>
    
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Bill Number:</label>
                                                <input type="number" class="form-control" id="bill_number" placeholder="Enter your Bill Number" >
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your  Bill Number
                                                </small>
                                            </div>


                                            <div class="form-group col-md-4">
                                                <label for="product_sku" class="ul-form__label">Select Supplier:</label>
                                                <select class="form-control" id="supplier" data-live-search="true">
                                                    <option value="" selected disabled>Select Product Supplier</option>
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id}}">{{ $supplier->name}}</option>
                                                    @endforeach
                                                </select>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please Select Product SKU
                                                </small>
                                            </div>
                                           
                                            <div class="form-group col-md-4">
                                                <label for="product_sku" class="ul-form__label">Select SKU:</label>
                                                <select class="form-control" id="product_sku" data-live-search="true">
                                                    <option value="" selected disabled>Select Product Vendor</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->sku}}">{{ $product->sku}}</option>
                                                    @endforeach
                                                </select>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please Select Vendor
                                                </small>
                                            </div>
                                            
                                           
                                            

                                           

                                            <div class="form-group col-md-4">
                                                <label for="selected_product_name" class="ul-form__label">Product Name:</label>
                                                {{-- <input type="text" class="form-control" id="selected_product_name" value=""  readonly> --}}
                                                <input type="text" class="form-control"  id="selected_product_name" placeholder="Product Name"  readonly>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Product Name
                                                </small>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="selected_product_name" class="ul-form__label">Product Model No#:</label>
                                                {{-- <input type="text" class="form-control" id="selected_product_name" value=""  readonly> --}}
                                                <input type="text" class="form-control"  id="selected_product_model" placeholder="Product Model No"  readonly>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Product Model No
                                                </small>
                                            </div>

                                            
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Quantity:</label>
                                                <input type="number" class="form-control" id="quantity" placeholder="Enter product quantity"  >
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please Enter Product quantity
                                                </small>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Cost:</label>
                                                <input type="text" class="form-control" id="selected_product_price"   placeholder="Product Cost"  >
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Prodcut Cost 
                                                </small>
                                            </div>


                                            
                                            <div class="form-group col-md-4">
                                                <label for="inputtext14" class="ul-form__label">Total:</label>
                                                <input type="text" class="form-control" id="total_value" placeholder="Total Cost"  readonly>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Total Cost
                                                </small>
                                            </div>


                                            

                                        </div>


                                    </div>
                                    <table class="table" id="recordTable" style="display: none;">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Bill Number</th>
                        <th>Product Name</th>
                        <th>Product SKU</th>
                        <th>Product Model</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Bill Number</th>
                        <th>Product Name</th>
                        <th>Product SKU</th>
                        <th>Product Model</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>

                                    <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn  btn-primary m-1">Save</button>
                                                    <button type="button" class="btn btn-outline-secondary m-1" id="addRecordBtn">Add Purchase</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

            <input type="hidden" name="records" id="recordsData" value="">


@endsection



@section('bottom-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
        $(document).ready(function () {
            $('#product_sku').change(function () {
                var selectedSku = $(this).val();
                $.ajax({
                    url: `/get-product-name/${selectedSku}`,
                    type: 'GET',
                    success: function (data) {
                        $('#selected_product_name').val(data.productName);
                        $('#selected_product_price').val(data.productPrice);
                        $('#selected_product_model').val(data.productModel);

                    },
                    error: function (error) {
                        console.error('Error fetching product name:', error);
                    }
                });
            });
       
        
        $('#quantity, #selected_product_price').on('input', function () {
        calculateTotalValue(); // Recalculate total value when quantity changes
        });

            function calculateTotalValue() {
            var quantity = parseInt($('#quantity').val()) || 0;
            var price = parseFloat($('#selected_product_price').val()) || 0;
            var totalValue = quantity * price;
            $('#total_value').val(totalValue.toFixed(2)); // Display total value with two decimal places
            }
        });

</script>

<script>

$(document).ready(function () {
    var records = [];

    $(document).ready(function () {
    var recordCount = 1; // Initialize record count for unique IDs

    // Attach the click event handler to a parent element that exists when the page loads
    $('#recordTable').on('click', '.delete-btn', function () {
        $(this).closest('tr').remove(); // Remove the corresponding row
    });

    $('#addRecordBtn').click(function(){
        var date = $('#date').val();
        var bill_number = $('#bill_number').val();
        var supplier = $('#supplier').val();
        var selected_product_name = $('#selected_product_name').val();
        var product_sku = $('#product_sku').val();
        var selected_product_model = $('#selected_product_model').val();
        var quantity = $('#quantity').val();
        var selected_product_price = $('#selected_product_price').val();
        var total_value = quantity * selected_product_price;

        var newRow = '<tr>' +
            '<td>' + date + '</td>' +
            '<td>' + bill_number + '</td>' +
            '<td>' + supplier + '</td>' +
            '<td>' + selected_product_name + '</td>' +
            '<td>' + product_sku + '</td>' +
            '<td>' + selected_product_model + '</td>' +
            '<td>' + quantity + '</td>' +
            '<td>' + selected_product_price + '</td>' +
            '<td>' + total_value + '</td>' +
            '<td>' +
                '<button class="btn btn-danger btn-sm delete-btn">Delete</button>' +
                '<input type="hidden" name="record[' + recordCount + '][date]" value="' + date + '">' +
                '<input type="hidden" name="record[' + recordCount + '][bill_number]" value="' + bill_number + '">' +
                '<input type="hidden" name="record[' + recordCount + '][supplier]" value="' + supplier + '">' +
                '<input type="hidden" name="record[' + recordCount + '][selected_product_name]" value="' + selected_product_name + '">' +
                '<input type="hidden" name="record[' + recordCount + '][product_sku]" value="' + product_sku + '">' +
                '<input type="hidden" name="record[' + recordCount + '][selected_product_model]" value="' + selected_product_model + '">' +
                '<input type="hidden" name="record[' + recordCount + '][quantity]" value="' + quantity + '">' +
                '<input type="hidden" name="record[' + recordCount + '][selected_product_price]" value="' + selected_product_price + '">' +
                '<input type="hidden" name="record[' + recordCount + '][total_value]" value="' + total_value + '">' +
            '</td>' +
        '</tr>';

        $('#recordTable tbody').append(newRow);
        $('#recordTable').show();
        
        // Increment record count for unique IDs
        recordCount++;
        
        $('#date').val('');
        $('#bill_number').val('');
        $('#supplier').val('');
        $('#selected_product_name').val('');
        $('#product_sku').val('');
        $('#selected_product_model').val('');
        $('#quantity').val('');
        $('#selected_product_price').val('');
        $('#total_value').val('');


        records.push(record);
        $('#recordsData').val(JSON.stringify(records));

    });


    // Attach a click event handler to the delete button
    $('.delete-btn').click(function() {
        $(this).closest('tr').remove(); // Remove the corresponding row
    });
    });
});
</script>

<script>
    $('#submitButton').click(function() {
        // AJAX request to submit records to the server
        $.ajax({
            url: '/purchase/store', // Replace with your server endpoint
            method: 'POST',
            data: { records: JSON.stringify(records) }, // Serialize the records array as JSON
            success: function(response) {
                // Handle success (e.g., show a success message)
                alert('Records submitted successfully');
                // Clear the records array after submission
                records = [];
                // Clear the table
                $('#recordTable tbody').empty();
                $('#recordTable').hide();
            },
            error: function(error) {
                // Handle error (e.g., show an error message)
                alert('Error submitting records');
            }
        });
    }); // <- Don't forget this closing parenthesis and semicolon
</script>



@endsection
