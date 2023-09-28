@extends('layouts.master')
@section('before-css')
{{-- css link sheet  --}}
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_dots.min.css')}}">
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@section('page-css')
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/choices.min.css') }}">

<style>
    .image-container_1 {
    max-height: 400px; /* Set the maximum height you want for the images */
    overflow-y: auto; /* Add a vertical scrollbar if needed */
}

.img-thumbnail_1 {
    display: block;
    margin-bottom: 10px; /* Add some spacing between images */
}

</style>
@endsection
@endsection 

@section('main-content')
<div class="breadcrumb">
 {{-- {{$edit->pay}} --}}
 
                <h1>Seller Verification Management's</h1>
                {{-- @if (count($errors) > 0)
                    <div class="alert alert-danger d-flex">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
            </div>

<div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-md-12" style="padding: 20px;">
                    <!-- SmartWizard html -->
                    {!! Form::model($edit, [
                    'method' => 'PATCH',
                    'action' => ['App\Http\Controllers\VendorsController@vendorProfileSave', $edit->id],
                    'class' => 'form-horizontal',
                    'files' => 'true',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                    <div id="smartwizard" class="sw-theme-dots" >
                        <ul style="justify-content: center;">
                            <li><a href="#step-1">Step 1<br /><small>Profile Info</small></a></li>
                            <li><a href="#step-2">Step 2<br /><small>Sliders</small></a></li>
                            <li><a href="#step-3">Step 3<br /><small>Portfolio</small></a></li>
                            <li><a href="#step-4">Step 4<br /><small>About</small></a></li>
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
                   
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header bg-transparent">
                                            <h3 class="card-title">Profile Info </h3>
                                        </div>
                                        <div class="form-group avatar">
                                            <div>
                                            <figure class="figure col-md-2 col-sm-3 col-xs-12" style="margin: revert;">
                                                <img class="img-rounded img-responsive"
                                                
                                                    @if ($edit && isset($edit->logo))
                                                        <img src="{{ asset($edit->logo) }}" style="width:100px;height:80px;" alt="logo">
                                                    @else
                                                        {{-- Handle the case where $edit is null or does not have a 'logo' property --}}
                                                        <p>N/A</p>
                                                    @endif
                                                
                                            </figure>
                                            <div class="form-inline col-md-10 col-sm-9 col-xs-12" style="margin-left: 40px;">
                                                <input type="file" id="logo" name="logo" class="file-uploader pull-left">
                                            </div>
                                            </div>
                                        </div>

                                            <div class="card-body">
                                                <div class="row">
                                                        {!! Form::hidden('user_id', $edit->user->id, ['id' => 'id', 'class' => 'form-control']) !!}
                                                        {!! Form::hidden('user_id', $edit->user->id, ['id' => 'id', 'class' => 'form-control']) !!}

                                                        
                                                    <div class="form-group col-md-4">
                                                        <label for="inputtext11" class="ul-form__label">Company Name:<span style="color: red;">*</span></label>
                                                        {!! Form::text('company_name', null, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                        @if ($errors->has('company_name'))
                                                            <span   style="color: red;"
                                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('company_name') }}</span   style="color: red;">
                                                        @endif
                                                    </div>
    
                                                    <div class="form-group col-md-4">
                                                        <label for="inputtext11" class="ul-form__label">First Name:<span style="color: red;">*</span></label>
                                                        {!! Form::text('first_name', $edit->user->first_name, ['id' => 'first_name', 'class' => 'form-control']) !!}
                                                        @if ($errors->has('first_name'))
                                                            <span   style="color: red;"
                                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('first_name') }}</span   style="color: red;">
                                                        @endif
                                                    </div>
            
                                                    <div class="form-group col-md-4">
                                                        <label for="inputtext11" class="ul-form__label">Last Name:<span style="color: red;">*</span></label>
                                                        {!! Form::text('last_name', $edit->user->last_name, ['id' => 'last_name', 'class' => 'form-control']) !!}
                                                        @if ($errors->has('last_name'))
                                                            <span   style="color: red;"
                                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('last_name') }}</span   style="color: red;">
                                                        @endif
                                                    </div>
            
                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Phone# 1<span style="color: red;">*</span></label>
                                                        {!! Form::text('phone1', $edit->user->phone1,  ['id' => 'phone1', 'class' => 'form-control','maxlength' => '18',
                                                        'onkeypress' => 'return onlyDecimalNumberKey(event)',]) !!}
                                                        @if ($errors->has('phone1'))
                                                            <span   style="color: red;"
                                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('phone1') }}</span   style="color: red;">
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Phone# 2:</label>
                                                        {!! Form::text('phone2', $edit->user->phone2,  ['id' => 'phone2', 'class' => 'form-control','maxlength' => '18',
                                                        'onkeypress' => 'return onlyDecimalNumberKey(event)',]) !!}
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Country:<span style="color: red;">*</span></label>
                                                        {!! Form::text('country', $edit->user->country,  ['id' => 'country', 'class' => 'form-control']) !!}
                                                        {{-- {!! Form::select('countries',  [], ['id' => 'countries', 'class' => 'form-control']) !!} --}}
                                                        {{-- <select class="form-control selectpicker countrypicker" id="country" name="country" ata-flag="true">
                                                            <option value=""></option>  
                                                        </select> --}}
                                                        
                                                        @if ($errors->has('country'))
                                                            <span   style="color: red;"
                                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('country') }}</span   style="color: red;">
                                                        @endif
                                                    </div>

                                                    
                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">City:<span style="color: red;">*</span></label>
                                                        {!! Form::text('city', $edit->user->city,  ['id' => 'city', 'class' => 'form-control']) !!}
                                                        @if ($errors->has('city'))
                                                            <span   style="color: red;"
                                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('city') }}</span   style="color: red;">
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Address:<span style="color: red;">*</span></label>
                                                        {!! Form::text('address1', $edit->user->address1,  ['id' => 'address1', 'class' => 'form-control']) !!}
                                                        @if ($errors->has('address1'))
                                                            <span   style="color: red;"
                                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('address1') }}</span   style="color: red;">
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Address2:</label>
                                                        {!! Form::text('address2', $edit->user->address2,  ['id' => 'address2', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Tax Registration Title:<span style="color: red;">*</span></label>
                                                        {!! Form::text('tax_reg_title', $edit->user->tax_reg_title,  ['id' => 'tax_reg_title', 'class' => 'form-control']) !!}
                                                        @if ($errors->has('tax_reg_title'))
                                                            <span   style="color: red;"
                                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('tax_reg_title') }}</span   style="color: red;">
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Tax Registration Number:<span style="color: red;">*</span></label>
                                                        {!! Form::text('tax_reg_number', $edit->user->tax_reg_number,  ['id' => 'tax_reg_number', 'class' => 'form-control']) !!}
                                                        @if ($errors->has('tax_reg_number'))
                                                            <span   style="color: red;"
                                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('tax_reg_number') }}</span   style="color: red;">
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Accept Payment Type:<span style="color: red;">*</span></label>
                                                        {{-- {!! Form::text('accepted_payment_type', $edit->user->accepted_payment_type,  ['id' => 'accept_payment_type', 'class' => 'form-control']) !!} --}}
                                                        <select  id="choices-multiple-remove-button" name="accepted_payment_type[]"
                                                        class="form-control"
                                                        placeholder="Select Payment Type"  multiple>
                                                        
                                                        @foreach ($accepted_payment_type as $value)
                                                                <option value="{{$value->id}}"  
                                                                     @if ($edit->paymethod->contains('pay_id', $value->id)) selected @endif
                                                                    >
                                                                    {{$value->name}}</option>
                                                        @endforeach

                                                    </select>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Total Employee:</label>
                                                        {!! Form::text('total_employees', $edit->user->total_employees,  ['id' => 'total_employees', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Established In:</label>
                                                        {!! Form::text('established_in', $edit->user->established_in,  ['id' => 'established_in', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Main Market:</label>
                                                        {!! Form::text('main_market', $edit->user->main_market,  ['id' => 'main_market', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Member Since:</label>
                                                        {!! Form::text('member_since', $edit->user->member_since,  ['id' => 'member_since', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Certification:</label>
                                                        {!! Form::text('certifications', $edit->user->certifications,  ['id' => 'certifications', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Website Link:</label>
                                                        {!! Form::text('website_link', $edit->user->website_link,  ['id' => 'website_link', 'class' => 'form-control']) !!}
                                                    </div>
                            

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Major Clients:</label>
                                                        {!! Form::text('major_clients', $edit->user->major_clients,  ['id' => 'major_clients', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Annual Export:</label>
                                                        {!! Form::text('annual_export', $edit->user->annual_export,  ['id' => 'annaul_export', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Annual Import:</label>
                                                        {!! Form::text('annual_import', $edit->user->annual_import,  ['id' => 'annaul_import', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Annual Revenue:</label>
                                                        {!! Form::text('annual_revenue', $edit->user->annual_revenue,  ['id' => 'annaul_revenue', 'class' => 'form-control']) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group"style="text-align: right;">
                                            <div class="">
                                                <input class="btn btn-outline-secondary" type="submit" value="Update Profile">
                                            </div>
                                        </div>


                                            </div>

                                            

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

            <div id="step-2" class="">
                <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title">Slider</h3>
                                </div>
                                    <div class="card-body">
                                        
                <div class="">
                    <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Slider Images:<span style="color: red;">*</span></label>
                                                    
                                                    <input type="file" name="slider_images[]" id="imageInput"  class="form-control" multiple >
                                                    <button type="button" class="d-none form-control" style="width: auto;"id="chooseImages">Choose Images</button>
                                                        
                                                    @if ($errors->has('slider_images'))
                                                            <span   style="color: red;"
                                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('slider_images') }}</span   style="color: red;">
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-8">
                                                    <label for="inputtext11" class="ul-form__label">Images</label>

                                                    <div id="loopImg" style="display: flex;">
                                                        {{-- @foreach (json_decode($edit->slider_images) as $value)
                                                            <img src="{{ asset($value) }}" class="img-thumbnail" style="width:100px;height:80px;" />
                                                        @endforeach --}}
                                                        @if (!empty($edit->slider_images))
                                                            @php
                                                                $decodedImages = json_decode($edit->slider_images);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $value)
                                                                    <img src="{{ asset($value) }}" class="img-thumbnail_1" style="width:100px;height:80px;" />
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $edit->slider_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif 
                                                    </div>
                                                    <div id="thumbnails"></div>
                                                    <div id="fileLimitMessage" style="color: red;"></div>
                                                </div>    
                                            </div>    
                            </div>  
                                            <div class="form-group"style="text-align: right;">
                                            <div class="">
                                                <input class="btn btn-outline-secondary" type="submit" value="Update Profile">
                                            </div>
                                        </div>            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="step-4" class="">
                <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title">About</h3>
                                </div>
                                    <div class="card-body">
                                        
                            <div class="">
                                <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="inputtext11" class="ul-form__label">About:<span style="color: red;">*</span></label>
                                                {!! Form::textarea('about', null, ['id' => 'description', 'class' => 'form-control']) !!}
                                            @if ($errors->has('about'))
                                                            <span   style="color: red;"
                                                                class="invalid-feedback1 font-weight-bold">{{ $errors->first('about') }}</span   style="color: red;">
                                                        @endif
                                            </div>
    
                                        </div>
                                        <div class="form-group"style="text-align: right;">
                                            <div class="">
                                                <input class="btn btn-outline-secondary" type="submit" value="Update Profile">
                                            </div>
                                        </div>
                            </div>              
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div id="step-3" class="">
                <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title">Portfolio</h3>
                                </div>
                                    <div class="card-body">
                                        
                <div class="">
                    <div class="row">
                                                <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Portfolio Category 1 :</label>
                                                {!! Form::text('p_category1', null, ['id' => 'p_category1', 'class' => 'form-control']) !!}
                                            </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Portfolio Category 1 images:</label>
                                                    
                                                    <input type="file" name="p_c1_images[]" id="imageInput_p"  class="form-control" multiple >
                                                    <button type="button" class="d-none form-control" style="width: auto;"id="chooseImages_p">Choose Images</button>
                                                        
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Images</label>
                                                    
                                                <div id="loopImg_p" class="image-container_1" style="display: flex;">
                                                    {{-- @foreach (json_decode($edit->p_c1_images) as $value)
                                                        <img src="{{ asset($value) }}" class="img-thumbnail_1" style="width:100px;height:80px;" />
                                                    @endforeach --}}
                                                    @if (!empty($edit->p_c1_images))
                                                            @php
                                                                $decodedImages = json_decode($edit->p_c1_images);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $image)
                                                                    <img src="{{ asset($image) }}" class="img-thumbnail" style="width:100px;height:80px;" />
                                                                    {{-- <button class="delete-image-btn" data-image="{{ $image }}">Delete</button> --}}
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                    {{-- {{ $image }} --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $edit->p_c3_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif 
                                                </div>
                                                <div id="fileLimitMessage_p" style="color: red;"></div>
                                                                                        
                                            </div>

                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script>
                                                $(document).ready(function () {
                                                    $('.delete-image-btn').on('click', function () {
                                                        var image = $(this).data('image');
                                                        
                                                        $.ajax({
                                                            type: 'DELETE',
                                                            {{-- url: '{{ route('delete.image') }}/' + image, --}}
                                                            
                                                            success: function (response) {
                                                                // Handle success, e.g., remove the deleted image container
                                                                $('.image-container:has(img[src="' + image + '"])').remove();
                                                            },
                                                            error: function (xhr, status, error) {
                                                                // Handle error
                                                                console.error(error);
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>


                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Portfolio Category 2 :</label>
                                                {!! Form::text('p_category2', null, ['id' => 'p_category2', 'class' => 'form-control']) !!}
                                            </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Portfolio Category 2 images:</label>
                                                    
                                                    <input type="file" name="p_c2_images[]" id="imageInput_p1"  class="form-control" multiple >
                                                    <button type="button" class="d-none form-control" style="width: auto;"id="chooseImages_p1">Choose Images</button>
                                                        
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Images</label>
                                                    
                                                <div id="loopImg_p" class="image-container_1" style="display: flex;">
                                                    @if (!empty($edit->p_c2_images))
                                                            @php
                                                                $decodedImages = json_decode($edit->p_c2_images);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $value)
                                                                    <img src="{{ asset($value) }}" class="img-thumbnail" style="width:100px;height:80px;" />
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $edit->p_c3_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif 

                                                </div>
                                                <div id="fileLimitMessage_p" style="color: red;"></div>
                                                                                        
                                            </div>

                                        </div>

                                        <div class="row">
                                                <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Portfolio Category 3 :</label>
                                                {!! Form::text('p_category3', null, ['id' => 'p_category3', 'class' => 'form-control']) !!}
                                            </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Portfolio Category 3 images:</label>
                                                    
                                                    <input type="file" name="p_c3_images[]" id="imageInput_p3"  class="form-control" multiple >
                                                    <button type="button" class="d-none form-control" style="width: auto;"id="chooseImages_p3">Choose Images</button>
                                                        
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Images</label>
                                                    
                                                <div id="loopImg_p" class="image-container_1" style="display: flex;">
                                                        @if (!empty($edit->p_c3_images))
                                                            @php
                                                                $decodedImages = json_decode($edit->p_c3_images);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $value)
                                                                    <img src="{{ asset($value) }}" class="img-thumbnail" style="width:100px;height:80px;" />
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $edit->p_c3_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif  
                                                </div>
                                                <div id="fileLimitMessage_p" style="color: red;"></div>
                                                                                        
                                            </div>

                                        </div>

                                        <div class="row">
                                                <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Portfolio Category 4 :</label>
                                                {!! Form::text('p_category4', null, ['id' => 'p_category4', 'class' => 'form-control']) !!}
                                            </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Portfolio Category 4 images:</label>
                                                    
                                                    <input type="file" name="p_c4_images[]" id=""  class="form-control" multiple >
                                                    <button type="button" class="d-none form-control" style="width: auto;"id="">Choose Images</button>
                                                        
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Images</label>
                                                    
                                                <div id="loopImg_p" class="image-container_1" style="display: flex;">
                                                        @if (!empty($edit->p_c4_images))
                                                            @php
                                                                $decodedImages = json_decode($edit->p_c4_images);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $value)
                                                                    <img src="{{ asset($value) }}" class="img-thumbnail" style="width:100px;height:80px;" />
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $edit->p_c4_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif  
                                                </div>
                                                <div id="fileLimitMessage_p" style="color: red;"></div>
                                                                                        
                                            </div>

                                        </div>


                                        <div class="row">
                                                <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Portfolio Category 5 :</label>
                                                {!! Form::text('p_category5', null, ['id' => 'p_category5', 'class' => 'form-control']) !!}
                                            </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Portfolio Category 5 images:</label>
                                                    
                                                    <input type="file" name="p_c5_images[]" id=""  class="form-control" multiple >
                                                    <button type="button" class="d-none form-control" style="width: auto;"id="">Choose Images</button>
                                                        
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Images</label>
                                                    
                                                <div id="loopImg_p" class="image-container_1" style="display: flex;">
                                                        @if (!empty($edit->p_c5_images))
                                                            @php
                                                                $decodedImages = json_decode($edit->p_c5_images);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $value)
                                                                    <img src="{{ asset($value) }}" class="img-thumbnail" style="width:100px;height:80px;" />
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $edit->p_c5_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif  
                                                </div>
                                                <div id="fileLimitMessage_p" style="color: red;"></div>
                                                                                        
                                            </div>

                                        </div>

                                            
                                            <div class="form-group"style="text-align: right;">
                                            <div class="">
                                                <input class="btn btn-outline-secondary" type="submit" value="Update Profile">
                                            </div>
                                        </div>

                                            

                                            
                                            <script>
                                                document.getElementById('chooseImages').addEventListener('click', function () {
                                                    document.getElementById('imageInput').click();
                                                    
                                                });
                                            
                                                document.getElementById('imageInput').addEventListener('change', function () {
                                                    
                                                    var RemoveImg = document.getElementById('loopImg');
                                                    if (RemoveImg) {
                                                        RemoveImg.style.display = 'none';
                                                    }

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
    
                                            

                                    </div>
                            </div>              
                        </div>
                    </div>
                </div>
            </div>

            

        
        </div>

            </div>

                    </div>
                </div>
            </div>
        </div>
        </div>



           

                    <br>

                    
                {!! Form::close() !!}

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
@endsection

@section('page-js')


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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('assets/js/vendor/jquery.smartWizard.min.js')}}"></script>

<script>
    $(document).ready(function () {
        $('#smartwizard').smartWizard({
            selected: 0,  // Initial step
            keyNavigation: false, // Enable keyboard navigation

        });
    });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="{{asset('assets/js/vendor/quill.min.js')}}"></script>
<script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
    
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>

 </script>
@endsection

@section('bottom-js')


<script src="{{asset('assets/js/smart.wizard.script.js')}}"></script>
<script src="{{asset('assets/js/quill.script.js')}}"></script>

<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
