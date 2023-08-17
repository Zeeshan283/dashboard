@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
    <div class="breadcrumb">
                <h1>Vendor List</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
                <div class="card text-start">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Vendor List</h4>

                        <p>With DataTables you can alter the ordering characteristics of the table at initialisation time. Using
                            the order initialisation parameter, you can set the table to display the data in exactly the order
                            that you want.</p>

                        <div class="table-responsive">
                            <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                                style="width:100%">
                                @include('datatables.table_content')
                                {{-- <tbody>
                                    @foreach($listvendor as$listvendor)
                                    <tr>
                                        <td>{{$listvendor->id}}</td>
                                        <td>{{$listvendor->name}}</td>
                                        <td>{{$listvendor->phone1}}</td>
                                        <td>{{$listvendor->email}}</td>
                                        <td>{{$listvendor->status}}</td>
                                        <td><a href="{{url('/admin/edit-service/' . $listvendor['id'])}}" class="btn rounded-pill btn-icon btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                    </tr>
                                    @endforeach

                                </tbody> --}}
                            </table>
                        </div>

                    </div>
                </div>
            </div>


@endsection

@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
