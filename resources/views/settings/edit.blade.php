@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">



                <section class="module">
                {!! Form::model($edit, [
                    'method' => 'PATCH',
                    'action' => ['App\Http\Controllers\SettingsController@update', $edit->id],
                    'class' => 'form-horizontal',
                    'files' => 'true',
                    'enctype' => 'multipart/form-data',
                ]) !!}



                <div class="content-panel">
                    <h2 class="title">Company Profile<span class="pro-label label label-warning">PRO</span></h2>
                    <form class="form-horizontal">
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">
                                <!-- Update Logo -->
                            </h3>
                            <div class="form-group avatar">
                                <figure class="figure col-md-2 col-sm-3 col-xs-12">
                                    <img class="img-rounded img-responsive"
                                        src="{{ asset('/upload/logo') }}/{{ $edit->logo }}" alt="">
                                </figure>
                                <div class="form-inline col-md-10 col-sm-9 col-xs-12">
                                    <input type="file" id="logo" name="logo" class="file-uploader pull-left">
                                </div>
                            </div>
                            <br>

                            <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title">Profile Info </h3>
                                </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">System Name:</label>
                                                {!! Form::text('system_name', null, ['id' => 'system_name', 'class' => 'form-control']) !!}
                                            </div>
    
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Title:</label>
                                                {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control']) !!}
                                            </div>
    
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Phone</label>
                                                {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Email:</label>
                                                {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Address:</label>
                                                {!! Form::text('address', null, ['id' => 'address', 'class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Youtube:</label>
                                                {!! Form::text('youtube', null, ['id' => 'youtube', 'class' => 'form-control']) !!}
                                            </div>


                                            
                                            <div class="form-group col-md-4">
                                                <label for="inputtext14" class="ul-form__label">Facebook:</label>
                                                {!! Form::text('facebook', null, ['id' => 'facebook', 'class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Twitter:</label>
                                            {!! Form::text('twitter', null, ['id' => 'twitter', 'class' => 'form-control']) !!}</div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Linkedin:</label>
                                                {!! Form::text('linkedin', null, ['id' => 'linkedin', 'class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">iOS:</label>
                                                {!! Form::text('google_pluse', null, ['id' => 'google_pluse', 'class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Android:</label>
                                                {!! Form::text('pinterest', null, ['id' => 'pinterest', 'class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Whatsapp:</label>
                                                {!! Form::text('whatsapp', null, ['id' => 'whatsapp', 'class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Insta:</label>
                                                {!! Form::text('insta', null, ['id' => 'insta', 'class' => 'form-control']) !!}
                                            </div>

                                            

                                        </div>


                                    </div>

                                    

                                
                            </div>
                        </div>
                    </div>
                </div>
                            
                                
                <br>
                            <!----Contact Info----->
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title">Contact Info</h3>
                                </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Currency:</label>
                                                {!! Form::text('currency', null, ['id' => 'currency', 'class' => 'form-control']) !!}
                                            </div>
    
                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">City:</label>
                                                {!! Form::text('city', null, ['id' => 'city', 'class' => 'form-control']) !!}
                                            </div>
    
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">State:</label>
                                                {!! Form::text('state', null, ['id' => 'state', 'class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Country:</label>
                                                {!! Form::text('country', null, ['id' => 'country', 'class' => 'form-control']) !!}
                                            </div>

                                            <!-- <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">NTN:</label>
                                                {!! Form::text('ntn', null, ['id' => 'ntn', 'class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">STRN:</label>
                                                {!! Form::text('strn', null, ['id' => 'strn', 'class' => 'form-control']) !!}
                                            </div> -->


                                            
                                            <div class="form-group col-md-4">
                                                <label for="inputtext14" class="ul-form__label">Website:</label>
                                                {!! Form::text('website', null, ['id' => 'website', 'class' => 'form-control']) !!}
                                            </div>

                                            <!-- <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">CEO:</label>
                                            {!! Form::text('ceo', null, ['id' => 'ceo', 'class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Designation:</label>
                                                {!! Form::text('designation', null, ['id' => 'designation', 'class' => 'form-control']) !!}
                                            </div> -->

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Cell:</label>
                                                {!! Form::text('cell', null, ['id' => 'cell', 'class' => 'form-control']) !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="inputEmail12" class="ul-form__label">Google MAP:</label>
                                                {!! Form::text('map', null, ['id' => 'map', 'class' => 'form-control']) !!}
                                            </div>

                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <br>

                    <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title">Description & Disclaimer</h3>
                                </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="inputtext11" class="ul-form__label">Description:</label>
                                                {!! Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control', 'rows' => 8]) !!}
                                            </div>
    
                                            <div class="form-group col-md-6">
                                                <label for="inputtext11" class="ul-form__label">Disclaimer:</label>
                                                {!! Form::textarea('disclaimer', null, ['id' => 'disclaimer', 'class' => 'form-control', 'rows' => 8]) !!}
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
                        <hr>
                        
                </div>
                {!! Form::close() !!}

            </section>
        </div>

    </div>
@endsection


@section('page-js')



    <script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>

@endsection
