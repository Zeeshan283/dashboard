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
                                    <h3 class="card-title text-center"> Edit Brand</h3>
                                </div>
        
            {!! Form::model($data, [
                            'method' => 'PATCH',
                            'action' => ['App\Http\Controllers\BrandController@update', $data->id],
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        {!! Form::hidden('type', 'brand', ['id' => 'type']) !!}
            <div class="card-body">
                <div class="row">
            <div class="form-group col-md-4">
                <label for="name">Band Name</label>
                <input type="text" name="brand_name" id="name" class="form-control" value="{{ $data->brand_name }}">
            </div>
            <div class="form-group col-md-4">
                <label for="image">Image(190x70)px</label>
                <input type="file" name="logo" id="logo" class="form-control" value="">
            </div>
            <div class="form-group col-md-4">
                <label for="image">Logo(190x70)px</label>
                <img src="{{ URL::asset('website-assets/images/dummy/img_410_x_186.png') }}"  class="img-fluid" id="show_brand_logo" width="200" height="70"> 
            </div>
            <!-- <div class="form-group col-md-4">
                <label for="image">Logo</label>
                <img src="{{ URL::asset('root/upload/brands/big/' . $data->logo)  }}"  class="img-fluid" id="show_brand_logo" width="200" height="70">
            <img src="{{ asset("/root/upload/brands/small/".$data->logo) }}" width="50" height="50">  
            </div> -->
                </div>
            </div>
            <div style="
    text-align: center;
">
            <button type="submit" class="btn btn-outline-secondary ">Update</button>
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
