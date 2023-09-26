@extends('layouts.master')
@section('before-css')

@endsection
@section('main-content')
            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title text-center"> Add Brand</h3>
                                </div>
        
            {!! Form::open([
            'url' => 'brands',
            'method' => 'POST',
            'class' => 'form-horizontal',
            'enctype' => 'multipart/form-data',
        ]) !!}
        {!! Form::hidden('type', 'brand', ['id' => 'type']) !!}
            <div class="card-body">
                <div class="row">
            <div class="form-group col-md-4">
                <label for="name">Band Name</label>
                <input type="text" name="brand_name" id="name" class="form-control" value="">
            </div>
            <div class="form-group col-md-4">
                <label for="image">Image</label>
                <input type="file" name="logo" id="logo" class="form-control" value="">
            
            </div>
            <div class="form-group col-md-4">
                <label for="image">Logo</label>
                <img src="{{ URL::asset('website-assets/images/dummy/img_410_x_186.png') }}"  class="img-fluid" id="show_brand_logo" width="200" height="70">
            
            </div>


            
                </div>
            </div>
            <div style="
    text-align: center;
">
            <button type="submit" class="btn btn-outline-secondary ">Submit</button>
</div>
            
        {!! Form::close() !!}
    </div>
@endsection

    @section('page-js')
<script>
        $(document).ready(function() {
            $('#logo').change(function(event) {
                var filePath1 = URL.createObjectURL(event.target.files[0]);
                $("#show_brand_logo").fadeIn("fast").attr('src', filePath1);
            });
        });
    </script>

    <script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
    @endsection
