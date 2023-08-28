@extends('layouts.master')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection

@section('main-content')
    <section class="content-header"></section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit Sub Category</h3>
                        </div>

                        {!! Form::model($edit, [
                            'method' => 'PATCH',
                            'action' => ['App\Http\Controllers\SubCategoryController@update', $edit->id],
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $edit->name }}" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Select Category</label>
                                        {!! Form::select('category_id', $categories, null, [
                                            'id' => 'category_id',
                                            'class' => 'form-control fstdropdown-select',
                                        ]) !!}
                                        @error('category_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- testing new thing  --}}
                                {{-- <div class="form-group col-md-6">
                                    <label for="inputtext11" class="ul-form__label">Choose Menu:</label>
                                    <select class="form-control" id="customer_id" name="menu_id" data-live-search="true">
                                        <option value="" selected disabled>Select Menu</option>
                                        @foreach ($menus as $menu)
                                            <option value="{{ $menu->id}}">{{ $edit->name}}</option>
                                        @endforeach
                                    </select>
                                    <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                        Please enter category name
                                    </small>
                                </div> --}}
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>SubCategory Image (1200 x 300)</label>
                                        <input type="file" name="img" id="img" class="form-control">
                                        @error('img')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" name="slug" id="slug" class="form-control">
                                        @error('slug')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection

    @section('page-js')
        <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
    @endsection

