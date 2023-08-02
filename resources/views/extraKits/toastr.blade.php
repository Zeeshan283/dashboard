@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/toastr.css')}}">
@endsection

@section('main-content')
    <div class="breadcrumb">
                <h1>Toastr</h1>
                <ul>
                    <li><a href="">Componets</a></li>
                    <li>Toastr</li>
                </ul>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <h2>Toastr</h2>
                    <p>Toastr is a Javascript library for non-blocking notifications. jQuery is required. The goal is to create a simple core library that can be customized and extended.</p>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <h3>Types</h3>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <button id="toast-success" class="btn w-100 btn-outline-success mb-2">success toaster</button>
                            <button id="toast-info" class="btn w-100 btn-outline-info">info toaster</button>
                        </div>
                    </div>
                </div>
                <!-- end of col -->

                <div class="col-md-6">
                    <div class="card">

                        <div class="card-body">
                            <button id="toast-warning" class="btn w-100 btn-outline-warning mb-2">warning toaster</button>
                            <button id="toast-error" class="btn w-100 btn-outline-danger">danger toaster</button>
                        </div>
                    </div>
                </div>
                <!-- end of col -->


            </div>
            <!-- end of row -->

            <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <h3>Positions</h3>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title">Top Positions</h3>
                            <button id="toast-position-top-left" class="btn w-100 btn-outline-info mb-2">Top Left</button>
                            <button id="toast-position-top-center" class="btn w-100 btn-outline-info mb-2">Top Center</button>
                            <button id="toast-position-top-right" class="btn w-100 btn-outline-info mb-2">Top Right</button>
                            <button id="toast-position-top-full" class="btn w-100 btn-outline-info">Top Full</button>

                        </div>
                    </div>
                </div>
                <!-- end of col -->

                <div class="col-md-6">
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title">Bottom Positions</h3>
                            <button id="toast-position-bottom-left" class="btn w-100 btn-outline-info mb-2">bottom Left</button>
                            <button id="toast-position-bottom-center" class="btn w-100 btn-outline-info mb-2">bottom Center</button>
                            <button id="toast-position-bottom-right" class="btn w-100 btn-outline-info mb-2">bottom Right</button>
                            <button id="toast-position-bottom-full" class="btn w-100 btn-outline-info">bottom Full</button>

                        </div>
                    </div>
                </div>
                <!-- end of col -->


            </div>
            <!-- end of row -->
            <div class="row mb-4">

                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title ">Text Notifications</h3>
                            <button id="toast-text-notification" class="btn w-100 btn-outline-info">Show Toast</button>


                        </div>
                    </div>
                </div>
                <!-- end of col -->

                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title">Close Button</h3>
                            <button id="toast-close-button" class="btn w-100 btn-outline-success">Show Toast</button>

                        </div>
                    </div>
                </div>
                <!-- end of col -->
                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title">Progress Bar</h3>
                            <button id="toast-progress-bar" class="btn w-100 btn-outline-warning">Show Toast</button>

                        </div>
                    </div>
                </div>
                <!-- end of col -->
                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title">Clear Toast</h3>
                            <button id="toast-clear-btn" class="btn w-100 btn-outline-danger">Show Toast</button>

                        </div>
                    </div>
                </div>
                <!-- end of col -->


            </div>
            <!-- end of row -->

            <div class="row mb-4">
                <div class="col-md-12">
                    <h2>Remove/Clear Toasts</h2>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title">Remove Toast</h3>
                            <p>remove toast without animation</p>
                            <button id="toast-show-remove" class="btn w-100 btn-outline-info mb-2">Show Toast</button>
                            <button id="toast-remove" class="btn w-100 btn-outline-info">Remove Toast</button>


                        </div>
                    </div>
                </div>
                <!-- end of col -->

                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title">Clear Toast</h3>
                            <p>Clear toast with animation</p>
                            <button id="toast-show-clear" class="btn w-100 btn-outline-info mb-2">Show Toast</button>
                            <button id="toast-clear" class="btn w-100 btn-outline-info">Clear Toast</button>


                        </div>
                    </div>
                </div>
                <!-- end of col -->


            </div>
            <!-- end of row -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h2>Duraton and Timeouts</h2>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title mb-1">Show .6s</h3>
                            <p>the show time can be define by using <code>showDuration</code></p>
                            <button id="toast-fast-duration" class="btn w-100 btn-outline-info mb-3">Show Fast Toast</button>
                            <h3 class="card-title mb-1">Timeout 6s</h3>
                            <p>Time Out can be define by <code>timeout</code> to set what amount of time will stay</p>
                            <button id="toast-timeout" class="btn w-100 btn-outline-info">Timeout Toast</button>


                        </div>
                    </div>
                </div>
                <!-- end of col -->

                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title mb-1">Hide 3s</h3>
                            <p>Hide can be define by <code>hideDuration</code> to set what amount of time will take to hide message</p>

                            <button id="toast-slow-duration" class="btn w-100 btn-outline-info mb-3">Hide Toast</button>
                            <h3 class="card-title mb-1">Sticky</h3>
                            <p>Sticky Message can be create by set the <code>timeout</code> to <code>0</code></p>
                            <button id="toast-sticky" class="btn w-100 btn-outline-info">Sticky Toast</button>


                        </div>
                    </div>
                </div>
                <!-- end of col -->


            </div>
            <!-- end of row -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <h2>Show / Hide animation</h2>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title">FadeIn /FadeOut</h3>

                            <button id="toast-fade" class="btn w-100 btn-outline-info">Fade Toast</button>



                        </div>
                    </div>
                </div>
                <!-- end of col -->

                <div class="col-md-6 mb-4">
                    <div class="card">

                        <div class="card-body">
                            <h3 class="card-title">SlideDown /SlideUp</h3>


                            <button id="toast-slide" class="btn w-100 btn-outline-info">Slide Toast</button>



                        </div>
                    </div>
                </div>
                <!-- end of col -->


            </div>
            <!-- end of row -->

@endsection

@section('page-js')

 <script src="{{asset('assets/js/vendor/toastr.min.js')}}"></script>
    <script src="{{asset('assets/js/toastr.script.js')}}"></script>

@endsection
