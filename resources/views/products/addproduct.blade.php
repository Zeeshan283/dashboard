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
    <style>
        .thumbnail {
            max-width: auto;
            max-height: 100px;
            margin: 5px;
        }
    
        .choices__inner{
            background:#f3f4f6;
        }
        .choices__input{
            background:#f3f4f6;
        }

        .choices__list--multiple .choices__item {
            background-color: #6b7280;
            color: #ffffff;
            border:#6b7280;
        }
        .choices[data-type*=select-multiple] .choices__button{
            border-left: white;
        }
    </style>
@endsection

@endsection


@section('main-content')
<div class="breadcrumb">
                <h1>Add Products</h1>
                @if (count($errors) > 0)
                    <div class="alert alert-danger d-flex">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-md-12" style="padding: 20px;">
                    <!-- SmartWizard html -->
                    
                    <div id="smartwizard" class="sw-theme-dots" >
                        <ul style="justify-content: center;">
                            <li><a href="#step-1">Step 1<br /><small>Product Details</small></a></li>
                            <li><a href="#step-2">Step 2<br /><small>Product Description</small></a></li>
                            <li><a href="#step-3">Step 3<br /><small>Select Category</small></a></li>
                            {{-- <li><a href="#step-4">Step 4<br /><small>Location</small></a></li> --}}
                        </ul>
                            
                        <span>
                            <div class="btn-toolbar sw-toolbar sw-toolbar-top justify-content-end">
                            <div class="btn-group me-2 sw-btn-group" role="group">
                                <button class="btn btn-secondary sw-btn-prev disabled" type="button">Previous</button>
                                <button class="btn btn-secondary sw-btn-next" type="button">Next</button>
                            </div>
                            <div class="btn-group me-2 sw-btn-group-extra" role="group">
                            </div>
                            </div>
                        </span>

                        <div>
                            <div id="step-1" class="">

                                {!! Form::open([
                                    'url' => 'products',
                                    'method' => 'POST',

                                    'files' => 'true',
                                    'enctype' => 'multipart/form-data',
                                ]) !!}
                                
                                
                                    <div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Product Name:<span style="color: red;">*</span></label>
                                                
                                                <div class="col-lg-3">
                                                {!! Form::text('name', null, [
                                                    'required' => 'required',
                                                'id' => 'name',
                                                'class' => 'form-control input-field',
                                                'maxlength' => '150',
                                                'placeholder' => 'Enter your Product Name'
                                            ]) !!}
                                            
                                            @if ($errors->has('name'))
                                                <span   style="color: red;"
                                                    class="invalid-feedback1 font-weight-bold">{{ $errors->first('name') }}</span   style="color: red;">
                                            @endif
                                                </div>

                                                <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Model No:</label>
                                                <div class="col-lg-3 ">
                                                    <!-- <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number"> -->
                                                    {!! Form::text('model_no', null, [
                                                        'id' => 'model_no',
                                                        'class' => 'form-control input-field',
                                                        // '' => '',
                                                        'maxlength' => '100',

                                                        'placeholder' => 'Enter Model Numner'
                                                    ]) !!}
                                                    @if ($errors->has('model_no'))
                                                        <span   style="color: red;"
                                                            class="invalid-feedback1 font-weight-bold">{{ $errors->first('model_no') }}</span   style="color: red;">
                                                    @endif
                                                </div>

                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">SKU:<span style="color: red;">*</span></label>
                                                <div class="col-lg-3">
                                                {!! Form::text('sku', null, [
                                                    'id' => 'sku',
                                                    'class' => 'form-control',
                                                    // '' => '',
                                                    'placeholder'=>'Enter Product SKU',
                                                ]) !!}
                                                @if ($errors->has('sku'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('sku') }}</span   style="color: red;">
                                                @endif
                                                </div>

                                                <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Color</label>
                                                    <div class=" col-lg-3 mt-auto">
                                                        
                                                    <select  id="choices-multiple-remove-button" name="colors[]"
                                                        class="form-control"
                                                        placeholder="Select Color (Maximum Lenght 5)"  multiple>
                                                        @foreach ($colors as $value)
                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                    </div>
                                                    <br>
                                                <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Make:</label>
                                                    <div class=" col-lg-3 ">
                                                        
                                                            @if (Auth::User()->role=='Admin')
                                                                {!! Form::select('vendors',$vendors,null,['id'=>'vendors','class'=>'form-control fstdropdown-select','onchange'=>'ChangeMakeCondition(this.value)']) !!}
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
                                                        

                                                    </div>

                                        </div>

                                        <div class="separator-breadcrumb border-top"></div>
                                            <div class="form-group row">
                                                {{-- <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Condition:</label>
                                                <div class="col-lg-2">
                                                    <select id="choices-multiple-remove-button" name="condition[]"
                                                        class=" @error('condition')  is-invalid @enderror"
                                                        placeholder="Select Condition" multiple  >
                                                        @foreach ($conditions as $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                </div> --}}
                                            </div>
                                    </div>
                                
                                    <div class="card o-hidden">
                                        <div class="card-header">New Price</div>
                                            <div class="card-block p-0" >
                                                <div>
                                                    <div class="card-body">
                                                        <div class="form-group row">
            
                                                            {{-- New Price Colume Start --}}
                                                            
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Old Price:</label>
                                                <div class="col-lg-2">
                                                    {!! Form::text('new_price', null, [
                                                        'id' => 'new_price',
                                                        'class' => 'form-control',
                                                        'maxlength' => '12',
                                                        'onkeypress' => 'return onlyDecimalNumberKey(event)',
                                                        // '' => '',
                                                        'onselectstart' => 'return false',
                                                        'onpaste' => 'return false;',
                                                        'onCopy' => 'return false',
                                                        'onCut' => 'return false',
                                                        'onDrag' => 'return false',
                                                        'onDrop' => 'return false',
                                                        'autocomplete' => 'off',
                                                        'placeholder'=>'Enter Old Price',
                                                         
                                                    ]) !!}
                                                    @if ($errors->has('new_price'))
                                                        <span   style="color: red;"
                                                            class="invalid-feedback1 font-weight-bold">{{ $errors->first('new_price') }}</span   style="color: red;">
                                                    @endif
                                                </div>
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Sale Price:</label>
                                                <div class="col-lg-2">
                                                    {!! Form::text('new_sale_price', null, [
                                                        'id' => 'new_sale_price',
                                                        'class' => 'form-control',
                                                        'maxlength' => '12',
                                                        'onkeypress' => 'return onlyDecimalNumberKey(event)',
                                                        // '' => '',
                                                        'onselectstart' => 'return false',
                                                        'onpaste' => 'return false;',
                                                        'onCopy' => 'return false',
                                                        'onCut' => 'return false',
                                                        'onDrag' => 'return false',
                                                        'onDrop' => 'return false',
                                                        'autocomplete' => 'off',
                                                        'placeholder'=>'Enter Sale Price',
                                                    ]) !!}
                                                    @if ($errors->has('new_sale_price'))
                                                        <span   style="color: red;"
                                                            class="invalid-feedback1 font-weight-bold">{{ $errors->first('new_sale_price') }}</span   style="color: red;">
                                                    @endif
                                                </div>


                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Warranty Days:</label>
                                                <div class="col-lg-2">
                                                    {!! Form::text('new_warranty_days', null, [
                                                        'id' => 'new_warranty_days',
                                                        'class' => 'form-control',
                                                        'maxlength' => '4',
                                                        'onkeypress' => 'return onlyNumberKey(event)',
                                                        // '' => '',
                                                        'onselectstart' => 'return false',
                                                        'onpaste' => 'return false;',
                                                        'onCopy' => 'return false',
                                                        'onCut' => 'return false',
                                                        'onDrag' => 'return false',
                                                        'onDrop' => 'return false',
                                                        'autocomplete' => 'off',
                                                        'placeholder'=>'Enter Warranty Days',
                                                    ]) !!}
                                                    @if ($errors->has('new_warranty_days'))
                                                        <span   style="color: red;"
                                                            class="invalid-feedback1 font-weight-bold">{{ $errors->first('new_warranty_days') }}</span   style="color: red;">
                                                    @endif
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product N.Warranty Days
                                                    </small> --}}
                                                </div>
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Return Days:</label>
                                                <div class="col-lg-2">
                                                {!! Form::text('new_return_days', null, [
                                                    'id' => 'new_return_days',
                                                    'class' => 'form-control',
                                                    'maxlength' => '4',
                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                    // '' => '',
                                                    'onselectstart' => 'return false',
                                                    'onpaste' => 'return false;',
                                                    'onCopy' => 'return false',
                                                    'onCut' => 'return false',
                                                    'onDrag' => 'return false',
                                                    'onDrop' => 'return false',
                                                    'autocomplete' => 'off',
                                                    'placeholder'=>'Enter Return Days',
                                                ]) !!}
                                                @if ($errors->has('new_return_days'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('new_return_days') }}</span   style="color: red;">
                                                @endif
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product N.Return Days
                                                    </small> --}}
                                                </div>

                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">MOQ:</label>
                                                <div class="col-lg-2" style="margin-top: auto;">
                                                {!! Form::text('min_order', null, [
                                                    'id' => 'min_order',
                                                    'class' => 'form-control',
                                                    'maxlength' => '5',
                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                    // '' => '',
                                                    'onselectstart' => 'return false',
                                                    'onpaste' => 'return false;',
                                                    'onCopy' => 'return false',
                                                    'onCut' => 'return false',
                                                    'onDrag' => 'return false',
                                                    'onDrop' => 'return false',
                                                    'autocomplete' => 'off',
                                                    'placeholder'=>'Enter Minimum Order Quantity',
                                                ]) !!}
                                                </div>                        
{{-- New Price Column End --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                                    <div class="card o-hidden">
                                        <div class="card-header">Refurbished Price</div>
                                            <div class="card-block p-0" >
                                                <div>
                                                    <div class="card-body">
                                                        <div class="form-group row">            
{{-- Refurbished Colume Start --}}
                                                            
                                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Refurbished Price:</label>
                                                            <div class="col-lg-2    ">
                                                            {!! Form::text('refurnished_price', null, [
                                                                'id' => 'refurnished_price',
                                                                'class' => 'form-control',
                                                                'maxlength' => '12',
                                                                'onkeypress' => 'return onlyDecimalNumberKey(event)',
                                                                '' => '',
                                                                'onselectstart' => 'return false',
                                                                'onpaste' => 'return false;',
                                                                'onCopy' => 'return false',
                                                                'onCut' => 'return false',
                                                                'onDrag' => 'return false',
                                                                'onDrop' => 'return false',
                                                                'autocomplete' => 'off',
                                                                'placeholder'=>'Enter Refurbished Price',
                                                            ]) !!}
                                                                @if ($errors->has('refurnished_price'))
                                                                    <span   style="color: red;"
                                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('refurnished_price') }}</span   style="color: red;">
                                                                @endif
                                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please enter Product Refurbished Price
                                                                </small> --}}
                                                            </div>
                                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Sale Price:</label>
                                                            <div class="col-lg-2">
                                                            {!! Form::text('refurnished_sale_price', null, [
                                                                'id' => 'refurnished_sale_price',
                                                                'class' => 'form-control',
                                                                'maxlength' => '12',
                                                                'onkeypress' => 'return onlyDecimalNumberKey(event)',
                                                                '' => '',
                                                                'onselectstart' => 'return false',
                                                                'onpaste' => 'return false;',
                                                                'onCopy' => 'return false',
                                                                'onCut' => 'return false',
                                                                'onDrag' => 'return false',
                                                                'onDrop' => 'return false',
                                                                'autocomplete' => 'off',
                                                                'placeholder'=>'Enter Sale Price',
                                                            ]) !!}
                                                            @if ($errors->has('refurnished_sale_price'))
                                                                <span   style="color: red;"
                                                                    class="invalid-feedback1 font-weight-bold">{{ $errors->first('refurnished_sale_price') }}</span   style="color: red;">
                                                            @endif
                                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please enter Product R.Sale Price
                                                                </small> --}}
                                                            </div>
                                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Warranty Days:</label>
                                                            <div class="col-lg-2">
                                                            {!! Form::text('refurnished_warranty_days', null, [
                                                                'id' => 'refurnished_warranty_days',
                                                                'class' => 'form-control',
                                                                'maxlength' => '4',
                                                                'onkeypress' => 'return onlyNumberKey(event)',
                                                                '' => '',
                                                                'onselectstart' => 'return false',
                                                                'onpaste' => 'return false;',
                                                                'onCopy' => 'return false',
                                                                'onCut' => 'return false',
                                                                'onDrag' => 'return false',
                                                                'onDrop' => 'return false',
                                                                'autocomplete' => 'off',
                                                                'placeholder'=>'Enter Warranty Days',
                                                            ]) !!}
                                                            @if ($errors->has('refurnished_warranty_days'))
                                                                <span   style="color: red;"
                                                                    class="invalid-feedback1 font-weight-bold">{{ $errors->first('refurnished_warranty_days') }}</span   style="color: red;">
                                                            @endif
                                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please enter Product R.Warranty Days </small> --}}
                                                            </div>
                                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Return Days:</label>
                                                            <div class="col-lg-2">
                                                            {!! Form::text('refurnished_return_days', null, [
                                                                'id' => 'refurnished_return_days',
                                                                'class' => 'form-control',
                                                                'maxlength' => '4',
                                                                'onkeypress' => 'return onlyNumberKey(event)',
                                                                '' => '',
                                                                'onselectstart' => 'return false',
                                                                'onpaste' => 'return false;',
                                                                'onCopy' => 'return false',
                                                                'onCut' => 'return false',
                                                                'onDrag' => 'return false',
                                                                'onDrop' => 'return false',
                                                                'autocomplete' => 'off',
                                                                'placeholder'=>'Enter Return Days',
                                                            ]) !!}
                                                            @if ($errors->has('refurnished_return_days'))
                                                                <span   style="color: red;"
                                                                    class="invalid-feedback1 font-weight-bold">{{ $errors->first('refurnished_return_days') }}</span   style="color: red;">
                                                            @endif
                                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please enter Product R.Return Days
                                                                </small> --}}
                                                            </div>

                                                            <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">MOQ:</label>
                                                            <div class="col-lg-2" style="margin-top: auto;">
                                                            {!! Form::text('min_ref_order', null, [
                                                                'id' => 'min_ref_order',
                                                                'class' => 'form-control',
                                                                'maxlength' => '5',
                                                                'onkeypress' => 'return onlyNumberKey(event)',
                                                                // '' => '',
                                                                'onselectstart' => 'return false',
                                                                'onpaste' => 'return false;',
                                                                'onCopy' => 'return false',
                                                                'onCut' => 'return false',
                                                                'onDrag' => 'return false',
                                                                'onDrop' => 'return false',
                                                                'autocomplete' => 'off',
                                                                'placeholder'=>'Enter Minimum Order Quantity',
                                                            ]) !!}
                                                            </div>
                        
                                                            {{-- Refurbished Column End --}}
            
                                                            
            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
            
                                    </div>
