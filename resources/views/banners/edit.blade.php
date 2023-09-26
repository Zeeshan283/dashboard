@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit Banner</h3>
                        </div>

                        {!! Form::model($edit, [
                            'method' => 'PATCH',
                            'action' => ['App\Http\Controllers\BannersController@update', $edit->id],
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data'
                        ]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="title1">Title 1</label>
                                        <input type="text" name="title1" id="title1"
                                            class="form-control @error('title1') is-invalid @enderror" value="{{ $edit->title1 }}"  required autofocus>
                                        @error('title1')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="title2">Title 2</label>
                                        <input type="text" name="title2" id="title2"
                                            class="form-control @error('title2') is-invalid @enderror" value="{{ $edit->title2 }}"  required>
                                        @error('title2')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="offer">Offer</label>
                                        <input type="text" name="offer" id="offer"
                                            class="form-control @error('offer') is-invalid @enderror" value="{{ $edit->offer }}" maxlength="20" required>
                                        @error('offer')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="url">URL</label>
                                        <input type="text" name="url" id="url"
                                            class="form-control @error('url') is-invalid @enderror" value="{{ $edit->url }}" required>
                                        @error('url')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="image">Image (Dim: 474 x 397)</label>
                                        <input type="file" name="image" id="image"
                                            class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="bg_image">Background Image (Dim: 1903 x 520)</label>
                                        <input type="file" name="bg_image" id="bg_image"
                                            class="form-control @error('bg_image') is-invalid @enderror">
                                        @error('bg_image')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-outline-secondary">Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Banner Images</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Image</label>
                                <img src="{{ $edit->image }}" width="100%" height="200px" id="show_f_image" alt="">
                            </div>
                            <div class="form-group">
                                <label for="">BG Image</label>
                                <img src="{{ $edit->bg_image }}" width="100%" height="150px" id="show_bg_image" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        </div>

    </div>
@endsection


@section('page-js')
<script>
        $(document).ready(function() {
            $('#image').change(function(event) {
                var filePath = URL.createObjectURL(event.target.files[0]);
                $("#show_f_image").fadeIn("fast").attr('src', filePath);
            });
            $('#bg_image').change(function(event) {
                var filePath = URL.createObjectURL(event.target.files[0]);
                $("#show_bg_image").fadeIn("fast").attr('src', filePath);
            });
        });
    </script>


    <script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>

@endsection
