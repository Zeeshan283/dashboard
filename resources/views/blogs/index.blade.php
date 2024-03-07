@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
@endsection
@section('main-content')
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <style>
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ced4da;
            padding: 8px;
            max-height: 160px;
            max-width: 500px;
            overflow-y: auto;
        }

        .dropdown-options {
            margin-top: 30px;
        }

        .dropdown-options label {
            display: block;
            margin-bottom: 5px;
        }

        .option-text {
            margin-left: 5px;
        }

        /* Simplify focus outline for search inputs */
        input:focus {
            border-color: #ced4da;
            outline: none;
        }

        .dropdown-toggle {
            display: flex;
            max-width: 300px;
            padding-right: 100px;
            padding-left: 30px;
            background-color: #f8f9fa;
            border: 2px solid #e2eaf1;
            cursor: pointer;
            padding-top: 10px;
            padding-bottom: 5px;
            overflow: hidden;
        }

        .text-left {
            margin-right: auto;
        }

        .filter-card {
            margin-bottom: 0px;
            overflow: hidden;
            margin-left: 60px;
        }

        .datetimerange {
            border-color: #ccc !important;
            max-width: 300px;
            border: 2px solid;
            padding-top: 12px;
            padding-bottom: 12px;
            padding-right: 60px;
            padding-left: 10px;
            background-color: #f8f9fa;
        }
    </style>
    <div class="card-body">
        <button class="popup-button btn btn-primary col-md-1"
            style="color: white; position: relative; top: 10px; right: 10px;" onclick="toggleFilters()">Product
            Filters</button><br><br>
        <div class="filter-card" id="filterCard">
            <form action="{{ route('blogs.index') }}" method="GET">
                <button type="submit" class="btn btn-secondary" style="margin-left: 1200px">Submit</button>
                <div class="row" style="margin-top: 5px; margin-bottom: 180px;">
                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class=" text-left">Blog Category</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                            @foreach ($blogs as $key => $value)
                                        <label class="blog_category_idFilter">
                                            <input type="checkbox" value="{{ $value->blogCategory->blog_category_id ?? null }}">
                                            <span class="option-text">{{ $value->blogCategory->blog_category_id ?? null }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="dropdown">
                            <div class="dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <p class="text-left">Blog SubCategory</p>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <input type="text" id="searchInput" onkeyup="filterOptions()" placeholder="Search...">
                                <div class="dropdown-options">
                            @foreach ($blogs as $key => $value)
                                        <label class="nameFilter">
                                            <input type="checkbox" value="{{ $value->blogSubCategory->name ?? null }}">
                                            <span class="option-text">{{ $value->blogSubCategory->name ?? null }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3" style="margin-left: 0px;">
                        <div class="content-box">
                            <input type="button" class="datetimerange" value="12/31/2017 - 01/31/2018" />
                        </div>
                    </div>

                    <script>
                        $(function() {
                            $('.datetimerange').daterangepicker({
                                timePicker: true,
                                timePickerIncrement: 30,
                                locale: {
                                    format: 'MM/DD/YYYY h:mm A'
                                }
                            });
                        });
                    </script>

                </div>
                <script>
                    function toggleFilters() {
                        var filterCard = document.getElementById("filterCard");
                        if (filterCard.style.display === "none") {
                            filterCard.style.display = "block";
                        } else {
                            filterCard.style.display = "none";
                        }
                    }
                </script>
            </form>
        </div>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="breadcrumb">
        <div class="col-md-6"> <!-- Container-fluid starts-->
            <h5>Blog List</h5>
        </div>
        <div class="col-md-6" style="text-align: right;  margin-left: auto;">
            <a href="{{ route('blogs.create') }}">
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
                <h4 class="card-title mb-2">All Blogs</h4>
                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>SubCategory</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->blogCategory->blog_category_id ?? null }}</td>
                                    <td>{{ $value->blogSubCategory->name ?? null }}</td>
                                    <td><img src="{{ $value->feature_image }}" loading="lazy" width="80px"></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a target="_blank" href="{{ URL::to('blogs/' . $value->id . '/edit') }}">
                                                <button type="submit" class="btn rounded-pill btn-outline-secondary">
                                                    <i class="fa fa-edit me-2 font-success" title="Edit"
                                                        aria-hidden="true"></i></a>
                                            </a></button>
                                            <form action="{{ route('blogs.destroy', $value->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this blog?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn rounded-pill btn-outline-secondary">
                                                    <i class="fa fa-trash" title="delete" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                            <a href="https://www.industrymall.net/blog/blogs/ {{ $value->id }}"
                                                target="_blank" class="btn btn-outline-secondary">
                                                <i class="nav-icon i-Eye" title="view"></i>
                                            </a>

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
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
    @endsection