<br>
<br>
                        <div class="card o-hidden">
                            <div class="card-header">Dimensions</div>
                                <div class="card-block p-0" >
                                    <div>
                                        <div class="card-body">
                                            <div class="form-group row">

                                                {{-- Measurement Colume Start --}}
                                                

                                                
                                                <label for="staticEmail19" style="display: none;"   id="W_L" class=" ul-form__label ul-form--margin col-lg-1  col-form-label ">Width:</label>
                                                <div class="col-lg-2 " style="display: none;"   id="W_Fields">
                                                {!! Form::text('width', null, [
                                                    'id' => 'width',
                                                    'class' => 'form-control',
                                                    'maxlength' => '5',
                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                    'onselectstart' => 'return false',
                                                    'onpaste' => 'return false;',
                                                    'onCopy' => 'return false',
                                                    'onCut' => 'return false',
                                                    'onDrag' => 'return false',
                                                    'onDrop' => 'return false',
                                                    'autocomplete' => 'off',
                                                    
                                                ]) !!}
                                                @if ($errors->has('width'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('width') }}</span   style="color: red;">
                                                @endif
                                                </div>

                                                <label for="staticEmail19" style="display: none;"   id="H_L" class=" ul-form__label ul-form--margin col-lg-1  col-form-label ">Height:</label>
                                                <div class="col-lg-2 " style="display: none;"  id="H_Fields">
                                                {!! Form::text('height', null, [
                                                    'id' => 'height',
                                                    'class' => 'form-control',
                                                    'maxlength' => '5',
                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                    'onselectstart' => 'return false',
                                                    'onpaste' => 'return false;',
                                                    'onCopy' => 'return false',
                                                    'onCut' => 'return false',
                                                    'onDrag' => 'return false',
                                                    'onDrop' => 'return false',
                                                    'autocomplete' => 'off',
                                                    
                                                ]) !!}
                                                @if ($errors->has('height'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('height') }}</span   style="color: red;">
                                                @endif
                                                </div>

                                                <label for="staticEmail19" style="display: none;"   id="D_L" class=" ul-form__label ul-form--margin col-lg-1  col-form-label ">Depth:</label>
                                                <div class="col-lg-2 " style="display: none;"   id="D_Fields">
                                                {!! Form::text('depth', null, [
                                                    'id' => 'depth',
                                                    'class' => 'form-control',
                                                    'maxlength' => '5',
                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                    'onselectstart' => 'return false',
                                                    'onpaste' => 'return false;',
                                                    'onCopy' => 'return false',
                                                    'onCut' => 'return false',
                                                    'onDrag' => 'return false',
                                                    'onDrop' => 'return false',
                                                    'autocomplete' => 'off',
                                                    
                                                ]) !!}
                                                @if ($errors->has('depth'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('depth') }}</span   style="color: red;">
                                                @endif
                                                </div>
                                            </sp>
                                                <label for="Weight" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Select Unit:</label>
                                                <div class="col-lg-2">
                                                <select class="form-control" name="m_unit" id="m_unit" >
                                                    <option value="" selected >Select Measurement Unit:</option>
                                                    <option value="Millimeter">Millimeter(mm)</option>
                                                    <option value="Centimeter">Centimeter(cm)</option>
                                                    <option value="Inch">Inch(in)</option>
                                                    <option value="Meter">Meter(m)</option>
                                                </select>
                                                </div>
                                            </div>
            
                                                {{-- Measurement Column End --}}

                                            <div class="form-group row">

                                                {{-- Weight Column Start --}}
                                                
                                                <label for="staticEmail19" style="display: none;" id="Weight_L"  class=" ul-form__label ul-form--margin col-lg-1  col-form-label ">weight:</label>
                                                <div class="col-lg-2 "  style="display:none; margin-top: auto;" id="Weight_Field">
                                                {!! Form::text('weight', null, [
                                                    'id' => 'weight',
                                                    'class' => 'form-control',
                                                    'maxlength' => '5',
                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                    'onselectstart' => 'return false',
                                                    'onpaste' => 'return false;',
                                                    'onCopy' => 'return false',
                                                    'onCut' => 'return false',
                                                    'onDrag' => 'return false',
                                                    'onDrop' => 'return false',
                                                    'autocomplete' => 'off',
                                                    'placeholder' => ''
                                                ]) !!}
                                                @if ($errors->has('weight'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('weight') }}</span   style="color: red;">
                                                @endif
                                                {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Ounze
                                                    </small> --}}
                                                </div>
                                            
                                                <label for="Weight" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Select Unit::</label>
                                                <div class="col-lg-2 mt-auto">
                                                <select class="form-control " name="weight_unit" id="weight_unit" >
                                                    <option value="" selected >Select Weight Unit:</option>
                                                    <option value="Ounce">Ounce(oz)</option>
                                                    <option value="Milligram">Milligram(mg)</option>
                                                    <option value="Gram">Gram(g)</option>
                                                    <option value="Kilogram">Kilogram(kg)</option>
                                                    <option value="MetricTon">Metric Ton(t)</option>
                                                </select>
                                                </div>
                                                
                                                {{-- Weight Column End --}}

                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>

                        </div>
                    </div>


                        </div>
                            <div id="step-2" class="">
                                {{-- <h3 class="border-bottom border-gray pb-2">Step 2 Content</h3> --}}
                                <div>
                                    
                                                <div class="col-md-11 mb-4" style="padding-left: 60px">
                                                    <div>
                                                        <div class="card-body">
                                                            <label for="staticEmail20" class=col-form-label ">Short Description:<span style="color: red;">*</span></label>

                                                            {{-- <p>Enter Product Description 1</p> --}}

                                                        {{-- <textarea class="mx-auto col-md-12 	col-12" value={{ $edit->description }}  maxlength="10" name="description" id="summernote"  rows="7"></textarea> --}}



                                                                    {!! Form::textarea('description', null, [
                                                                        'id' => 'description1',
                                                                        'class' => 'mx-auto col-md-12 	col-12',
                                                                        'maxlength' => '1000',
                                                                        // 'minlength' => '50',
                                                                        'rows' => '5',
                                                                        // 'required' => 'required',
                                                                    ]) !!} 
                                                                    
                                                                    ]) !!}

                                                                    @if ($errors->has('description'))
                                                                        <span   style="color: red;"
                                                                            class="invalid-feedback1 font-weight-bold text-danger">{{ $errors->first('description') }}</span   style="color: red;">
                                                                    @endif


                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-11 mb-4" style="padding-left: 60px">
                                                    <div>
                                                        <div class="card-body">
                                                            
                                                            <label for="staticEmail20" class="  col-form-label ">Details:</label>

                                                            {{-- <p>Enter Product Description 2</p> --}}
                                                            <div class="mx-auto col-md-12">
                                                                {{-- <div id="snow-editor-2" class="editor-container"> --}}
                                                                    <!-- Content will be generated by Quill -->

                                                                    {!! Form::textarea('details', null, [
                                                                        'id' => 'details',
                                                                        'class' => 'form-control',

                                                                    ]) !!}
                                                                    @if ($errors->has('details'))
                                                                        <span   style="color: red;"
                                                                            class="invalid-feedback1 font-weight-bold">{{ $errors->first('details') }}</span   style="color: red;">
                                                                    @endif
                                                                {{-- </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                </div>
                            </div>

                            <div id="step-3" class="">
                                {{-- <div class="custom-separator"></div> --}}

                                <div class="form-group row" style="padding-left: 50px;padding-right:50px">
                                {{-- <div class="form-group row"> --}}
                                    
                                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Menu:<span style="color: red;">*</span></label>
                                    <div class="form-group col-lg-5">
                                            {!! Form::select('menu_id', $menus, null, [
                                                'id' => 'menu_id',
                                                'class' => 'form-control',
                                                // '' => '',
                                            ]) !!}
                                            @if ($errors->has('menu_id'))
                                                <span   style="color: red;"
                                                    class="invalid-feedback1 font-weight-bold">{{ $errors->first('menu_id') }}</span   style="color: red;">
                                            @endif
                                        <br>

                                    </div>
                                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Category:<span style="color: red;">*</span></label>
                                    <div class="form-group col-lg-5">
                                        {!! Form::select('category_id', $categories, null, [
                                            'id' => 'category_id',
                                            'class' => 'form-control',
                                            // '' => '',
                                        ]) !!}
                                        @if ($errors->has('category_id'))
                                            <span   style="color: red;"
                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('category_id') }}</span   style="color: red;">
                                        @endif
                                    </div>

                                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Sub Category:<span style="color: red;">*</span></label>
                                    <div class="form-group col-lg-5">

                                        {!! Form::select('subcategory_id', $sub_categories, null, [
                                            'id' => 'subcategory_id',
                                            'class' => 'form-control',
                                            // '' => '',
                                        ]) !!}
                                        @if ($errors->has('subcategory_id'))
                                            <span   style="color: red;"
                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('subcategory_id') }}</span>
                                        @endif
                                    </div>

                                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Brand:<span style="color: red;">*</span></label>
                                    <div class="form-group col-lg-5">

                                        {!! Form::select('brand_id', $brands, null, [
                                            'id' => 'brand_id',
                                            'class' => 'form-control',
                                            // '' => '',
                                        ]) !!}
                                        @if ($errors->has('brand_id'))
                                            <span   style="color: red;"
                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('brand_id') }}</span   style="color: red;">
                                        @endif
                                        <br>
                                    </div>



                                    <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Select Attachment:</label>
                                    <div class="col-lg-5">

                                    <input type="file" name="attachment" id="attachment"
                                        class="form-control @error('attachment') is-invalid @enderror">

                                        @error('attachment')
                                        <span   style="color: red;" class="invalid-feedback font-weight-bold">{{ $message }}</span   style="color: red;">
                                    @enderror
                                    </div>

                                    {{-- feature-image-upload --}}
                                    <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Select Feature Image:<span style="color: red;">*</span></label>
                                        <div class="col-lg-5">
                                            <div class="card-header d-flex justify-content-between" >
                                                <input type="file" name="feature_image" class="form-control" style="height: fit-content;">
                                                {{-- @if($edit->url)
                                                <img src="{{ $edit->url }}" class="" style="width:100px;height:80px;">
                                                @else
                                                <h6>No Feature Image</h6>
                                                @endif --}}
                                                
                                            </div>
                                            @if ($errors->has('feature_image'))
                                                <span   style="color: red;"
                                                    class="invalid-feedback1 font-weight-bold">{{ $errors->first('feature_image') }}</span>
                                                @endif

                                            
                                        </div>

                                        
                                        

                                    <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Select Images:</label>
                                        <div class="col-lg-5">
                                        {{-- <div class="form-group"> --}}
                                        <!-- <label>(1 File Size <= 100kb) (Total File Size 2MB) <span   style="color: red;" style="color: red;">*</span   style="color: red;"></label> -->

                                                <div class="card-header d-flex justify-content-between" >
                                                
                                                    {{-- <input type="file" name="images[]" id="image" class="form-control"
                                                        onchange="image_select()"  multiple style="height: fit-content;">
                                                 --}}
                                                        <input type="file" name="images[]" id="imageInput"  class="form-control" multiple >
                                                        <button type="button" class="d-none form-control" style="width: auto;"id="chooseImages">Choose Images</button>
                                                    </div>
                                                    
                                                    <br>
                                                    <p id="fileLimitMessage" style="color: red;"></p>

                                            <div id="thumbnails"></div>

                                            </div>
                                            {{-- <div class="container">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div  class="thumbnail d-flex justify-content-start"    id="all_images"></div>
                                                        <div class="card-footer d-none" id="images_paths"></div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                            
                                                
                                                
                                        
                                            
                                            <script>
                                                document.getElementById('chooseImages').addEventListener('click', function () {
                                                    document.getElementById('imageInput').click();
                                                });
                                            
                                                document.getElementById('imageInput').addEventListener('change', function () {
                                                    var files = this.files;
                                                    var maxImages = 6; // Set your maximum image limit here
                                                    var fileLimitMessage = document.getElementById('fileLimitMessage');
                                                    if (files.length > maxImages) {
                                                        fileLimitMessage.textContent = 'Please select a maximum of ' + maxImages + ' images.';
                                                        this.value = ''; // Clear selected files
                                                    } else {
                                                        fileLimitMessage.textContent = ''; // Clear the message if within the limit
                                                    }
                                                });
                                                document.getElementById('imageInput').addEventListener('change', function () {
                                                    
                                                    var thumbnails = document.getElementById('thumbnails');
                                                    thumbnails.innerHTML = ''; // Clear previous thumbnails
                                            
                                                    var files = this.files;
                                                var maxImages = 6; // Set your maximum image limit here
                                                for (var i = 0; i < Math.min(files.length, maxImages); i++) {
                                                    var img = document.createElement('img');
                                                    img.src = URL.createObjectURL(files[i]);
                                                    img.style.maxWidth = '100px';
                                                    thumbnails.appendChild(img);
                                                }
                                            
                                                    // Show the upload button when at least one image is selected
                                                    
                                                });
                                            </script>

                                            

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="card">
                                                <div class="card-footer" style="text-align: right;">
                                                    <button type="submit" name="submit" class="btn btn-outline-secondary  ladda-button example-button m-1">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                                    
                            </div>
                            
                            {{-- <div id="step-4" class="">
                                <h3 class="border-bottom border-gray pb-2">Step 4 Content</h3>
                                <div class="card o-hidden">
                                    <div class="card-header">Tax Charges</div>
                                        <div class="card-block p-0">
                                        checking 
                                            
                                                <div>
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">GST%:</label>
                                                            <div class="col-lg-2 ">
                                                                
                                                            {!! Form::text('GST_tax', null, [
                                                                    'id' => 'GST_tax',
                                                                    'class' => 'form-control',
                                                                    'maxlength' =>'12',
                                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                                    'onselectstart' => 'return false',
                                                                    'onpaste' => 'return false;',
                                                                    'onCopy' => 'return false',
                                                                    'onCut' => 'return false',
                                                                    'onDrag' => 'return false',
                                                                    'onDrop' => 'return false',
                                                                    'autocomplete' => 'off',

                                                                ]) !!}
                                                                @if ($errors->has('GST_tax'))
                                                                    <span   style="color: red;"
                                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('GST_tax') }}</span   style="color: red;">
                                                                @endif
                                                                    <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                        Please Enter GST% (Goods and Services Tax) for product
                                                                    </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">VAT%:</label>
                                                            <div class="col-lg-2">
                                                                {!! Form::text('VAT_tax', null, [
                                                                    'id' => 'VAT_tax',
                                                                    'class' => 'form-control',
                                                                    'maxlength' =>'12',
                                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                                    'onselectstart' => 'return false',
                                                                    'onpaste' => 'return false;',
                                                                    'onCopy' => 'return false',
                                                                    'onCut' => 'return false',
                                                                    'onDrag' => 'return false',
                                                                    'onDrop' => 'return false',
                                                                    'autocomplete' => 'off',
                                                                ]) !!}
                                                                @if ($errors->has('VAT_tax'))
                                                                    <span   style="color: red;"
                                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('VAT_tax') }}</span   style="color: red;">
                                                                @endif
                                                                    <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                        Please Enter VAT % (Value-added Tax) for product
                                                                    </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">FED%:</label>
                                                            <div class="col-lg-2 ">
                                                                {!! Form::text('FED_tax', null, [
                                                                    'id' => 'FED_tax',
                                                                    'class' => 'form-control',
                                                                    'maxlength' =>'12',
                                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                                    'onselectstart' => 'return false',
                                                                    'onpaste' => 'return false;',
                                                                    'onCopy' => 'return false',
                                                                    'onCut' => 'return false',
                                                                    'onDrag' => 'return false',
                                                                    'onDrop' => 'return false',
                                                                    'autocomplete' => 'off',
                                                                ]) !!}
                                                                @if ($errors->has('FED_tax'))
                                                                    <span   style="color: red;"
                                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('FED_tax') }}</span   style="color: red;">
                                                                @endif
                                                                    <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                        Please Enter FED% (Federal Excise Duty) for product
                                                                    </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Other%:</label>
                                                            <div class="col-lg-2 ">
                                                                {!! Form::text('Other_tax', null, [
                                                                    'id' => 'Other_tax',
                                                                    'class' => 'form-control',
                                                                    'maxlength' =>'12',
                                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                                    'onselectstart' => 'return false',
                                                                    'onpaste' => 'return false;',
                                                                    'onCopy' => 'return false',
                                                                    'onCut' => 'return false',
                                                                    'onDrag' => 'return false',
                                                                    'onDrop' => 'return false',
                                                                    'autocomplete' => 'off',
                                                                ]) !!}
                                                                @if ($errors->has('Other_tax'))
                                                                    <span   style="color: red;"
                                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('Other_tax') }}</span   style="color: red;">
                                                                @endif
                                                                    <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                        Please Enter Other% Charges for product
                                                                    </small>
                                                            </div>


                                                    </div>
                                                </div>
                                                
                                        </div>


                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="card">
                                                        <div class="card-footer">
                                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                    
                                    
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="card">
                                                        <div class="card-footer">
                                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end card 3 Columns Horizontal Form Layout-->
                                                
                                        </div>
                                </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>



