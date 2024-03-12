@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@section('main-content')

    <div class="breadcrumb col-lg-12">
        <div class="col-md-6 col-sm-6">
            <h1>All Menus</h1>
        </div>
        <div class="col-md-6 col-sm-6" style="text-align: right;  margin-left: auto;">
            <a class="{{ Route::currentRouteName() == 'addmenu' ? 'open' : '' }}" href="{{ route('addmenu') }}">
                <button class="btn btn-outline-secondary" type="submit">Add Menu</button>
            </a>
        </div>
    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="col-md-12 mb-4">
        <div class="card text-start">

            <div class="card-body">
                <h4 class="card-title mb-3">All Menus</h4>
                <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                        style="width:100%">
                        @include('datatables.table_content')
                    </table>
                </div>

            </div>
        </div>
    </div>
    <script>
        function toggleFilters() {
            var filterCard = document.getElementById("filterCard");
            filterCard.style.display = (filterCard.style.display === "none" || filterCard.style.display === "") ? "block" :
                "none";
        }
    </script>
@endsection

@section('page-js')
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
