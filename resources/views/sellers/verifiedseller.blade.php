
@extends('layouts.master')
@section('before-css')
{{-- css link sheet  --}}
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_dots.min.css')}}">
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@section('page-css')
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">

<style>
    .image-container_1 {
    max-height: 400px; /* Set the maximum height you want for the images */
    overflow-y: auto; /* Add a vertical scrollbar if needed */
}

.img-thumbnail_1 {
    display: block;
    margin-bottom: 10px; /* Add some spacing between images */
}

</style>
@endsection
@endsection

@section('main-content')

<div class="breadcrumb">
 
                <h1>Seller Verification Management's</h1>
                @if (count($errors) > 0)
                    <div class="alert alert-danger d-flex">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
            <div class="row">
                <div class="col-md-12" style="padding: 20px;">
                    <!-- SmartWizard html -->
                    
                    <div id="smartwizard" class="sw-theme-dots" >
                        <ul style="justify-content: center;">
                            <li><a href="#step-1">Step 1<br /><small>Bank Details</small></a></li>
                            <li><a href="#step-2">Step 2<br /><small>ID Card Image</small></a></li>
                            <li><a href="#step-3">Step 3<br /><small>Company Document</small></a></li>
                            {{-- <li><a href="#step-4">Step 4<br /><small>Tax Charges</small></a></li> --}}
                        </ul>
                            
                        <span>
                            <div class="btn-toolbar sw-toolbar sw-toolbar-top justify-content-end">
                            <div class="btn-group me-2 sw-btn-group" role="group">
                                <button class="btn btn-secondary sw-btn-prev disabled" type="button">Previous</button>
                                <button class="btn btn-secondary sw-btn-next" type="button">Next</button>
                            </div>
                            <div class="btn-group me-2 sw-btn-group-extra" role="group">
                            </div>
                            </div>
                        </span>

                        <div>
                <div id="step-1" class="">
                    {!! Form::model($edit, [
                    'method' => 'POST',
                    'action' => ['App\Http\Controllers\VendorsController@trustedSellerSave', $edit->id],
                    'class' => 'form-horizontal',
                    'files' => 'true',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header bg-transparent">
                                            <h3 class="card-title">Become a Trusted Supplier 
                                             
                                                <span class="badge  badge-round-success md"><p style="font-size: revert;">✓</p></span></h3>
                                             
                                        </div>
                                        

                                            <div class="card-body">
                                                <div class="row">
                                                        {!! Form::hidden('vendor_profile_id', $edit->id, ['id' => 'id', 'class' => 'form-control']) !!}
                                                        {!! Form::hidden('vendor_id', $edit->vendor_id, ['id' => 'id', 'class' => 'form-control']) !!}


                                                    <div class="form-group col-md-4">
                                                        <label for="inputtext11" class="ul-form__label">Account Title:</label>
                                                        {!! Form::text('account_title',null, ['id' => 'account_title', 'class' => 'form-control']) !!}

                                                    </div>
            
                                                    <div class="form-group col-md-4">
                                                        <label for="inputtext11" class="ul-form__label">Account No:</label>
                                                        {!! Form::text('account_no', null, ['id' => 'account_no', 'class' => 'form-control']) !!}
                                                    </div>
            
                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">IBAN No</label>
                                                        {!! Form::text('iban_no', null,  ['id' => 'iban_no', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Bank Name:</label>
                                                        {!! Form::text('bank_name', null,  ['id' => 'bank_name', 'class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Bank Address:</label>
                                                        {!! Form::text('bank_address',null,  ['id' => 'bank_address', 'class' => 'form-control']) !!}
                                                    </div>
                    

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail12" class="ul-form__label">Branch Code:</label>
                                                        {!! Form::text('branch_code',null,  ['id' => 'branch_code', 'class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="form-group"style="text-align: center;">
                                                        <div class="">
                                                            <input class="btn btn-outline-secondary" type="submit" value="Submit">
                                                        </div>
                                                    </div>

                                                </div>
                                                {!! Form::close() !!}

<div class="table-responsive">
        <table id="deafult_ordering_table" class="display table table-striped table-bordered"
                                style="width:100%">
                <thead>
                    <tr>
                        <th>Id#</th>
                        <th>Account Title</th>
                        <th>Account No</th>
                        <th>IBAN No</th>
                        <th>Bank Name</th>
                        <th>Bank Address</th>
                        <th>Branch Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bankDetail as $key => $value)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$value->account_title}}</td>
                        <td>{{$value->account_no}}</td>
                        <td>{{$value->iban_no}}</td>
                        <td>{{$value->bank_name}}</td>
                        <td>{{$value->bank_address}}</td>
                        <td>{{$value->branch_code}}</td>
                        <td><div>
                            <a href="{{URL::to('bank/'. $value->id. '/delete')}}">
                                            <button type="button" class="btn btn-outline-danger">
                                                <i class="nav-icon i-Remove-Basket"></i>
                                            </button>
                                            </a>
                        </div></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id#</th>
                        <th>Account Title</th>
                        <th>Account No</th>
                        <th>IBAN No</th>
                        <th>Bank Name</th>
                        <th>Bank Address</th>
                        <th>Branch Code</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div id="step-2" class="">
                    {!! Form::model($edit, [
                        'method' => 'PATCH',
                        'action' => ['App\Http\Controllers\VendorsController@verifiedSellerSave', $edit->id],
                        'class' => 'form-horizontal',
                        'files' => 'true',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title">Become a Verified Supplier  
                                        
                                        <span class="badge  badge-round-info md"><p style="font-size: revert;">✓</p></span></h3>
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <label for="inputtext11" class="ul-form__label">Owner ID Card Front:</label>
                                                <input type="file" name="id_front" class="form-control">
                                            
                                            </div>
                                            <div id="f_i_thumnails" class="form-group col-md-1">
                                            @if($edit->id_front)
                                            <img src="{{ asset($edit->id_front) }}" class="" style="width:100px;height:80px;">
                                            @else
                                            <h6>No Image</h6>
                                            @endif
                                            </div>
                                            
    
                                            <div class="form-group col-md-3">
                                                <label for="inputtext11" class="ul-form__label">Owner ID Card Back:</label>
                                                <input type="file" name="id_back" class="form-control">
                                            </div>
                                            <div id="f_i_thumnails" class="form-group col-md-1">
                                            @if($edit->id_back)
                                            <img src="{{ asset($edit->id_back) }}" class="" style="width:100px;height:80px;">
                                            @else
                                            <h6>No Image</h6>
                                            @endif
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="inputtext11" class="ul-form__label">Trade License:</label>
                                                <input type="file" name="trade_license" class="form-control">
                                            </div>
                                            <div id="f_i_thumnails" class="form-group col-md-1">
                                            @if($edit->trade_license)
                                            <img src="{{ asset($edit->trade_license) }}" class="" style="width:100px;height:80px;">
                                            @else
                                            <h6>No Image</h6>
                                            @endif
                                            </div>
    
                                            <div class="form-group " style="margin-top: 20px;text-align:right;">
                                                
                                                    <input class="btn btn-outline-secondary" type="submit" value="Update">
                                                
                                            </div>
                                        </div>
                                    </div>
                                                                {!! Form::close() !!}

                        {{-- <hr> --}}
                        


                            </div>
                        </div>
                    </div>
                </div>
                            </div>

            <div id="step-3" class="">
                        {!! Form::model($edit, [
                        'method' => 'POST',
                        'action' => ['App\Http\Controllers\VendorsController@SellerDocumentSave', $edit->id],
                        'class' => 'form-horizontal',
                        'files' => 'true',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title">Become a Verified Supplier  
                                        {{-- @if( !$edit->id_front == '' && !$edit->id_back == '') --}}
                                        <span class="badge  badge-round-info md"><p style="font-size: revert;">✓</p></span></h3>
                                        {{-- @endif --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            {!! Form::hidden('vendor_profile_id', $edit->id, ['id' => 'id', 'class' => 'form-control']) !!}
                                            {!! Form::hidden('vendor_id', $edit->vendor_id, ['id' => 'id', 'class' => 'form-control']) !!}

                                            <div class="form-group col-md-4">
                                                <label for="inputtext11" class="ul-form__label">Document Name:</label>
                                                <input type="text" name="document_name" class="form-control">
                                            
                                            </div>
                                            

                                            <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Registration Document:</label>
                                                    
                                                    <input type="file" name="document_file[]" id="imageInput"  class="form-control" multiple >
                                                    <button type="button" class="d-none form-control" style="width: auto;"id="chooseImages">Choose Images</button>
                                                        
                                                </div>
                                                   

                                                <div class="form-group col-md-4"style="margin-top: auto;">
                                                    
                                                <div class="">
                                                    <input class="btn btn-outline-secondary" type="submit" value="Add Document">
                                                </div>
                                                </div>
                                                <div class="form-group col-md-8">
                                                    
                                                    <div id="thumbnails"></div>
                                                    <div id="fileLimitMessage" style="color: red;"></div>
                                                </div>

                                                <script>
                                                document.getElementById('chooseImages').addEventListener('click', function () {
                                                    document.getElementById('imageInput').click();
                                                    
                                                });
                                            
                                                document.getElementById('imageInput').addEventListener('change', function () {
                                                    
                                                    var RemoveImg = document.getElementById('loopImg');
                                                    if (RemoveImg) {
                                                        RemoveImg.style.display = 'none';
                                                    }

                                                    var files = this.files;
                                                    var maxImages = 6; // Set your maximum image limit here
                                                    var fileLimitMessage = document.getElementById('fileLimitMessage');
                                                    if (files.length > maxImages) {
                                                        fileLimitMessage.textContent = 'Please select a maximum of ' + maxImages + ' files.';
                                                        this.value = ''; // Clear selected files
                                                    } else {
                                                        fileLimitMessage.textContent = ''; // Clear the message if within the limit
                                                    }
                                                });
                                                document.getElementById('imageInput').addEventListener('change', function () {
                                                    
                                                    var thumbnails = document.getElementById('thumbnails');
                                                    thumbnails.innerHTML = ''; // Clear previous thumbnails
                                            
                                                    var files = this.files;
                                                var maxImages = 6; // Set your maximum image limit here
                                                for (var i = 0; i < Math.min(files.length, maxImages); i++) {
                                                    var img = document.createElement('img');
                                                    img.src = URL.createObjectURL(files[i]);
                                                    img.style.maxWidth = '100px';
                                                    thumbnails.appendChild(img);
                                                }
                                            
                                                    // Show the upload button when at least one image is selected
                                                    
                                                });
                                            </script>
    
                                            
                                        </div>
                                                                {!! Form::close() !!}
<br>
<br>
<div class="table-responsive">
        <table id="deafult_ordering_table1" class="display table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Id#</th>
                        <th>Document Name</th>
                        <th>Document File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendordocument as $key => $value)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$value->document_name}}</td>
                        <td>
                        <div id="" style="display: flex;">
                            @if ($value->document_file)
                        @foreach (json_decode($value->document_file) as $file)
                            @if (Str::endsWith($file, '.pdf'))
                                {{-- Display PDF if it's a PDF file --}}
                                <embed src="{{ asset($file) }}" type="application/pdf" class="img-thumbnail"  style="width:100px;height:80px;" >
                                    
                                    @else
                                {{-- Display image if it's not a PDF file --}}
                                <img src="{{ asset($file) }}" class="img-thumbnail" style="width:100px;height:80px;" />
                            @endif
                        @endforeach
                        @else
                            <p>images is empty or null</p>
                        @endif

                        
                        </div>
                        </td>
                        
                        <td>
                            <a href="{{URL::to('vendor_document/'. $value->id. '/delete')}}">
                                            <button type="button" class="btn btn-outline-danger">
                                                <i class="nav-icon i-Remove-Basket"></i>
                                            </button>
                                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id#</th>
                        <th>Document Name</th>
                        <th>Document File</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
</div>
                                    </div>


                            </div>
                        </div>
                    </div>
                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
        </div>

@endsection



@section('page-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('assets/js/vendor/jquery.smartWizard.min.js')}}"></script>

<script>
    $(document).ready(function () {
        $('#smartwizard').smartWizard({
            selected: 0,  // Initial step
            keyNavigation: false, // Enable keyboard navigation
            autoAdjustHeight: false,
        });
        
    });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="{{asset('assets/js/vendor/quill.min.js')}}"></script>



    <script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
     @if ($errors->any())
    <script>
        toastr.error("{{ $errors->first() }}");
    </script>
    @endif
    {!! Toastr::message() !!}

@endsection

@section('bottom-js')


<script src="{{asset('assets/js/smart.wizard.script.js')}}"></script>
<script src="{{asset('assets/js/quill.script.js')}}"></script>

<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