@stop
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
                removeItemButton: true,
                maxItemCount:5,

                // searchResultLimit:5,
                // renderChoiceLimit:5

                
            });
            $('#choices-multiple-remove-button').on('change', changeBackgroundColor);

                document.addEventListener('click', function() {
                changeBackgroundColor();
                });
        


            // Function to change background color based on selected option
        //  function changeBackgroundColor() {
        //     var selectedOptions = $('#choices-multiple-remove-button').val();
        //     $('.choices__list--multiple .choices__item').each(function(index, element) {
        //         var backgroundColor = '';
        //         if (selectedOptions.includes($(element).attr('data-value'))) {
        //             if ($(element).attr('data-value') === '1') {
        //                 backgroundColor = '#FF0000';
        //             } else if ($(element).attr('data-value') === '2') {
        //                 backgroundColor = '#0000FF';
        //             }
        //             else if ($(element).attr('data-value') === '3') {
        //                 backgroundColor = '#FFFDD0';
        //             } 
        //             else if ($(element).attr('data-value') === '4') {
        //                 backgroundColor = '#FFFF00';
        //             } 
        //             else if ($(element).attr('data-value') === '5') {
        //                 backgroundColor = '	#006400';
        //             } 
        //             else if ($(element).attr('data-value') === '6') {
        //                 backgroundColor = '#FFFFFF';
        //             }
        //             else if ($(element).attr('data-value') === '7') {
        //                 backgroundColor = '#FF6600';
        //             }
        //             else if ($(element).attr('data-value') === '8') {
        //                 backgroundColor = '#964B00';
        //             }
        //             else if ($(element).attr('data-value') === '9') {
        //                 backgroundColor = '#000000';
        //             }
        //             else if ($(element).attr('data-value') === '10') {
        //                 backgroundColor = '#007FFF';
        //             }
        //             else if ($(element).attr('data-value') === '11') {
        //                 backgroundColor = '#FFFFF0';
        //             }
        //             else if ($(element).attr('data-value') === '12') {
        //                 backgroundColor = '#A020F0';
        //             }
        //             else if ($(element).attr('data-value') === '13') {
        //                 backgroundColor = '#C3B091';
        //             }
        //             else if ($(element).attr('data-value') === '14') {
        //                 backgroundColor = '	#FFC0CB';
        //             }
        //             else if ($(element).attr('data-value') === '15') {
        //                 backgroundColor = '#FFD700';
        //             }
        //             else if ($(element).attr('data-value') === '16') {
        //                 backgroundColor = '	#808000';
        //             }
        //             else if ($(element).attr('data-value') === '17') {
        //                 backgroundColor = '#00FFFF';
        //             }
        //             else if ($(element).attr('data-value') === '18') {
        //                 backgroundColor = '#673147';
        //             }
        //             else if ($(element).attr('data-value') === '19') {
        //                 backgroundColor = '#808080';
        //             }
        //             else if ($(element).attr('data-value') === '20') {
        //                 backgroundColor = '#C0C0C0';
        //             }
        //             else if ($(element).attr('data-value') === '21') {
        //                 backgroundColor = '	#000080';
        //             }
        //             else if ($(element).attr('data-value') === '22') {
        //                 backgroundColor = '	#FAF9F6';
        //             }
        //         } 
        //         $(element).css('background-color', backgroundColor);
        //     });
        // }

        // // Call the function when the select element value changes
        // $('#choices-multiple-remove-button').on('change', changeBackgroundColor);
        // $(document).on('click', function() {
        //     changeBackgroundColor(); // Call the function to reset colors
        // });
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



