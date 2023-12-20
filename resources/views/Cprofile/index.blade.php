@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection
@section('main-content')
    <div class="breadcrumb">
        <div class="col-md-6"> <!-- Container-fluid starts-->
            <h5>Profile Category List</h5>
        </div>
        <div class="col-md-6" style="text-align: right;  margin-left: auto;">
            <a href="{{ route('cprofile.create') }}">
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
                <h4 class="card-title mb-3">Profile Category</h4>
                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td> {{ $value->pcategory }}</td>
                                    <td>
                                        <div class="d-flex gap-2">

                                            <form action="{{ route('cprofile.destroy', $value->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this Category?, Remember that they also delete with your profile')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn rounded-pill btn-outline-secondary">
                                                    <i class="fa fa-trash" title="delete" aria-hidden="true"></i>
                                                </button>
                                            </form>

                                            <!-- <a href="{{ asset('cprofile/' . $value->id . '/destroy') }}">
                                                                                                                    <i class="fa fa-trash font-danger"></i></a>
                                                                                                               </a> -->
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
