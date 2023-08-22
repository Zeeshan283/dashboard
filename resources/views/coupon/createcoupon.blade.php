@extends('layouts.master')
@section('before-css')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection


@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Create Refund</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Create Refund according to customer queries</h3>
                                </div>
                                <form action="{{ route('refund.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">

                                        <div class="row">

                                            <div class="form-group col-md-4">
                                                <label for="vendor" class="ul-form__label">Coupon:</label>
                                                <select class="form-control" id="vendor" name="vendor" required>
                                                    <option value="" selected disabled>Select Coupon Type</option>
                                                    <option value="1">Discount on Purchase</option>
                                                    <option value="2">Free Delivery</option>
                                                </select>
                                                <small class="ul-form__text form-text">
                                                    Select Coupon Type
                                                </small>
                                            </div>
                                            
                                            <!-- Common Field -->
                                            <div class="form-group col-md-4">
                                                <label for="commonField" class="ul-form__label">Coupon Title:</label>
                                                <input type="text" class="form-control" id="commonField" name="commonField" placeholder="Coupon Title">
                                                <small class="ul-form__text form-text">
                                                    Coupon Title here 
                                                </small>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="commonField" class="ul-form__label">Coupon Code:</label>
                                                <input type="text" class="form-control" id="commonField" name="commonField" placeholder="Coupon Code">
                                                <small class="ul-form__text form-text">
                                                    Coupon Code Here
                                                </small>
                                            </div>
                                            
                                            <!-- Vendor 1 Fields -->
                                            <div id="vendor1Fields" style="display: none;">
                                                <div class="form-group col-md-4">
                                                    <label for="field1" class="ul-form__label">Field 1 (Vendor 1):</label>
                                                    <input type="text" class="form-control" id="field1" name="field1" placeholder="Field 1 for Vendor 1">
                                                    <small class="ul-form__text form-text">
                                                        Field 1 description for Vendor 1
                                                    </small>
                                                </div>
                                            
                                                <!-- Add more fields specific to Vendor 1 as needed -->
                                            </div>
                                            
                                            <!-- Vendor 2 Fields -->
                                            <div id="vendor2Fields" style="display: none;">
                                                <div class="form-group col-md-4">
                                                    <label for="field2" class="ul-form__label">Field 2 (Vendor 2):</label>
                                                    <input type="text" class="form-control" id="field2" name="field2" placeholder="Field 2 for Vendor 2">
                                                    <small class="ul-form__text form-text">
                                                        Field 2 description for Vendor 2
                                                    </small>
                                                </div>
                                            
                                                <!-- Add more fields specific to Vendor 2 as needed -->
                                            </div>
                                            
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn  btn-primary m-1">Create Request</button>
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

            $("#vendor1Fields, #vendor2Fields").hide();

            if (selectedValue === "1") {
                $("#vendor1Fields").show();
            } else if (selectedValue === "2") {
                $("#vendor2Fields").show();
            }
        });
    });
</script>



@endsection