<script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>

    @if ($errors->any())
    <script>
        toastr.error("{{ $errors->first() }}");
    </script>
    @endif

    {!! Toastr::message() !!}

<script>
    function selectMenu(menuText, inputId) {
        document.getElementById(inputId).value = menuText;
    }
</script>




<script src="{{ asset('website-assets/js/multiple_images_uploading.js') }}"></script>

<!-- include TinyMceEditor js -->
<script src="https://cdn.tiny.cloud/1/j93evmvpkl9x9azhqkcx9436oknslp5bxmxurqkz2d1nm24j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
{{-- <script src="https://cdn.tiny.cloud/1/j93evmvpkl9x9azhqkcx9436oknslp5bxmxurqkz2d1nm24j/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
    
    
    <script>
        tinymce.init({
        selector: "textarea#details",
        height: 650, 
        relative_urls: false,
        paste_data_images: true,
        image_title: true,
        automatic_uploads: true,
        // images_upload_url: '/post/image/upload',
        // images_upload_url: '{{asset('upload')}}',
        images_upload_url: '{{URL::to("/uploads3")}}',
        file_picker_types: "image",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        // override default upload handler to simulate successful upload
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement("input");
            input.setAttribute("type", "file1");
            input.setAttribute("accept", "image/*");
            input.onchange = function() {
            var file = this.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {
                    var id = "blobid" + new Date().getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(",")[1];
                    var blobInfo = blobCache.create(id, file1, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file1.name });
                };
            };
            input.click();
        }
    });
</script>



@endsection


@section('bottom-js')


<script src="{{asset('assets/js/smart.wizard.script.js')}}"></script>
<script src="{{asset('assets/js/quill.script.js')}}"></script>

                    <script>
                        // Add JavaScript to hide the error message after 3 seconds
                        setTimeout(function () {
                            var errorAlert = document.getElementById('error-alert');
                            if (errorAlert) {
                                errorAlert.style.display = 'none';
                            }
                        }, 6000); // 3000 milliseconds (3 seconds)
                    </script>

@endsection
