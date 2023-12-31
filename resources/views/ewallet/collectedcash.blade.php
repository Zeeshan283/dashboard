@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
    <div class="breadcrumb">
                <h1>Collected Cash</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
                <div class="card text-start">
    
                    <div class="card-body">
                        <h4 class="card-title mb-3">Collected Cash</h4>
    
                        {{-- <p>All Orders list is below.</p> --}}
    
                        <div class="table-responsive">
                            <table id="deafult_ordering_table" class="display table table-striped table-bordered"  style="width:100%;">
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
