@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')
<div class="card">
    <div class="card-header text-center">
        Terms & Conditions in detail
    </div>
        <div class="card-body">
        <h5 class="card-title text-center">{{ $item->title }}</h5>
        <p class="card-text">{{ $item->description }}</p>
    </div>
</div>
@endsection

@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>

@endsection
