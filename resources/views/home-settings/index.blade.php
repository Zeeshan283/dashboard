@extends('layouts.master')
@section('before-css')

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
                            <h3 class="card-title">Home Settings</h3>
                        </div>
                        {!! Form::open([
                            'url' => '/update-home-settings',
                            'method' => 'POST',
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="f_s_banner_1">First Small Banner 1 (Dim: 620 x 277)</label>
                                        <input type="file" name="f_s_banner_1" id="f_s_banner_1" class="form-control">
                                        @error('f_s_banner_1')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="f_s_banner_2">First Small Banner 2 (Dim: 620 x 277)</label>
                                        <input type="file" name="f_s_banner_2" id="f_s_banner_2" class="form-control">
                                        @error('f_s_banner_2')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="f_s_banner_3">First Small Banner 3 (Dim: 620 x 277)</label>
                                        <input type="file" name="f_s_banner_3" id="f_s_banner_3" class="form-control">
                                        @error('f_s_banner_3')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="category1">Category 1</label>
                                        {!! Form::select('category1',$categories,$homeSettings->category1, ['id' => 'category1', 'class' => 'form-control fstdropdown-select']) !!}
                                        @error('category1')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="category1_image">Category1 Image (Dim: 295 x 672)</label>
                                        <input type="file" name="category1_image" id="category1_image" class="form-control">
                                        @error('category1_image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="category2">Category 2</label>
                                        {!! Form::select('category2',$categories,$homeSettings->category2, ['id' => 'category2', 'class' => 'form-control fstdropdown-select']) !!}
                                        @error('category2')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="category2_image">Category2 Image (Dim: 295 x 672)</label>
                                        <input type="file" name="category2_image" id="category2_image" class="form-control">
                                        @error('category2_image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="center_image1">Center Banner 1 (Dim: 1656 x 302)</label>
                                        <input type="file" name="center_image1" id="center_image1" class="form-control">
                                        @error('center_image1')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                                
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="category3">Category 3</label>
                                        {!! Form::select('category3',$categories,$homeSettings->category3, ['id' => 'category3', 'class' => 'form-control fstdropdown-select']) !!}
                                        @error('category3')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="category3_image">Category3 Image (Dim: 295 x 672)</label>
                                        <input type="file" name="category3_image" id="category3_image" class="form-control">
                                        @error('category3_image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="category4">Category 4</label>
                                        {!! Form::select('category4',$categories,$homeSettings->category4, ['id' => 'category4', 'class' => 'form-control fstdropdown-select']) !!}
                                        @error('category4')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="category4_image">Category4 Image (Dim: 295 x 672)</label>
                                        <input type="file" name="category4_image" id="category4_image" class="form-control">
                                        @error('category4_image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="e_s_banner_1">End Small Banner 1 (Dim: 620 x 277)</label>
                                        <input type="file" name="e_s_banner_1" id="e_s_banner_1" class="form-control">
                                        @error('e_s_banner_1')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="e_s_banner_2">End Small Banner 2 (Dim: 620 x 277)</label>
                                        <input type="file" name="e_s_banner_2" id="e_s_banner_2" class="form-control">
                                        @error('e_s_banner_2')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="e_s_banner_3">End Small Banner 3 (Dim: 620 x 277)</label>
                                        <input type="file" name="e_s_banner_3" id="e_s_banner_3" class="form-control">
                                        @error('e_s_banner_3')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Home Images</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">First Samll Banner 1</label>
                                        <img src="{{ $homeSettings->f_s_banner_1 }}"  alt="First-Samll-Banner-1">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">First Samll Banner 3</label>
                                        <img src="{{ $homeSettings->f_s_banner_2}}"  alt="First-Samll-Banner-1">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">First Samll Banner 3</label>
                                        <img src="{{ $homeSettings->f_s_banner_3 }}"  alt="First-Samll-Banner-1">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">Center Banner</label>
                                        <img src="{{ $homeSettings->center_image1 }}"  alt="center img  ">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">
                                
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">End Samll Banner 1</label>
                                        <img src="{{ $homeSettings->e_s_banner_1 }}"  alt="end-Samll-Banner-1">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">End Samll Banner 3</label>
                                        <img src="{{ $homeSettings->e_s_banner_2 }}"  alt="end-Samll-Banner-1">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">End Samll Banner 3</label>
                                        <img src="{{ $homeSettings->e_s_banner_3 }}"  alt="end-Samll-Banner-1">
                                    </div>
                                </div>
                                
                            </div>
                                
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
@endsection
