@extends('layouts.master')
@section('page-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')
<div class="col-12 col-md-6">
  <div class="account-card account-card-primary text-white rounded hover-card">
    <div class="row g-0">
      <div class="col-3 d-flex justify-content-center p-3"><br>
        <div class="my-auto text-center"> <span class="text-13" style="font-size: 70px;"><i class="fas fa-university"></i></span>
          <p class="badge bg-warning text-dark text-0 fw-500 rounded-pill px-2 mb-0">{{ $bankDetail->account_title}}</p>
        </div>
      </div>
      <div class="col-9 border-start">
        <div class="py-4 my-2 ps-4">
          <p class="text-4 fw-500 mb-1">{{ $bankDetail->bank_name }}</p>
          <p class="text-4 opacity-9 mb-1">{{ $bankDetail->account_no}}</p>
          <p class="m-0">Approved <span class="text-3"><i class="fas fa-check-circle"></i></span></p>
        </div>
      </div>
    </div>
    <div class="account-card-overlay rounded">
      <a href="#" data-bs-target="#bank-account-details" data-bs-toggle="modal" class="text-light btn-link mx-2" onclick="showBankAccountModal()">
        <span class="me-1"><i class="fas fa-share"></i></span>More Details</a>
      <a href="#" class="text-light btn-link mx-2">
        <span class="me-1"><i class="fas fa-minus-circle"></i></span>Delete</a>
    </div>
  </div>
</div>
<br>
<div id="bank-account-details" class="modal fade" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row g-0">
          <div class="col-sm-4  justify-content-center" style="background-color: green;">
            <div class="my-auto text-center">
              <div class="text-17 text-white mb-3" style="font-size: 60px;"><i class="fas fa-university"></i></div>
              <h3 class="text-6 text-white my-3">{{ $bankDetail->bank_name }}</h3>
              <div class="text-4 text-white my-4">Branch Code: {{ $bankDetail->branch_code }}</div>
              <p class="badge bg-light text-dark text-0 fw-500 rounded-pill px-2 mb-0">{{ $bankDetail->account_title}}</p>
            </div>
          </div>
          <div class="col-sm-7">
            <button type="button" class="btn-close text-2 float-end" onclick="hideBankAccountModal()" aria-label="Close"></button>
            <h5 class="text-5 fw-400 m-3">Bank Account Details
            </h5>
            <hr>
            <div class="px-3 mb-3">
              <ul class="list-unstyled">
                <li class="fw-500">Account Name</li>
                <li class="text-muted">{{ $bankDetail->account_title}}</li>
              </ul>
              <ul class="list-unstyled">
                <li class="fw-500">Iban No</li>
                <li class="text-muted">{{ $bankDetail->iban_no}}</li>
              </ul>
              <ul class="list-unstyled">
                <li class="fw-500">Bank Address</li>
                <li class="text-muted">{{ $bankDetail->bank_address }}</li>
              </ul>
              <ul class="list-unstyled">
                <li class="fw-500">Status</li>
                <li class="text-muted">Approved <span class="text-success text-3"><i class="fas fa-check-circle"></i></span></li>
              </ul>
              <div class="d-grid"><a href="#" class="btn btn-sm btn-outline-danger shadow-none" onclick="hideBankAccountModal()"><span class="me-1"><i class="fas fa-minus-circle"></i></span>Delete Account</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function showEditCardModal() {
    $('#edit-card-details').modal('show');
  }

  function hideEditCardModal() {
    $('#edit-card-details').modal('hide');
  }

   function showAddCardModal() {
    $('#add-new-card-details').modal('show');
  }

  // Function to hide the Add Card modal
  function hideAddCardModal() {
    $('#add-new-card-details').modal('hide');
  }

  function showBankAccountModal() {
    $('#bank-account-details').modal('show');
  }

  function hideBankAccountModal() {
    $('#bank-account-details').modal('hide');
  }

  function showAddBankAccountModal() {
    $('#add-new-bank-account').modal('show');
  }

  // Function to hide the modal (if needed)
  function hideAddBankAccountModal() {
    $('#add-new-bank-account').modal('hide');
  }
           </script>
@endsection
@section('page-js')
<script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>

@endsection