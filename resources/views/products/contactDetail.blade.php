@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')
                <div class="main-content">
                <div class="breadcrumb">
                    <div class="col-md-6">
                    <h1>Product Message Queries</h1>
                    </div>
                    <div class="col-md-6" style="text-align: right;  margin-left: auto;">
                        <a href="mailto:{{$data->email}}"><button class="btn btn-outline-secondary  ladda-button example-button m-1" data-style="expand-left"><span class="ladda-label">Send Mail</span></button></a>
                    </div>
                </div>

            <div class="separator-breadcrumb border-top"></div>

            <div class="card user-profile o-hidden mb-4">
                
                
                <div class="card-body">
                    <ul class="nav nav-tabs profile-nav mb-4" id="profileTab" role="tablist"></ul>

                    <div class="tab-content" id="profileTabContent">
                        
                        <div class="tab-pane fade active show" id="about" role="tabpanel" aria-labelledby="about-tab">
                            <h4>Message:</h4>
                            <p>
                                {{$data->message}}
                            </p>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Calendar text-16 mr-1"></i> Person Name</p>
                                        <span>{{$data->make}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Supplier Name</p>
                                        <span>{{$data->vendor->name}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Globe text-16 mr-1"></i> Contact Number</p>
                                        <span>{{$data->phoneno}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Company Name</p>
                                        <span>{{$data->company}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Email</p>
                                        <span>{{$data->email}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Cloud-Weather text-16 mr-1"></i> Website</p>
                                        <span>{{$data->website}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> Product Name</p>
                                        <span>{{$data->pro_name}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> Model#</p>
                                        <span>{{$data->model_no}}</span>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Address</p>
                                        <span>{{$data->address}}</span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4>Other Info</h4>
                            <p class="mb-4">.....</p>
                            
                        </div>

                    </div>
                </div>
            </div>



                </div>

                <!-- Footer Start -->
<div class="flex-grow-1"></div>

@endsection

@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>

@endsection
