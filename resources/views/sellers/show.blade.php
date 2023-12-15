{{-- @extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')
<div class="account-card account-card-primary text-white rounded hover-card">
  <div class="row g-0">
    <div class="col-3 d-flex justify-content-center p-3"><br>
      <div class="my-auto text-center"> <span class="text-13" style="font-size: 70px;"><i class="fas fa-university"></i></span>
        <p class="badge bg-warning text-dark text-0 fw-500 rounded-pill px-2 mb-0">Primary</p>
      </div>
    </div>
    <div class="col-9 border-start">
<div class="py-4 my-2 ps-4">
        <p class="text-4 fw-500 mb-1">HDFC Bank</p>
        <p class="text-4 opacity-9 mb-1">XXXXXXXXXXXX-9025</p>
        <p class="m-0">Approved <span class="text-3"><i class="fas fa-check-circle"></i></span></p>
      </div>
    </div>
  </div>
  <div class="account-card-overlay rounded"> 
    <a href="#" data-bs-target="#bank-account-details" data-bs-toggle="modal" class="text-light btn-link mx-2" onclick="showBankAccountModal()">
        <span class="me-1"><i class="fas fa-share"></i></span>More Details</a>
         <a href="#" class="text-light btn-link mx-2">
            <span class="me-1"><i class="fas fa-minus-circle"></i></span>Delete</a> </div>
</div>
@endsection
@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>

@endsection --}}
@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
<div class="account-card account-card-primary text-white rounded hover-card">
  <div class="row g-0">
    <div class="col-3 d-flex justify-content-center p-3"><br>
      <div class="my-auto text-center"> <span class="text-13" style="font-size: 70px;"><i class="fas fa-university"></i></span>
        <p class="badge bg-warning text-dark text-0 fw-500 rounded-pill px-2 mb-0">Primary</p>
      </div>
    </div>
    <div class="col-9 border-start">
<div class="py-4 my-2 ps-4">
                                @include('datatables.table_content')
                                
                       
                        </div>
    
                    </div>
                </div>
            </div>

          
@endsection

@section('page-js')
<script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>

@endsection

