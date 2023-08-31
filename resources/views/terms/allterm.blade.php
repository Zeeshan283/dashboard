@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')
    <div class="breadcrumb col-lg-12">

                <h1 class="col-lg-10">All Terms & Conditions</h1>
                <a class="{{ Route::currentRouteName() == 'addterm' ? 'open' : '' }}"
                href="{{ route('addterm') }}">
                 <button class="btn btn-primary" type="submit" style="color: white;">Add Terms & Conditions</button>
             </a>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
                <div class="card text-start">

                    <div class="card-body">
                        <h4 class="card-title mb-3">Terms & Conditions</h4>
                        <p>With DataTables you can alter the ordering characteristics of the table at initialisation time. Using
                            the order initialisation parameter, you can set the table to display the data in exactly the order
                            that you want.</p>

                        <div class="table-responsive">
                            <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                                style="width:100%">
                                @include('datatables.table_content')
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
