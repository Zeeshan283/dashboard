@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')

<div id="bank-account-details" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row g-0">
            <div class="col-sm-4  justify-content-center" style="background-color: green;">
              <div class="my-auto text-center">
                <div class="text-17 text-white mb-3" style="font-size: 60px;"><i class="fas fa-university"></i></div>
                <h3 class="text-6 text-white my-3">{{$value->bank_name}}</h3>
                <div class="text-4 text-white my-4">{{$value->account_no}}| {{$value->bank_address}}</div>
                <p class="badge bg-light text-dark text-0 fw-500 rounded-pill px-2 mb-0">Primary</p>
              </div>
            </div>
@endsection
@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>

@endsection
