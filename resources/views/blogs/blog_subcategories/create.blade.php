@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection

@section('main-content') 
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid " id="">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Blog SubCategories Management</h5>
                        </div>
                        <div class="card-body">
                        <form method="post" action="{{ route('blog_subcategories.store') }}">
                                @csrf
                                <div class="card mb-4">
                                    <h5 class="card-header text-left">Create  Blog SubCategories </h5>
                                    <hr class="my-0"/>
                                    <div class="card-body">
                                        <div class="row col-lg-12">
                                        <div class="col-sm-6">
    <div class="form-group ml-6">
        <label for="inputtext11" class="form-label">Category:</label>
        <select class="form-control" id="blog_category_id" name="blog_category_id">
            @foreach ($categories as $data)
                <option value="{{ $data->blog_category_id}}">{{ $data->blog_category_id }}</option>
            @endforeach
        </select>
    </div>    
</div>

              
        <div class="col-sm-6">
            <div class="form-group">
                <label for="inputtext11" class="form-label">Sub Category</label>
                <input type="text" class="form-control" id="blog_sub_category_id" placeholder="Sub Category" name="blog_sub_category_id" required>
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

