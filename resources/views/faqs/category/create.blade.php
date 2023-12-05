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
                            <h3 class="card-title text-center">Add Category</h3>
                        </div>

                        <form method="post" action="{{ route('faqs_categories.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="name">Category Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">Submit</label>
                                        <br>
                                        <button type="submit" class="btn btn-outline-secondary ">Submit</button>

                                    </div>
                                </div>
                            </div>

                            {!! Form::close() !!}
                    </div>
                @endsection

                @section('page-js')
                    <script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
                @endsection
