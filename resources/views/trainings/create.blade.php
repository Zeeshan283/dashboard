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
            max-width: auto;
            max-height: 100px;
            margin: 5px;
        }
    
        .choices__input {
            background: #f3f4f6;
        }


        .choices_list--multiple .choices_item {
            /* width: 3%; */
            font-size: 14px;
            font-family: initial;
            /* background-color: #6b7280; */
            /* background-color: #e9ecef; */
            color: black;
            border-radius: 42px;
            /* height: 28px; */
            border: transparent;
        }

        .choices[data-type*=select-multiple] .choices__button {
            border-left: white;
            display: none;
        }
    </style>
@endsection

@endsection


@section('main-content')
<div class="breadcrumb">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
                <h1>Training Page</h1>
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
                            <div id="step-2" class="">
                        <div class="card-body">
                        <form method="post" action="{{ route('trainings.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card mb-4">
                                    <h5 class="card-header text-left">Training Category</h5>
                                    <hr class="my-0"/>
                                    <div class="card-body">
                                        <div class="row">
        <div class="col-sm-6">
            <div class="form-group" ml-10>
                <label for="training_category_id" class="form-label">Training Category</label>
                <input type="text" class="form-control" id="training_category_id" placeholder="Training Category" name="training_category_id"  required>
            </div>
        </div>
        </div>
                                        <div class="mt-2" style="text-align: right">
                                            <button type="submit" class="btn btn-outline-secondary me-2">Create</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    @endsection
@section('bottom-js')
<script src="{{asset('assets/js/smart.wizard.script.js')}}"></script>
<script src="{{asset('assets/js/quill.script.js')}}"></script>
@endsection