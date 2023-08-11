@extends('layouts.master')
@section('before-css')
{{-- css link sheet  --}}
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_dots.min.css')}}">

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">
@endsection

@endsection

@section('main-content')
  <div class="breadcrumb">
                <h1>Products</h1>
            </div>
            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-md-12" style="padding: 20px;">
                    <!-- SmartWizard html -->
                    <div id="smartwizard" class="sw-theme-dots">
                        <ul>
                            <li><a href="#step-1">Step 1<br /><small>Product Details</small></a></li>
                            <li><a href="#step-2">Step 2<br /><small>Product Description</small></a></li>
                            <li><a href="#step-3">Step 3<br /><small>Select Category</small></a></li>
                            <li><a href="#step-4">Step 4<br /><small>Location</small></a></li>
                        </ul>

                           <div>
                            <div id="step-1" class="">
                                <form action="">
                                    <div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Model No:</label>
                                                <div class="col-lg-3 ">
                                                    <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                    <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Model Number of the Product
                                                    </small>
                                                </div>
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Product Name:</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="staticEmail20" placeholder="Enter Your Product Name">
                                                    <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product name
                                                    </small>
                                                </div>
    
                                                <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Condition:</label>
                                                <div class="form-group col-lg-3">
                                                    <div class="input-group">
                                                        <input type="text" id="menu-input-2" class="form-control" aria-label="Text input with dropdown button">
                                                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Condition</button>
                                                        <div class="dropdown-menu">
                                                            <p class="dropdown-item" onclick="selectMenu('Option 1', 'menu-input-2')">Option 1</p>
                                                            <p class="dropdown-item" onclick="selectMenu('Option 2', 'menu-input-2')">Option 2</p>
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">New Price:</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="staticEmail20" placeholder="Enter New Price"> <br>
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product New Price
                                                    </small> --}}
                                                </div>
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">N.Sale Price:</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="staticEmail20" placeholder="Enter N.Sale Price">
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product N.Sale Price
                                                    </small> --}}
                                                </div>
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">N.Warranty Days:</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="staticEmail20" placeholder="Enter N.Warranty Days">
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product N.Warranty Days
                                                    </small> --}}
                                                </div>
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">N.Return Days:</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="staticEmail20" placeholder="Enter N.Return Days"> <br>
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product N.Return Days
                                                    </small> --}}
                                                </div>
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Refurbished Price:</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="staticEmail20" placeholder="Enter Refurbished Price">
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product Refurbished Price
                                                    </small> --}}
                                                </div>
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">R.Sale Price:</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="staticEmail20" placeholder="Enter R.Sale Price">
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product R.Sale Price
                                                    </small> --}}
                                                </div>
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">R.Warranty Days:</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="staticEmail20" placeholder="Enter R.Warranty Days">
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product R.Warranty Days </small> --}}
                                                </div>
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">R.Return Days:</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="staticEmail20" placeholder="Enter Refurbished Price">
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product R.Return Days
                                                    </small> --}}
                                                </div>
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Min Order:</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="staticEmail20" placeholder="Enter Minimum Order Quantity"> <br>
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Minimum order quantity
                                                    </small> --}}
                                                </div>
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">SKU:</label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="staticEmail20" placeholder="Enter Product SKU">
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product Refurbished Price
                                                    </small> --}}
                                                </div>
    
                                                <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Make:</label>
                                                <div class="form-group col-lg-3">
                                                    <div class="input-group">
                                                        <input type="text" id="menu-input-1" class="form-control" aria-label="Text input with dropdown button">
                                                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Role</button>
                                                        <div class="dropdown-menu">
                                                            <p class="dropdown-item" onclick="selectMenu('Super Admin', 'menu-input-1')">Super Admin</p>
                                                            <p class="dropdown-item" onclick="selectMenu('Industry Mall', 'menu-input-1')">Industry Mall</p>

                                                            @if (Auth::User()->role=='Admin')
                                                                {!! Form::select('vendors',$vendors,null,['id'=>'vendors','class'=>'form-control fstdropdown-select','onchange'=>'ChangeMakeCondition(this.value)']) !!}
                                                                {!! Form::hidden('make', Auth::User()->name, ['id' => 'make', 'class' => 'form-control']) !!}
                                                                {!! Form::hidden('created_by',Auth::User()->id,['id'=>'created_by','class'=>'form-control']) !!}
                                                            @else
                                                                {!! Form::text('make1',Auth::User()->name,['id'=>'make1','class'=>'form-control','disabled'=>'disabled']) !!}
                                                                {!! Form::hidden('make', Auth::User()->name, ['id' => 'make', 'class' => 'form-control']) !!}
                                                                {!! Form::hidden('created_by',Auth::User()->id,['id'=>'created_by','class'=>'form-control']) !!}
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Select Image:</label>
                                                <div class="col-lg-3">
                                                    <input type="file" class="form-control" id="staticEmail20" placeholder="Enter Product SKU">
                                                    {{-- <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                        Please enter Product Refurbished Price
                                                    </small> --}}
                                                </div>
    
                                        </div>
                                    </div>
                                    <!-- end card 3 Columns Horizontal Form Layout-->
                                </form>
                            </div>
                        </div>
                            <div id="step-2" class="">
                                {{-- <h3 class="border-bottom border-gray pb-2">Step 2 Content</h3> --}}
                                <div>
                                                
                                                <div class="col-md-11 mb-4" style="padding-left: 60px">
                                                    <div>
                                                        <div class="card-body">
                                                            <h2>Description</h2>
                                                            {{-- <p>Enter Product Description 1</p> --}}
                                                            <div class="mx-auto col-md-12">
                                                                <div id="snow-editor-1" class="editor-container">
                                                                    <!-- Content will be generated by Quill -->
                                                                    <h1>Enter Your Product Short Description here</h1>
                                                                    <p><br></p>
                                                                    <p><br></p>
                                                                    <p><br></p>
                                                                    <p><br></p>
                                                                    <p><br></p>
                                                                    <p><br></p>
                                                                    <p><br></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-11 mb-4" style="padding-left: 60px">
                                                    <div>
                                                        <div class="card-body">
                                                            <h2>Details</h2>
                                                            {{-- <p>Enter Product Description 2</p> --}}
                                                            <div class="mx-auto col-md-12">
                                                                <div id="snow-editor-2" class="editor-container">
                                                                    <!-- Content will be generated by Quill -->
                                                                    <h1>Enter Your Product Full Description here</h1>
                                                                    <p><br></p>
                                                                    <p><br></p>
                                                                    <p><br></p>
                                                                    <p><br></p>
                                                                    <p><br></p>
                                                                    <p><br></p>
                                                                    <p><br></p>
                                                                </div>
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
                                        <div class="input-group">
                                            <input type="text" id="menu-input-3" class="form-control" aria-label="Text input with dropdown button">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Menu</button>
                                            <div class="dropdown-menu">
                                                <p class="dropdown-item" onclick="selectMenu('Super Admin', 'menu-input-3')">Super Admin</p>
                                                <p class="dropdown-item" onclick="selectMenu('Industry Mall', 'menu-input-3')">Industry Mall</p>
                                            </div>
                                        </div><br>
                                    </div>
                                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Category:</label>
                                    <div class="form-group col-lg-5">
                                        <div class="input-group">
                                            <input type="text" id="menu-input-4" class="form-control" aria-label="Text input with dropdown button">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Category</button>
                                            <div class="dropdown-menu">
                                                <p class="dropdown-item" onclick="selectMenu('Category 1', 'menu-input-4')">Category 1</p>
                                                <p class="dropdown-item" onclick="selectMenu('Category 2', 'menu-input-4')">Category 2</p>
                                                <p class="dropdown-item" onclick="selectMenu('Category 3', 'menu-input-4')">Category 3</p>
                                                <p class="dropdown-item" onclick="selectMenu('Category 4', 'menu-input-4')">Category 4</p>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Sub Category:</label>
                                    <div class="form-group col-lg-5">
                                        <div class="input-group">
                                            <input type="text" id="menu-input-5" class="form-control" aria-label="Text input with dropdown button">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Sub Category</button>
                                            <div class="dropdown-menu">
                                                <p class="dropdown-item" onclick="selectMenu('Sub Category  1', 'menu-input-5')">Sub Category 1</p>
                                                <p class="dropdown-item" onclick="selectMenu('Sub Category  2', 'menu-input-5')">Sub Category 2</p>
                                                <p class="dropdown-item" onclick="selectMenu('Sub Category  3', 'menu-input-5')">Sub Category 3</p>
                                                <p class="dropdown-item" onclick="selectMenu('Sub Category  4', 'menu-input-5')">Sub Category 4</p>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Brand:</label>
                                    <div class="form-group col-lg-5">
                                        <div class="input-group">
                                            <input type="text" id="menu-input-6" class="form-control" aria-label="Text input with dropdown button">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Brand</button>
                                            <div class="dropdown-menu">
                                                <p class="dropdown-item" onclick="selectMenu('Brand  1', 'menu-input-6')">Brand 1</p>
                                                <p class="dropdown-item" onclick="selectMenu('Brand  2', 'menu-input-6')">Brand 2</p>
                                                <p class="dropdown-item" onclick="selectMenu('Brand  3', 'menu-input-6')">Brand 3</p>
                                                <p class="dropdown-item" onclick="selectMenu('Brand  4', 'menu-input-6')">Brand 4</p>
                                            </div>
                                        </div><br>
                                    </div>
                                    <label for="inputEmail4" class="ul-form__label ul-form--margin col-lg-1 col-form-label">Type:</label>
                                    <div class="form-group col-lg-5">
                                        <div class="input-group">
                                            <input type="text" id="menu-input-7" class="form-control" aria-label="Text input with dropdown button">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select Type</button>
                                            <div class="dropdown-menu">
                                                <p class="dropdown-item" onclick="selectMenu('Parent', 'menu-input-7')">Parent</p>
                                                <p class="dropdown-item" onclick="selectMenu('Child', 'menu-input-7')">Child</p>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="staticEmail20" class="ul-form__label ul-form--margin col-lg-1 col-form-label ">Select Image:</label>
                                                <div class="col-lg-5">
                                                    <input type="file" class="form-control" id="staticEmail20" placeholder="Enter Product SKU">
                                                </div>
                                    
                                </div>
                            </div>
                            <div id="step-4" class="">
                                {{-- <h3 class="border-bottom border-gray pb-2">Step 4 Content</h3> --}}
                                <div class="card o-hidden">
                                    <div class="card-header">Dimensions</div>
                                        <div class="card-block p-0">
                                        {{-- checking  --}}
                                            <form action="">
                                                <div>
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Width:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please enter product width
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">heidgt:</label>
                                                            <div class="col-lg-5">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please enter product height
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Depth:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please enter product Depth
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Weight:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please enter product Weight
                                                                </small>
                                                            </div>
                
                
                                                    </div>
                                                </div>
                                                <!-- end card 3 Columns Horizontal Form Layout-->
                                            </form>
                                        </div>
                                    <div class="card-header">Pakistan</div>
                                        <div class="card-block p-0">
                                        {{-- checking  --}}
                                            <form action="">
                                                <div>
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Shipping.Days:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter Shipping days for product
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Shipping.Charges:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter Shipping Chargers for product
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Import.Charges:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter product Import Charges
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Tax.Charges:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter product Charges
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Other.Charges:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter product Other Charges
                                                                </small>
                                                            </div>
                                                    </div>
                                                </div>
                                                <!-- end card 3 Columns Horizontal Form Layout-->
                                            </form>
                                        </div>
                                    <div class="card-header">Singapore</div>
                                        <div class="card-block p-0">
                                        {{-- checking  --}}
                                            <form action="">
                                                <div>
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Shipping.Days:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter Shipping days for product
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Shipping.Charges:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter Shipping Chargers for product
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Import.Charges:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter product Import Charges
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Tax.Charges:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter product Charges
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Other.Charges:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter product Other Charges
                                                                </small>
                                                            </div>
                                                    </div>
                                                </div>
                                                <!-- end card 3 Columns Horizontal Form Layout-->
                                            </form>
                                        </div>
                                    <div class="card-header">USA</div>
                                        <div class="card-block p-0">
                                        {{-- checking  --}}
                                            <form action="">
                                                <div>
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Shipping.Days:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter Shipping days for product
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Shipping.Charges:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter Shipping Chargers for product
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Import.Charges:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter product Import Charges
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Tax.Charges:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter product Charges
                                                                </small>
                                                            </div>
                                                            <label for="staticEmail19" class="ul-form__label ul-form--margin col-lg-1   col-form-label ">Other.Charges:</label>
                                                            <div class="col-lg-5 ">
                                                                <input type="text" class="form-control" id="staticEmail19" placeholder="Enter Model Number">
                                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                                    Please Enter product Other Charges
                                                                </small>
                                                            </div>
                                                    </div>
                                                </div>
                                                <!-- end card 3 Columns Horizontal Form Layout-->
                                            </form>
                                        </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@endsection

@section('page-js')


<script src="{{asset('assets/js/vendor/jquery.smartWizard.min.js')}}"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="{{asset('assets/js/vendor/quill.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editorContainers = document.querySelectorAll('.editor-container');

        editorContainers.forEach((container, index) => {
            const editor = new Quill(container, {
                theme: 'snow',
                // Add any other Quill configuration options you need.
            });
        });
    });
</script>

<script>
    function selectMenu(menuText, inputId) {
        document.getElementById(inputId).value = menuText;
    }
</script>

@endsection

@section('bottom-js')

<script src="{{asset('assets/js/smart.wizard.script.js')}}"></script>
<script src="{{asset('assets/js/quill.script.js')}}"></script>

@endsection
