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

                                <form method="post" action="{{ route('purchase.update', $purchases->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Date:</label>
                                                <input type="date" class="form-control" id="first_name" placeholder="Select Date" name="date" value="{{ $purchases->date}}" required>
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your  name
                                                </small> --}}
                                            </div>
    
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Bill Number:</label>
                                                <input type="number" class="form-control" id="first_name" placeholder="Enter your Bill Number"  name="bill_number" value="{{ $purchases->bill_number}}" required>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter your  Bill Number
                                                </small>
                                            </div>

                                           
                                            <div class="form-group col-md-4">
                                                <label for="product_sku" class="ul-form__label">Select SKU:</label>
                                                <select class="form-control" id="product_sku" name="product_sku" data-live-search="true">
                                                    <option value="{{ $purchases->product->sku}}" selected disabled>{{ $purchases->product->sku}}</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->sku}}">{{ $product->sku}}</option>
                                                    @endforeach
                                                </select>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please Select Product SKU
                                                </small>
                                            </div>
                                            

                                           

                                            <div class="form-group col-md-4">
                                                <label for="selected_product_name" class="ul-form__label">Product Name: </label>
                                                {{-- <input type="text" class="form-control" id="selected_product_name" value=""  readonly> --}}
                                                <input type="text" class="form-control" name="selected_product_name" id="selected_product_name" placeholder="Product Name"  value="{{ $purchases->product->name }}" readonly>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Product Name
                                                </small>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="selected_product_name" class="ul-form__label">Product Model No#:</label>
                                                {{-- <input type="text" class="form-control" id="selected_product_name" value=""  readonly> --}}
                                                <input type="text" class="form-control" name="selected_product_model" id="selected_product_model" placeholder="Product Model No" value="{{$purchases->selected_product_model}}" readonly>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Product Name
                                                </small>
                                            </div>

                                            
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Quantity:</label>
                                                <input type="number" class="form-control" id="quantity" placeholder="{{ $purchases->quantity}}" name="quantity"  required>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please Enter Product quantity
                                                </small>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Cost:</label>
                                                <input type="text" class="form-control" id="selected_product_price"  name="selected_product_price" placeholder="{{ $purchases->selected_product_price}}" value=""  required>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Prodcut Cost 
                                                </small>
                                            </div>


                                            
                                            <div class="form-group col-md-4">
                                                <label for="inputtext14" class="ul-form__label">Total:</label>
                                                <input type="text" class="form-control" id="total_value" placeholder="Total Cost" name="total_value" value="{{ $purchases->total_value}}" readonly>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Total Cost
                                                </small>
                                            </div>


                                            

                                        </div>


                                    </div>

                                    <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn  btn-primary m-1">Save</button>
                                                    <button type="button" class="btn btn-outline-secondary m-1">Cancel</button>
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



@endsection
