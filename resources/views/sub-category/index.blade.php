<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@extends('layouts.master')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection

@section('main-content')
    <section class="content-header"></section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sub Catagories Management</h3>&nbsp;&nbsp;&nbsp;
                        <a href="{{ asset('sub-category/create') }}" style="float:right;" class="btn btn-primary">Add
                            Subcatagory <i class="fa fa-plus"></i></a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Slug</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key=>$donor)
                                    <tr>
                                        <td>{{ number_format($key+1) }}</td>
                                        <td>{{ $donor->name }}</td>
                                        <td>
                                            @if ($donor->categories)
                                                {{ $donor->categories->name }}
                                            @endif
                                        </td>
                                        <td><img src="{{ asset($donor->img) }}" alt="Subcategory Image"></td>
                                        <td>{{ $donor->slug }}</td>
                                        <td class="col-lg-1" style="white-space: nowrap;">
                                            <a href="{{ asset('sub-category') }}/{{ $donor->id }}/edit" class="btn rounded-pill btn-icon btn-primary">
                                                {{-- <i class="fas fa-pencil-alt" aria-hidden="true"></i> --}}
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                            <form action="{{ route('sub-category.destroy', ['sub_category' => $donor->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu item?')" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn rounded-pill btn-icon btn-danger">
                                                     <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection

    @section('page-js')
        <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
    @endsection
