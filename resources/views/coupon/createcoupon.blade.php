@extends('layouts.master')
@section('before-css')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection


@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Create Coupon</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Create Coupon according to requirments</h3>
                                </div>
                                <form action="{{ route('coupon.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">

                                        <div class="row">
                                            

                                            

                                            <div class="form-group col-md-4">
                                                <label for="vendor" class="ul-form__label">Coupon Type:</label>
                                                <select class="form-control" id="vendor" name="coupon_type" >
                                                    <option value="" selected disabled>Select Coupon Type</option>
                                                    <option value="1">Discount on Purchase</option>
                                                    <option value="2">Free Delivery</option>
                                                    <option value="3">First Order</option>
                                                </select>
                                                <small class="ul-form__text form-text">
                                                    Select Coupon Type
                                                </small>
                                            </div>
                                            
                                            <!-- Common Field -->
                                            <div class="form-group col-md-4">
                                                <label for="commonField" class="ul-form__label">Coupon Title:</label>
                                                <input type="text" class="form-control" id="commonField" name="coupon_title" placeholder="Coupon Title">
                                                <small class="ul-form__text form-text">
                                                    Coupon Title here 
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="commonField" class="ul-form__label">Coupon Code:</label>
                                                <input type="text" class="form-control" id="commonField" name="coupon_code" placeholder="Coupon Code">
                                                <small class="ul-form__text form-text">
                                                    Coupon Code Here
                                                </small>
                                            </div>


                                           

                                            {{-- Free delivery discount  --}}

                                            
                                            {{-- common fileds  --}}
                                            <div class="form-group col-md-4">
                                                <label for="commonField" class="ul-form__label">Minimum Purchase ($):</label>
                                                <input type="number" class="form-control" id="commonField" name="minp" placeholder="Minimum Purchase">
                                                <small class="ul-form__text form-text">
                                                    Minumum Purchase 
                                                </small>
                                            </div>
                                           
                                            <div class="form-group col-md-4">
                                                <label for="commonField" class="ul-form__label">Start Date:</label>
                                                <input type="date" class="form-control" id="commonField" name="start_date" placeholder="Start Date">
                                                <small class="ul-form__text form-text">
                                                    Start Date
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="commonField" class="ul-form__label">End Date:</label>
                                                <input type="date" class="form-control" id="commonField" name="end_date" placeholder="End Date">
                                                <small class="ul-form__text form-text">
                                                    End Date
                                                </small>
                                            </div>

                                             {{-- Discount on purchase  --}}
                                             <div id="vendor1Fields" style="display: none;">
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="field1" class="ul-form__label">Limit For Same User:</label>
                                                        <input type="text" class="form-control" id="field1" name="limit_same_user" placeholder="Limit For Same User">
                                                        <small class="ul-form__text form-text">
                                                            Limit For Same User
                                                        </small>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="vendor" class="ul-form__label">Discount Type:</label>
                                                        <select class="form-control" id="discount" name="discount_type" >
                                                            <option value="" selected disabled>Select Discount Type</option>
                                                            <option value="1">Amount</option>
                                                            <option value="2">Percentage</option>
                                                        </select>
                                                        <small class="ul-form__text form-text">
                                                            Discount Type
                                                        </small>
                                                    </div>
                                                    <div id="amountField" class="form-group col-md-4" style="display: none;">
                                                        <label for="amount" class="ul-form__label">Amount:</label>
                                                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount">
                                                        <small class="ul-form__text form-text">
                                                            Amount
                                                        </small>
                                                    </div>
                                                    <div id="percentageField" class="form-group col-md-4" style="display: none;">
                                                        <label for="percentage" class="ul-form__label">Percentage:</label>
                                                        <input type="text" class="form-control" id="percentage" name="percentage" placeholder="Percentage">
                                                        <small class="ul-form__text form-text">
                                                            Percentage
                                                        </small>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="vendor" class="ul-form__label">Select product ww</label>
                                                        <select class="form-control" name="product_id"  >
                                                            <option value="" selected disabled>Select Product</option>
                                                            @foreach ($products as $product)
                                                                
                                                                <option value="{{ $product->id}}">{{ $product->sku}}</option>

                                                            @endforeach
                                                        </select>
                                                        <small class="ul-form__text form-text">
                                                           Select Product
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="vendor2Fields" style="display: none;">
                                                <div class="row">
                                                    <div class="form-group col-md-4 vendor2Fields">
                                                        <label for="field2" class="ul-form__label">Limit For Same User:</label>
                                                        <input type="number" class="form-control" id="field2" name="limit_same_user1" placeholder="Limit For Same User">
                                                        <small class="ul-form__text form-text">
                                                            Limit For Same User
                                                        </small>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="vendor" class="ul-form__label">Select product</label>
                                                        <select class="form-control" name="product_id" >
                                                            <option value="" selected disabled>Select Product</option>
                                                            @foreach ($products as $product)
                                                                
                                                                <option value="{{ $product->id}}">{{ $product->sku}}</option>

                                                            @endforeach
                                                        </select>
                                                        <small class="ul-form__text form-text">
                                                           Select Product
                                                        </small>
                                                    </div>

                                                </div>
                                                <!-- Add more fields specific to Vendor 3 as needed -->
                                            </div>

                                        

                                            <!-- Vendor 3 Fields -->

                                            <div id="vendor3Fields" style="display: none;">
                                                <div class="row">
                                                    
                                                    <div class="form-group col-md-4">
                                                        <label for="vendor" class="ul-form__label">Discount Type:</label>
                                                        <select class="form-control" id="discount3" name="discount_type" >
                                                            <option value="" selected disabled>Select Discount Type</option>
                                                            <option value="4">Amount</option>
                                                            <option value="5">Percentage</option>
                                                        </select>
                                                        <small class="ul-form__text form-text">
                                                            Discount Type
                                                        </small>
                                                    </div>
                                                    <div id="amountField3" class="form-group col-md-4" style="display: none;">
                                                        <label for="amount3" class="ul-form__label">Amount:</label>
                                                        <input type="text" class="form-control" id="amount" name="amount3" placeholder="Amount">
                                                        <small class="ul-form__text form-text">
                                                            Amount
                                                        </small>
                                                    </div>
                                                    <div id="percentageField3" class="form-group col-md-4" style="display: none;">
                                                        <label for="percentage3" class="ul-form__label">Percentage:</label>
                                                        <input type="text" class="form-control" id="percentage" name="percentage3" placeholder="Percentage">
                                                        <small class="ul-form__text form-text">
                                                            Percentage
                                                        </small>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="vendor" class="ul-form__label">Store:</label>
                                                        
                                                        @if (Auth::User()->role=='Admin')
                                                        {!! Form::select('vendors',$products,null,['id'=>'vendors','class'=>'form-control fstdropdown-select','onchange'=>'ChangeMakeCondition(this.value)']) !!}
                                                        {!! Form::hidden('make', Auth::User()->name, ['id' => 'make', 'class' => 'form-control']) !!}
                                                        {!! Form::hidden('created_by',Auth::User()->id,['id'=>'created_by','class'=>'form-control']) !!}
                                                        @else
                                                            {!! Form::text('make1',Auth::User()->name,['id'=>'make1','class'=>'form-control','disabled'=>'disabled']) !!}
                                                            {!! Form::hidden('make', Auth::User()->name, ['id' => 'make', 'class' => 'form-control']) !!}
                                                            {!! Form::hidden('created_by',Auth::User()->id,['id'=>'created_by','class'=>'form-control']) !!}
                                                        @endif
        
                                                        @if ($errors->has('make'))
                                                            <span  style="color: red;"
                                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('make') }}</span  style="color: red;">
                                                        @endif
                                                        <small class="ul-form__text form-text">
                                                            Select Coupon Type
                                                        </small>
                                                    </div>
                                                    
                                                  

                                                </div>
                                                <!-- Add more fields specific to Vendor 3 as needed -->
                                            </div>

                                        
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn  btn-primary m-1">Create Coupon</button>
                                                     
                                                    <a href="{{ route('admin')}}"><button type="button" class="btn btn-outline-secondary m-1">Cancel</button></a>
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

