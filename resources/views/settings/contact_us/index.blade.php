@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <style>
        .tooltip-container {
            position: relative;
            display: inline-block;
        }

        .message-hover {
            cursor: pointer;
            /* text-decoration: underline; */
            color: blue;
        }

        .tooltip {
            visibility: hidden;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 4px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 0;
            margin-left: -70px;
            /* Adjust as needed for tooltip positioning */
            opacity: 0;
            transition: opacity 0.2s;
            width: auto;
            /* Adjust the width as needed */
        }

        .tooltip-container:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }
    </style>
@endsection

@section('main-content')
    <div class="breadcrumb">
        <h1>Contact Supplier</h1>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">Contact Supplier</h4>
                {{--     
                        <p>.....</p>
     --}}
                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                            <th>Sr#</th>
                            <th>Title</th>
                            <th>User Type</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Profile Link</th>
                            <th>Message</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ $value->user_type }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->contact }}</td>
                                    <td>{{ $value->city . $value->state . $value->country }}</td>
                                    <td>{{ $value->profile_link }}</td>
                                    <td>
                                        <div class="tooltip-container">
                                            <span class="">{{ Str::limit($value->message, 30) }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a target="_blank" href="mailto:{{ $value->email }}">
                                                <button type="button" class="btn btn btn-outline-secondary ">
                                                    <i class="nav-icon i-Email" title="email"
                                                        style="font-weight: bold;"></i>
                                                </button></a>
                                            <a target="_blank" href="{{ route('contacts.show', $value->id) }}">
                                                <button type="button" class="btn btn btn-outline-secondary ">
                                                    <i class="nav-icon i-Eye" title="view" style="font-weight: bold;"></i>
                                                </button></a>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sr#</th>
                                <th>Title</th>
                                <th>User Type</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Profile Link</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
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
