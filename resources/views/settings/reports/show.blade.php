@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')
    <div class="main-content">
        <div class="breadcrumb">
            <div class="col-md-6">
                <h1>Report Details</h1>
            </div>
            <div class="col-md-6" style="text-align: right;  margin-left: auto;">
                <a href="mailto:{{ $data->email }}"><button
                        class="btn btn-outline-secondary  ladda-button example-button m-1" data-style="expand-left"><span
                            class="ladda-label">Send Mail</span></button></a>
            </div>
        </div>

        <div class="separator-breadcrumb border-top"></div>

        <div class="card user-profile o-hidden mb-4">


            <div class="card-body">
                <ul class="nav nav-tabs profile-nav mb-4" id="profileTab" role="tablist"></ul>

                <div class="tab-content" id="profileTabContent">

                    <div class="tab-pane fade active show" id="about" role="tabpanel" aria-labelledby="about-tab">
                        <h4>Title:</h4>
                            <p>
                                {{$data->title}}
                            </p>
                        <hr>
                        <br>
                        <div class="container">
                            <div class="row">
                                @if (Auth::user()->role == 'Admin')
                                    <div class="mb-4 col-4">
                                        <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> User Type
                                        </p>
                                        <span>{{ $data->user_type }}</span>
                                    </div>
                                    <div class=" mb-4 col-4">
                                        <p class="text-primary mb-1"><i class="i-Calendar text-16 mr-1"></i> Name
                                        </p>
                                        <span>{{ $data->name }}</span>
                                    </div>
                                
                                <div class="col-4 mb-4">
                                    <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i>
                                        Company Name</p>
                                    <span>{{ $data->company }}</span>
                                </div>
                                <div class="col-4 mb-4">
                                    <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i>
                                        Email</p>
                                    <span>{{ $data->email }}</span>
                                </div>
                                <div class="col-4 mb-4">
                                    <p class="text-primary mb-1"><i class="i-Cloud-Weather text-16 mr-1"></i>
                                        Contact</p>
                                    <span>{{ $data->contact }}</span>
                                </div>
                                <div class="col-4 mb-4">
                                    <p class="text-primary mb-1"><i class="i-Cloud-Weather text-16 mr-1"></i>
                                        Profile Link</p>
                                    <span>{{ $data->profile_link }}</span>
                                </div>

                                <div class="col-4 mb-4">
                                    <p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> City</p>
                                    <span>{{ $data->city }}</span>
                                </div>
                                <div class=" col-4 mb-4">
                                    <p class="text-primary mb-1"><i class="i-Professor text-16 mr-1"></i> State
                                    </p>
                                    <span>{{ $data->state }}</span>
                                </div>
                                <div class=" col-4 mb-4">
                                    <p class="text-primary mb-1"><i class="i-Home1 text-16 mr-1"></i> Country
                                    </p>
                                    <span>{{ $data->counrty }}</span>
                                </div>

                            </div>
                            @endif
                        </div>
                        <hr>
                        <h4>Message</h4>
                        <p class="mb-4">{{ $data->message }}</p>

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
