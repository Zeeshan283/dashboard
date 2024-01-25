@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection

@section('main-content')
<div class="breadcrumb">

    <h1>Portfolio Management</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid " id="">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h5>Profile Service Management</h5> -->
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('portfolios.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="  mb-4">
                                    <h5 class="card-header text-left">Create Portfolio  </h5>
                                    <hr class="my-0" />
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="hidden" name="vendor_id" value="{{ Auth::user()->id }}">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title"
                                                        placeholder="Title" name="title" required>
                                                </div>
                                            </div> 
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="image" class="form-label">Image (png,jpg,jpeg)</label>
                                                     
                                                        <input type="file" name="image[]" id="imageInput" class="form-control" multiple>
                                                        <button type="button" class="d-none form-control" style="width: auto;" id="chooseImages">Choose Images</button>
                                                </div>

                                            </div>
                                             
                                        </div>
                                    </div>
                                    <div class="mt-2 " style="text-align: right">
                                        <button type="submit" class="btn btn-outline-secondary  me-2">Create</button>
                                    </div>
                                </div>
                                <!-- /Account -->
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
@endsection

@section('page-js')
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
