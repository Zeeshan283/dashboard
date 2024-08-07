@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
<style>
        .image-container_1 {
            max-height: 400px;
            /* Set the maximum height you want for the images */
            overflow-y: auto;
            /* Add a vertical scrollbar if needed */
        }

        .img-thumbnail_1 {
            display: block;
            margin-bottom: 10px;
            /* Add some spacing between images */
        }
    </style>
@endsection
@section('main-content')
<div class="breadcrumb">
    <div class="col-md-6">
        <!-- Container-fluid starts-->
        <h5>Portfolio Management</h5>
    </div>
    <div class="col-md-6" style="text-align: right;  margin-left: auto;">
        <a href="{{ route('portfolios.create') }}">
            <button class="btn btn-outline-secondary ladda-button example-button m-1" data-style="expand-left"><span
                    class="ladda-label">Add</span></button></a>
    </div>
    </a>
</div>
</div>

<div class="separator-breadcrumb border-top"></div>
<div class="col-md-12 mb-4">
    <div class="card text-start">
        <div class="card-body">
            <h4 class="card-title mb-3">Portfolio List</h4>
            <div class="table-responsive">
                <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>title</th>
                            <th style="width:600px;">Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($data as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td> {{ $value->title }}</td>
                            <td>
                            <div id="loopImg_p" class="image-container_1"
                                                        style="display: flex;">
                                                        {{-- @foreach (json_decode($value->image) as $value)
                                                        <img src="{{ asset($value) }}" class="img-thumbnail_1" style="width:100px;height:80px;" />
                                                    @endforeach --}}
                                                        @if (!empty($value->image))
                                                            @php
                                                                $decodedImages = json_decode($value->image);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $image)
                                                                    <img src="{{ asset($image) }}"
                                                                        class="img-thumbnail"
                                                                        style="width:100px;height:80px;" />
                                                                    {{-- <button class="delete-image-btn" data-image="{{ $image }}">Delete</button> --}}
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                    {{-- {{ $image }} --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $value->p_c3_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif
                                                    </div>
                                                    <div id="fileLimitMessage_p" style="color: red;"></div>
                                
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- <a href="{{ URL::to('portfolios/' . $value->id . '/edit') }}"><button type="button"
                                            class="btn btn-outline-secondary ">
                                            <i class=" nav-icon i-Pen-2" title="edit" style="font-weight: bold;"></i>
                                        </button></a> -->
                                    <form action="{{ route('portfolios.destroy', $value->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this Category?, Remember that they also delete with your profile')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn rounded-pill btn-outline-secondary">
                                            <i class="fa fa-trash" title="delete" aria-hidden="true"></i>
                                        </button>
                                    </form>

                                    <!-- <a href="{{ asset('cprofile/' . $value->id . '/destroy') }}">
                                                                                                                                                                                                                                                                                                        <i class="fa fa-trash font-danger"></i></a>                                                                     </a> -->
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection
@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection