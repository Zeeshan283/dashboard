@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection
@section('main-content')
<div class="breadcrumb">
                <div class="col-md-6">                <!-- Container-fluid starts-->
                        <h5>Blog SubCategoreis Lists</h5>
                </div>
                <div class="col-md-6" style="text-align: right;  margin-left: auto;">
                        <a href="{{ route('blog_subcategories.create') }}">
                        <button class="btn btn-outline-secondary ladda-button example-button m-1" data-style="expand-left"><span class="ladda-label">Add Blog Categories</span></button></a>
                </div>
</a>
    </div>
                    </div>

<div class="separator-breadcrumb border-top"></div>
<div class="col-md-12 mb-4">
    <div class="card text-start">
        <div class="card-body">
        <h4 class="card-title mb-3">All SubCategory</h4>
        <div class="table-responsive">
        <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                                style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Category</th>
                                <th>SubCategory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                  <td> {{$value->blog_category_id}}</td>  
                                 <td> {{$value->blog_sub_category_id}}</td> 
                                <td>
                                    <div class="d-flex gap-2">
                                        <a target="_blank" href="{{ URL::to('blog_subcategories/' . $value->id . '/edit') }}" >
                                        <button type="submit"  class="btn rounded-pill btn-outline-secondary">
                                                <i class="fa fa-edit me-2 font-success"  title="Edit" aria-hidden="true"></i></a>
                                            </a></button>
<form action="{{ route('blog_subcategories.destroy', $value->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn rounded-pill btn-outline-secondary">
        <i class="fa fa-trash" title="delete" aria-hidden="true"></i>
    </button>
</form>

                                        <!-- <a href="{{ asset('blog_categories/' . $value->id . '/destroy') }}">
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
