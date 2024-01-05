@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection
@section('main-content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-s9sR2uQ1C6e3pUaGZeYOKwJ+1tK1OlR0J07qL0vE0vOm2/JZSBXLhDkf5ypQyQ2jj/7Vb8S0s1JSbm6G4FfFAg=="
        crossorigin="anonymous" />
    <div class="breadcrumb">
        <div class="col-md-6"> <!-- Container-fluid starts-->
            <h5>Course Features Detail</h5>
        </div>
        <div class="col-md-6" style="text-align: right;  margin-left: auto;">
            <a href="{{ route('instructor.create') }}">
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
                <h4 class="card-title mb-3">All Instructor Detail</h4>
                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <!-- <td>{{ $value->instructor }}</td> -->
                                    <td>{{ $value->name}}</td>
                        <td>
                                        <div class="d-flex gap-2">
                                            <a href="https://www.industrymall.net/blog/blogs/ {{ $value->id }}"
                                                target="_blank" class="btn btn-outline-secondary">
                                                <i class="nav-icon i-Eye" title="view"></i>
                                            </a>
                                            <form action="{{ route('instructor.destroy', $value->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this instructor?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn rounded-pill btn-outline-secondary">
                                                    <i class="fa fa-trash" title="delete" aria-hidden="true"></i>
                                                </button>
                                            </form>
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
