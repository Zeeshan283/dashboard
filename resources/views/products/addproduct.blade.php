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
            max-width: 100px;
            max-height: 100px;
            margin: 5px;
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
                            <li><a href="#step-4">Step 4<br /><small>Location</small></a></li>
                        </ul>

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
                                                
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Product Name:</label>
                                                <div class="col-lg-5">
                                                {!! Form::text('name', null, [
                                                'id' => 'name',
                                                'class' => 'form-control',
                                                // '' => '',
                                                'maxlength' => '150',
                                                // 'onselectstart' => 'return false',
                                                // 'onpaste' => 'return false;',
                                                // 'onCopy' => 'return false',
                                                // 'onCut' => 'return false',
                                                // 'onDrag' => 'return false',
                                                // 'onDrop' => 'return false',
                                                // 'autocomplete' => 'off',
                                                'placeholder' => 'Enter your Product Name'
                                            ]) !!}
                                            @if ($errors->has('name'))
                                                <span   style="color: red;"
                                                    class="invalid-feedback1 font-weight-bold">{{ $errors->first('name') }}</span   style="color: red;">
                                            @endif
                                        {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product name
                                                    </small> --}}
                                                </div>

                                                <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Model No:</label>
                                                <div class="col-lg-5 ">
                                                    <!-- <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number"> -->
                                                    {!! Form::text('model_no', null, [
                                                        'id' => 'model_no',
                                                        'class' => 'form-control',
                                                        // '' => '',
                                                        'maxlength' => '100',
                                                    
                                                        'placeholder' => 'Enter Model Numner'
                                                    ]) !!}
                                                    @if ($errors->has('model_no'))
                                                        <span   style="color: red;"
                                                            class="invalid-feedback1 font-weight-bold">{{ $errors->first('model_no') }}</span   style="color: red;">
                                                    @endif
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Model Number of the Product
                                                    </small> --}}
                                                </div>

                                        </div>

                                        <div class="separator-breadcrumb border-top"></div>
                                        <div class="form-group row">

                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Old Price:</label>
                                                <div class="col-lg-2">
                                                    {!! Form::number('new_price', null, [
                                                        'id' => 'new_price',
                                                        'class' => 'form-control',
                                                        'onkeypress' => 'return onlyDecimalNumberKey(event)',
                                                        // '' => '',
                                                        'onselectstart' => 'return false',
                                                        'onpaste' => 'return false;',
                                                        'onCopy' => 'return false',
                                                        'onCut' => 'return false',
                                                        'onDrag' => 'return false',
                                                        'onDrop' => 'return false',
                                                        'autocomplete' => 'off',
                                                        'placeholder'=>'Enter New Price',
                                                    ]) !!}
                                                    @if ($errors->has('new_price'))
                                                        <span   style="color: red;"
                                                            class="invalid-feedback1 font-weight-bold">{{ $errors->first('new_price') }}</span   style="color: red;">
                                                    @endif
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product New Price
                                                    </small> --}}
                                                </div>
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">N.Sale Price:</label>
                                                <div class="col-lg-2">
                                                    {!! Form::number('new_sale_price', null, [
                                                        'id' => 'new_sale_price',
                                                        'class' => 'form-control',
                                                        'onkeypress' => 'return onlyDecimalNumberKey(event)',
                                                        // '' => '',
                                                        'onselectstart' => 'return false',
                                                        'onpaste' => 'return false;',
                                                        'onCopy' => 'return false',
                                                        'onCut' => 'return false',
                                                        'onDrag' => 'return false',
                                                        'onDrop' => 'return false',
                                                        'autocomplete' => 'off',
                                                        'placeholder'=>'Enter N.Sale Price',
                                                    ]) !!}
                                                    @if ($errors->has('new_sale_price'))
                                                        <span   style="color: red;"
                                                            class="invalid-feedback1 font-weight-bold">{{ $errors->first('new_sale_price') }}</span   style="color: red;">
                                                    @endif
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product N.Sale Price
                                                    </small> --}}
                                                </div>
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">N.Warranty Days:</label>
                                                <div class="col-lg-2">
                                                    {!! Form::number('new_warranty_days', null, [
                                                        'id' => 'new_warranty_days',
                                                        'class' => 'form-control',
                                                        'onkeypress' => 'return onlyNumberKey(event)',
                                                        // '' => '',
                                                        'onselectstart' => 'return false',
                                                        'onpaste' => 'return false;',
                                                        'onCopy' => 'return false',
                                                        'onCut' => 'return false',
                                                        'onDrag' => 'return false',
                                                        'onDrop' => 'return false',
                                                        'autocomplete' => 'off',
                                                        'placeholder'=>'Enter N.Warranty Days',
                                                    ]) !!}
                                                    @if ($errors->has('new_warranty_days'))
                                                        <span   style="color: red;"
                                                            class="invalid-feedback1 font-weight-bold">{{ $errors->first('new_warranty_days') }}</span   style="color: red;">
                                                    @endif
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product N.Warranty Days
                                                    </small> --}}
                                                </div>
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">N.Return Days:</label>
                                                <div class="col-lg-2">
                                                {!! Form::number('new_return_days', null, [
                                                    'id' => 'new_return_days',
                                                    'class' => 'form-control',
                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                    // '' => '',
                                                    'onselectstart' => 'return false',
                                                    'onpaste' => 'return false;',
                                                    'onCopy' => 'return false',
                                                    'onCut' => 'return false',
                                                    'onDrag' => 'return false',
                                                    'onDrop' => 'return false',
                                                    'autocomplete' => 'off',
                                                    'placeholder'=>'Enter N.Return Days',
                                                ]) !!}
                                                @if ($errors->has('new_return_days'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('new_return_days') }}</span   style="color: red;">
                                                @endif
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product N.Return Days
                                                    </small> --}}
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Refurbished Price:</label>
                                                <div class="col-lg-2    ">
                                                {!! Form::number('refurnished_price', null, [
                                                    'id' => 'refurnished_price',
                                                    'class' => 'form-control',
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
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">R.Sale Price:</label>
                                                <div class="col-lg-2">
                                                {!! Form::number('refurnished_sale_price', null, [
                                                    'id' => 'refurnished_sale_price',
                                                    'class' => 'form-control',
                                                    'onkeypress' => 'return onlyDecimalNumberKey(event)',
                                                    '' => '',
                                                    'onselectstart' => 'return false',
                                                    'onpaste' => 'return false;',
                                                    'onCopy' => 'return false',
                                                    'onCut' => 'return false',
                                                    'onDrag' => 'return false',
                                                    'onDrop' => 'return false',
                                                    'autocomplete' => 'off',
                                                    'placeholder'=>'Enter R.Sale Price',
                                                ]) !!}
                                                @if ($errors->has('refurnished_sale_price'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('refurnished_sale_price') }}</span   style="color: red;">
                                                @endif
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product R.Sale Price
                                                    </small> --}}
                                                </div>
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">R.Warranty Days:</label>
                                                <div class="col-lg-2">
                                                {!! Form::number('refurnished_warranty_days', null, [
                                                    'id' => 'refurnished_warranty_days',
                                                    'class' => 'form-control',
                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                    '' => '',
                                                    'onselectstart' => 'return false',
                                                    'onpaste' => 'return false;',
                                                    'onCopy' => 'return false',
                                                    'onCut' => 'return false',
                                                    'onDrag' => 'return false',
                                                    'onDrop' => 'return false',
                                                    'autocomplete' => 'off',
                                                    'placeholder'=>'Enter R.Warranty Days',
                                                ]) !!}
                                                @if ($errors->has('refurnished_warranty_days'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('refurnished_warranty_days') }}</span   style="color: red;">
                                                @endif
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product R.Warranty Days </small> --}}
                                                </div>
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">R.Return Days:</label>
                                                <div class="col-lg-2">
                                                {!! Form::number('refurnished_return_days', null, [
                                                    'id' => 'refurnished_return_days',
                                                    'class' => 'form-control',
                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                    '' => '',
                                                    'onselectstart' => 'return false',
                                                    'onpaste' => 'return false;',
                                                    'onCopy' => 'return false',
                                                    'onCut' => 'return false',
                                                    'onDrag' => 'return false',
                                                    'onDrop' => 'return false',
                                                    'autocomplete' => 'off',
                                                    'placeholder'=>'Enter R.Return Days',
                                                ]) !!}
                                                @if ($errors->has('refurnished_return_days'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('refurnished_return_days') }}</span   style="color: red;">
                                                @endif
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product R.Return Days
                                                    </small> --}}
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Min Order:</label>
                                                <div class="col-lg-2">
                                                {!! Form::number('min_order', null, [
                                                    'id' => 'min_order',
                                                    'class' => 'form-control',
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
                                                @if ($errors->has('min_order'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('min_order') }}</span   style="color: red;">
                                                @endif
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Minimum order quantity
                                                    </small> --}}
                                                </div>
                                                
    
                                                <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Make:</label>
                                                <div class="form-group col-lg-2">
                                                    <div class="form-group">

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
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">SKU:</label>
                                                <div class="col-lg-2">
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
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product Refurbished Price
                                                    </small> --}}
                                                </div>
                                                <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Condition:</label>
                                                <div class="col-lg-2">
                                                    {{-- <div class="form-control"> --}}
                                                    <select id="choices-multiple-remove-button" name="condition[]"
                                                        class=" @error('condition')  is-invalid @enderror"
                                                        placeholder="Select Condition" multiple  >
                                                        @foreach ($conditions as $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    {{-- </div> --}}
                                                </div>
                                                <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Color</label>
                                                    <div class="form-group col-lg-2">
                                                        
                                                    <select id="choices-multiple-remove-button" name="colors[]"
                                                        class="form-control"
                                                        placeholder="Select color"  multiple>
                                                        
                                                        
                                                        @foreach ($colors as $value)
                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                        @endforeach

                                                        {{-- @foreach ($colors as $key => $value)
                                                            @php $n=0; @endphp
                                                            @foreach ($edit->colors as $value1)
                                                                @if ($value->id == $value1->color_id)
                                                                    @php
                                                                        $n++;
                                                                        break;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                            @if ($n == 0)
                                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                            @else
                                                                <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                                                            @endif
                                                        @endforeach --}}
                                                        
                                                    </select>

                                                    {{-- {!! Form::select('colors[]', $colors, null, [
                                                        'id' => 'choices-multiple-remove-button',
                                                        'class' => 'form-control',

                                                        // '' => '',
                                                            ]) !!}
                                                    @if ($errors->has('colors'))
                                                        <span   style="color: red;"
                                                            class="invalid-feedback1 font-weight-bold">{{ $errors->first('colors') }}</span   style="color: red;">
                                                    @endif --}}
                                                    </div>

                                            </div>

                                    </div>
                                    <!-- end card 3 Columns Horizontal Form Layout-->
                        <div class="card o-hidden">
                            <div class="card-header">Dimensions</div>
                                <div class="card-block p-0">
                                    <div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Width:</label>
                                                <div class="col-lg-2 ">
                                                {!! Form::number('width', null, [
                                                    'id' => 'width',
                                                    'class' => 'form-control',
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
                            <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter product width
                                                    </small>
                                                </div>
                                                <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">heidgt:</label>
                                                <div class="col-lg-2">
                                                {!! Form::number('height', null, [
                                                    'id' => 'height',
                                                    'class' => 'form-control',
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
                                                    <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter product height
                                                    </small>
                                                </div>
                                                <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Depth:</label>
                                                <div class="col-lg-2 ">
                                                {!! Form::number('depth', null, [
                                                    'id' => 'depth',
                                                    'class' => 'form-control',
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
                                                    <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter product Depth
                                                    </small>
                                                </div>
                                                <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Weight:</label>
                                                <div class="col-lg-2 ">
                                                {!! Form::number('weight', null, [
                                                    'id' => 'weight',
                                                    'class' => 'form-control',
                                                    'onkeypress' => 'return onlyNumberKey(event)',
                                                    'onselectstart' => 'return false',
                                                    'onpaste' => 'return false;',
                                                    'onCopy' => 'return false',
                                                    'onCut' => 'return false',
                                                    'onDrag' => 'return false',
                                                    'onDrop' => 'return false',
                                                    'autocomplete' => 'off',
                                                ]) !!}
                                                @if ($errors->has('weight'))
                                                    <span   style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('weight') }}</span   style="color: red;">
                                                @endif
                                                    <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter product Weight
                                                    </small>
                                                </div>
    
    
                                        </div>
                                    </div>
                                    <!-- end card 3 Columns Horizontal Form Layout-->
                                
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
                                                            <h2>Short Description</h2>
                                                            {{-- <p>Enter Product Description 1</p> --}}
                                                            
                                                        {{-- <textarea class="mx-auto col-md-12 	col-12" value={{ $edit->description }}  maxlength="10" name="description" id="summernote"  rows="7"></textarea> --}}
                                                                
                                                                
                                                                                                                                    
                                                                    {!! Form::textarea('description', null, [
                                                                        'id' => 'description1',
                                                                        'class' => 'mx-auto col-md-12 	col-12',
                                                                        'maxlength' => '1000',
                                                                        'rows' => '5',
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
                                                            <h2>Details</h2>
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
                                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Menu:</label>
                                    <div class="form-group col-lg-5">
                                        
                                            <!-- <input type="text" id="menu-input-3" class="form-control" aria-label="Text input with dropdown button"> -->
                                            <!-- <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Menu</button>
                                             <div class="dropdown-menu">
                                                <p class="dropdown-item" onclick="selectMenu('Super Admin', 'menu-input-3')">Super Admin</p>
                                                <p class="dropdown-item" onclick="selectMenu('Industry Mall', 'menu-input-3')">Industry Mall</p>
                                                
                                            </div> -->
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
                                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Category:</label>
                                    <div class="form-group col-lg-5">
                                        <!-- <div class="input-group">
                                            <input type="text" id="menu-input-4" class="form-control" aria-label="Text input with dropdown button">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Category</button>
                                            <div class="dropdown-menu">
                                                <p class="dropdown-item" onclick="selectMenu('Category 1', 'menu-input-4')">Category 1</p>
                                                <p class="dropdown-item" onclick="selectMenu('Category 2', 'menu-input-4')">Category 2</p>
                                                <p class="dropdown-item" onclick="selectMenu('Category 3', 'menu-input-4')">Category 3</p>
                                                <p class="dropdown-item" onclick="selectMenu('Category 4', 'menu-input-4')">Category 4</p>
                                            </div>
                                        </div> -->
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

                                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Sub Category:</label>
                                    <div class="form-group col-lg-5">
                                        <!-- <div class="input-group">
                                            <input type="text" id="menu-input-5" class="form-control" aria-label="Text input with dropdown button">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Sub Category</button>
                                            <div class="dropdown-menu">
                                                <p class="dropdown-item" onclick="selectMenu('Sub Category  1', 'menu-input-5')">Sub Category 1</p>
                                                <p class="dropdown-item" onclick="selectMenu('Sub Category  2', 'menu-input-5')">Sub Category 2</p>
                                                <p class="dropdown-item" onclick="selectMenu('Sub Category  3', 'menu-input-5')">Sub Category 3</p>
                                                <p class="dropdown-item" onclick="selectMenu('Sub Category  4', 'menu-input-5')">Sub Category 4</p>
                                            </div>
                                        </div> -->

                                        {!! Form::select('subcategory_id', $sub_categories, null, [
                                            'id' => 'subcategory_id',
                                            'class' => 'form-control',
                                            // '' => '',
                                        ]) !!}
                                        @if ($errors->has('subcategory_id'))
                                            <span   style="color: red;"
                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('subcategory_id') }}</span   style="color: red;">
                                        @endif
                                    </div>

                                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Brand:</label>
                                    <div class="form-group col-lg-5">
                                        <!-- <div class="input-group">
                                            <input type="text" id="menu-input-6" class="form-control" aria-label="Text input with dropdown button">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Brand</button>
                                            <div class="dropdown-menu">
                                                <p class="dropdown-item" onclick="selectMenu('Brand  1', 'menu-input-6')">Brand 1</p>
                                                <p class="dropdown-item" onclick="selectMenu('Brand  2', 'menu-input-6')">Brand 2</p>
                                                <p class="dropdown-item" onclick="selectMenu('Brand  3', 'menu-input-6')">Brand 3</p>
                                                <p class="dropdown-item" onclick="selectMenu('Brand  4', 'menu-input-6')">Brand 4</p>
                                            </div>
                                        </div> -->

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
                                    <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Select Feature Image:</label>
                                        <div class="col-lg-5">
                                            <div class="card-header d-flex justify-content-between" >
                                                <input type="file" name="feature_image" class="form-control" style="height: fit-content;">
                                                {{-- @if($edit->url)
                                                <img src="{{ $edit->url }}" class="" style="width:100px;height:80px;">
                                                @else
                                                <h6>No Feature Image</h6>
                                                @endif --}}
                                            
                                            </div>
                                            
                                        </div>
                                        

                                    <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Select Image:</label>
                                        <div class="col-lg-5">
                                        {{-- <div class="form-group"> --}}
                                        <!-- <label>(1 File Size <= 100kb) (Total File Size 2MB) <span   style="color: red;" style="color: red;">*</span   style="color: red;"></label> -->
                                
                                                <div class="card-header d-flex justify-content-between" >
                                                
                                                    <input type="file" name="images[]" id="image" class="form-control"
                                                        onchange="image_select()"  multiple style="height: fit-content;">
                                                    
                                                </div>
                                                <div  class="card-body d-flex justify-content-start"   id="all_images">
                                                </div> 
                                                <div class="card-footer d-none" id="images_paths"></div>
                                                
                                                {{-- <br /> --}}
                                                {{-- <span   style="color: red;" id="uploaded_image"></span   style="color: red;"> --}}
                                                {{-- </div> --}}
                                                {{-- <img src="{{ $edit->product_image->url }}" width="50" height="50"> --}}
                                                {{-- @foreach ($edit->product_images as $value)
                                                <img src="{{ URL::asset('upload/products/' . $value->image) }}"
                                                class="img-thumbnail" style="width:100px;height:80px;" />
                                                @endforeach --}}
                                            </div>
                                </div>
                            </div>
                            
                            <div id="step-4" class="">
                                {{-- <h3 class="border-bottom border-gray pb-2">Step 4 Content</h3> --}}
                                <div class="card o-hidden">
                                    <div class="card-header">Tax Charges</div>
                                        <div class="card-block p-0">
                                        {{-- checking  --}}
                                            
                                                <div>
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">GST%:</label>
                                                            <div class="col-lg-2 ">
                                                                
                                                            {!! Form::number('GST_tax', null, [
                                                                    'id' => 'GST_tax',
                                                                    'class' => 'form-control',
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
                                                                {!! Form::number('VAT_tax', null, [
                                                                    'id' => 'VAT_tax',
                                                                    'class' => 'form-control',
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
                                                                {!! Form::number('FED_tax', null, [
                                                                    'id' => 'FED_tax',
                                                                    'class' => 'form-control',
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
                                                                {!! Form::number('Other_tax', null, [
                                                                    'id' => 'Other_tax',
                                                                    'class' => 'form-control',
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
                                                <!-- end card 3 Columns Horizontal Form Layout-->
                                            
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
                            </div>
                        </div>
                    </div>
                </div>
                
                {!! Form::close() !!}  

            </div>

            



@stop
@section('page-js')



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
    {{-- {!! Toastr::message() !!} --}}


    {{-- <script> 
        document.addEventListener('DOMContentLoaded', function () {
            const editorContainers = document.querySelectorAll('.editor-container');

            editorContainers.forEach((container, index) => {
                const editor = new Quill(container, {
                    theme: 'snow',
                    // Add any other Quill configuration options you need.
                });
            });
        });
    </script> --}}

<script>
    function selectMenu(menuText, inputId) {
        document.getElementById(inputId).value = menuText;
    }
</script>

<!-- Multi Select Dropdown -->
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script>
        $(document).ready(function() {
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                // maxItemCount:5,
                // searchResultLimit:5,
                // renderChoiceLimit:5

            });
        });
    </script>


<script src="{{ asset('website-assets/js/multiple_images_uploading.js') }}"></script>

<!-- include TinyMceEditor js -->
<script src="https://cdn.tiny.cloud/1/j93evmvpkl9x9azhqkcx9436oknslp5bxmxurqkz2d1nm24j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
{{-- <script src="https://cdn.tiny.cloud/1/j93evmvpkl9x9azhqkcx9436oknslp5bxmxurqkz2d1nm24j/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
    
    <script>
        tinymce.init({
        selector: "textarea#description",
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
            input.setAttribute("type", "file");
            input.setAttribute("accept", "image/*");
            input.onchange = function() {
            var file = this.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {
                    var id = "blobid" + new Date().getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(",")[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                };
            };
            input.click();
        }
    });
</script>
    <script>
        tinymce.init({
        selector: "textarea#details",
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