@section('page-js')

<script>
    function selectMenu(menuText, inputId) {
        document.getElementById(inputId).value = menuText;
    }
</script>



@endsection

@section('bottom-js')

<script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @if(session('success'))
        toastr.success('{{ session('success') }}', 'Success');
    @endif
        
</script>   

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#vendor").change(function() {
            var selectedValue = $(this).val();

            $("#vendor1Fields, #vendor2Fields, #vendor3Fields").hide();

            if (selectedValue === "1") {
                $("#vendor1Fields").show();
            } else if (selectedValue === "2") {
                $("#vendor2Fields").show();
            } else if (selectedValue === "3"){
                $("#vendor3Fields").show();
            }
        });
    });

    document.getElementById("discount").addEventListener("change", function () {
        var selectedValue = this.value;
        var amountField = document.getElementById("amountField");
        var percentageField = document.getElementById("percentageField");

        if (selectedValue === "1") {
            amountField.style.display = "block";
            percentageField.style.display = "none";
        } else if (selectedValue === "2") {
            amountField.style.display = "none";
            percentageField.style.display = "block";
        } else {
            amountField.style.display = "none";
            percentageField.style.display = "none";
        }
    });

    document.getElementById("discount3").addEventListener("change", function () {
        var selectedValue = this.value;
        var amountField3 = document.getElementById("amountField3");
        var percentageField3 = document.getElementById("percentageField3");

        if (selectedValue === "4") {
            amountField3.style.display = "block";
            percentageField3.style.display = "none";
        } else if (selectedValue === "5") {
            amountField3.style.display = "none";
            percentageField3.style.display = "block";
        } else {
            amountField3.style.display = "none";
            percentageField3.style.display = "none";
        }
    });
</script>



@endsection
