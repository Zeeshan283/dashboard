@extends('layouts.master')
@section('before-css')
    {{-- css link sheet  --}}
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_dots.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@section('page-css')
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">

    <style>
        .image-container_1 {
            max-height: 400px;
            /* Set the maximum height you want for the images */
            overflow-y: auto;
            /* Add a vertical scrollbar if needed */
        }

        .img-thumbnail_1 {
            display: block;
            margin-bottom: 10px;
            /* Add some spacing between images */
        }
    </style>
@endsection
@endsection

@section('main-content')

<div class="breadcrumb">

    <h1>Seller Information</h1>

</div>
<div class="separator-breadcrumb border-top"></div>
<div class="col-md-12 mb-4">
    <div class="row">
        <div class="col-md-12" style="padding: 20px;">
            <!-- SmartWizard html -->

            <div id="smartwizard" class="sw-theme-dots">
                <ul style="justify-content: center;">
                    <li><a href="#step-1">Step 1<br /><small>Vendor Profile</small></a></li>
                    <li><a href="#step-2">Step 2<br /><small>Bank Details</small></a></li>
                    <li><a href="#step-3">Step 3<br /><small>Company Document</small></a></li>
                    <li><a href="#step-4">Step 4<br /><small>ID Card Image</small></a></li>
                    <li><a href="#step-5">Step 5<br /><small>Slider's</small></a></li>
                    <li><a href="#step-6">Step 6<br /><small>Porfolio's</small></a></li>
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
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header bg-transparent">
                                            <h3 class="card-title">Profile Info </h3>
                                        </div>
                                        <div class="form-group avatar">
                                            <figure class="figure col-md-2 col-sm-3 col-xs-12 ">
                                                {{-- <img class="img-rounded img-responsive" --}}



                                            </figure>

                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                {{-- {!! Form::hidden('user_id', $edit->user->id, ['id' => 'id', 'class' => 'form-control']) !!}
                                                        {!! Form::hidden('user_id', $edit->user->id, ['id' => 'id', 'class' => 'form-control']) !!} --}}


                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Company
                                                        Name:</label>
                                                    @if ($edit && isset($edit->company_name))
                                                        {!! Form::text('company_name', $edit->company_name, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('company_name', null, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>


                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">First Name:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('first_name', $edit->user->first_name, ['id' => 'first_name', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('first_name', null, ['id' => 'first_name', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Last Name:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('last_name', $edit->user->last_name, ['id' => 'last_name', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('last_name', null, ['id' => 'last_name', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Phone# 1</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('phone1', $edit->user->phone1, ['id' => 'phone1', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('phone1', null, ['id' => 'phone1', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Phone# 2:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('phone2', $edit->user->phone2, ['id' => 'phone2', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('phone2', null, ['id' => 'phone2', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Country:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('country', $edit->user->country, ['id' => 'country', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('country', null, ['id' => 'country', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>


                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">City:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('city', $edit->user->city, ['id' => 'city', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('city', null, ['id' => 'city', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Address:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('address1', $edit->user->address1, ['id' => 'address1', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('address1', null, ['id' => 'address1', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Address2:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('address2', $edit->user->address2, ['id' => 'address2', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('address2', null, ['id' => 'address2', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">NTN:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('ntn', $edit->user->ntn, ['id' => 'ntn', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('ntn', null, ['id' => 'ntn', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">STRN:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('strn', $edit->user->strn, ['id' => 'strn', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('strn', null, ['id' => 'strn', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Total
                                                        Employee:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('total_employees', $edit->user->total_employees, [
                                                            'id' => 'total_employees',
                                                            'class' => 'form-control',
                                                        ]) !!}
                                                    @else
                                                        {!! Form::text('total_employees', null, ['id' => 'total_employees', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Established
                                                        In:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('established_in', $edit->user->established_in, [
                                                            'id' => 'established_in',
                                                            'class' => 'form-control',
                                                        ]) !!}
                                                    @else
                                                        {!! Form::text('established_in', null, ['id' => 'established_in', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Main
                                                        Market:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('main_market', $edit->user->main_market, ['id' => 'main_market', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('main_market', null, ['id' => 'main_market', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Member
                                                        Since:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('member_since', $edit->user->member_since, ['id' => 'member_since', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('member_since', null, ['id' => 'member_since', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12"
                                                        class="ul-form__label">Certification:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('certifications', $edit->user->certifications, [
                                                            'id' => 'certifications',
                                                            'class' => 'form-control',
                                                        ]) !!}
                                                    @else
                                                        {!! Form::text('certifications', null, ['id' => 'certifications', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Website
                                                        Link:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('website_link', $edit->user->website_link, ['id' => 'website_link', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('website_link', null, ['id' => 'website_link', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Accept Payment
                                                        Type:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('accepted_payment_type', $edit->user->accepted_payment_type, [
                                                            'id' => 'accept_payment_type',
                                                            'class' => 'form-control',
                                                        ]) !!}
                                                    @else
                                                        {!! Form::text('accepted_payment_type', null, ['id' => 'accept_payment_type', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Major
                                                        Clients:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('major_clients', $edit->user->major_clients, [
                                                            'id' => 'major_clients',
                                                            'class' => 'form-control',
                                                        ]) !!}
                                                    @else
                                                        {!! Form::text('major_clients', null, ['id' => 'major_clients', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Annual
                                                        Export:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('annual_export', $edit->user->annual_export, [
                                                            'id' => 'annaul_export',
                                                            'class' => 'form-control',
                                                        ]) !!}
                                                    @else
                                                        {!! Form::text('annual_export', null, ['id' => 'annaul_export', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Annual
                                                        Import:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('annual_import', $edit->user->annual_import, [
                                                            'id' => 'annaul_import',
                                                            'class' => 'form-control',
                                                        ]) !!}
                                                    @else
                                                        {!! Form::text('annual_import', null, ['id' => 'annaul_import', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Annual
                                                        Revenue:</label>
                                                    @if ($edit && $edit->user)
                                                        {!! Form::text('annual_revenue', $edit->user->annual_revenue, [
                                                            'id' => 'annaul_revenue',
                                                            'class' => 'form-control',
                                                        ]) !!}
                                                    @else
                                                        {!! Form::text('annual_revenue', null, ['id' => 'annaul_revenue', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>


                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Logo:</label>

                                                    @if ($edit && isset($edit->logo))
                                                        <a href="{{ asset($edit->logo) }}" class="image-popup">
                                                            <img src="{{ asset($edit->logo) }}" class="img-thumbnail"
                                                                style="width:100px;height:100px;" />
                                                        </a>
                                                    @else
                                                        {{-- Handle the case where $edit is null or does not have a 'logo' property --}}
                                                        <p>No logo available</p>
                                                    @endif
                                                </div>

                                            </div>


                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="step-2" class="">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bankDetail as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->account_title }}</td>
                                            <td>{{ $value->account_no }}</td>
                                            <td>{{ $value->iban_no }}</td>
                                            <td>{{ $value->bank_name }}</td>
                                            <td>{{ $value->bank_address }}</td>
                                            <td>{{ $value->branch_code }}</td>

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
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div id="step-3" class="">
                        <div class="table-responsive">
                            <table id="deafult_ordering_table1" class="display table table-striped table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id#</th>
                                        <th>Document Name</th>
                                        <th>Document File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendordocument as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->document_name }}</td>
                                            <td>
                                                <div id="" style="display: flex;">
                                                    @if ($value->document_file)
                                                        @foreach (json_decode($value->document_file) as $file)
                                                            @if (Str::endsWith($file, '.pdf'))
                                                                {{-- Display PDF if it's a PDF file --}}
                                                                {{-- <embed src="{{ asset($file) }}" type="application/pdf" class="img-thumbnail"  style="width:100px;height:80px;" > --}}
                                                                <a href="{{ asset($file) }}" download>
                                                                    <embed src="{{ asset($file) }}"
                                                                        type="application/pdf" class="img-thumbnail"
                                                                        style="width:100px;height:80px;">
                                                                    <button type="button"
                                                                        class="btn  btn-outline-secondary ">
                                                                        <i class=" nav-icon i-Download"
                                                                            style="font-weight: bold;"></i>
                                                                    </button>
                                                                    <!-- You can replace 'path_to_pdf_icon_image.png' with an image of a PDF icon -->
                                                                </a>
                                                            @else
                                                                {{-- Display image if it's not a PDF file --}}

                                                                <a href="{{ asset($file) }}" class="image-popup">
                                                                    <img src="{{ asset($file) }}"
                                                                        class="img-thumbnail"
                                                                        style="width:100px;height:80px;" />
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <p>images is empty or null</p>
                                                    @endif


                                                </div>
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id#</th>
                                        <th>Document Name</th>
                                        <th>Document File</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div id="step-4" class="">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header bg-transparent">
                                            <h3 class="card-title">Become a Verified Supplier
                                                <span class="badge  badge-round-info md">
                                                    <p style="font-size: revert;">✓</p>
                                                </span>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div id="f_i_thumnails" class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Owner ID Card
                                                        Front:</label>
                                                    @if ($edit && $edit->id_front)
                                                        @if (Str::endsWith($edit->id_front, '.pdf'))
                                                            {{-- Display PDF if it's a PDF file --}}
                                                            {{-- <embed src="{{ asset($file) }}" type="application/pdf" class="img-thumbnail"  style="width:100px;height:80px;" > --}}
                                                            <a href="{{ asset($edit->id_front) }}" download>
                                                                <embed src="{{ asset($edit->id_front) }}"
                                                                    type="application/pdf" class="img-thumbnail"
                                                                    style="width:100px;height:80px;">
                                                                <button type="button"
                                                                    class="btn  btn-outline-secondary ">
                                                                    <i class=" nav-icon i-Download"
                                                                        style="font-weight: bold;"></i>
                                                                </button>
                                                                <!-- You can replace 'path_to_pdf_icon_image.png' with an image of a PDF icon -->
                                                            </a>
                                                        @else
                                                            {{-- Display image if it's not a PDF file --}}

                                                            <a href="{{ asset($edit->id_front) }}"
                                                                class="image-popup">
                                                                <img src="{{ asset($edit->id_front) }}"
                                                                    class="img-thumbnail"
                                                                    style="width:100px;height:80px;" />
                                                            </a>
                                                        @endif
                                                    @else
                                                        <h6>No Image</h6>
                                                    @endif
                                                </div>

                                                <div id="f_i_thumnails" class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Owner ID Card
                                                        Back:</label>
                                                    @if ($edit && $edit->id_back)
                                                        @if (Str::endsWith($edit->id_back, '.pdf'))
                                                            {{-- Display PDF if it's a PDF file --}}
                                                            {{-- <embed src="{{ asset($file) }}" type="application/pdf" class="img-thumbnail"  style="width:100px;height:80px;" > --}}
                                                            <a href="{{ asset($edit->id_back) }}" download>
                                                                <embed src="{{ asset($edit->id_back) }}"
                                                                    type="application/pdf" class="img-thumbnail"
                                                                    style="width:100px;height:80px;">
                                                                <button type="button"
                                                                    class="btn  btn-outline-secondary ">
                                                                    <i class=" nav-icon i-Download"
                                                                        style="font-weight: bold;"></i>
                                                                </button>
                                                                <!-- You can replace 'path_to_pdf_icon_image.png' with an image of a PDF icon -->
                                                            </a>
                                                        @else
                                                            {{-- Display image if it's not a PDF file --}}

                                                            <a href="{{ asset($edit->id_back) }}"
                                                                class="image-popup">
                                                                <img src="{{ asset($edit->id_back) }}"
                                                                    class="img-thumbnail"
                                                                    style="width:100px;height:80px;" />
                                                            </a>
                                                        @endif
                                                    @else
                                                        <h6>No Image</h6>
                                                    @endif


                                                </div>

                                                <div id="f_i_thumnails" class="form-group col-md-4">
                                                    <label for="inputtext11" class="ul-form__label">Trade
                                                        License:</label>

                                                    @if ($edit && $edit->trade_license)
                                                        @if (Str::endsWith($edit->trade_license, '.pdf'))
                                                            {{-- Display PDF if it's a PDF file --}}
                                                            {{-- <embed src="{{ asset($file) }}" type="application/pdf" class="img-thumbnail"  style="width:100px;height:80px;" > --}}
                                                            <a href="{{ asset($edit->trade_license) }}" download>
                                                                <embed src="{{ asset($edit->trade_license) }}"
                                                                    type="application/pdf" class="img-thumbnail"
                                                                    style="width:100px;height:80px;">
                                                                <button type="button"
                                                                    class="btn  btn-outline-secondary ">
                                                                    <i class=" nav-icon i-Download"
                                                                        style="font-weight: bold;"></i>
                                                                </button>
                                                                <!-- You can replace 'path_to_pdf_icon_image.png' with an image of a PDF icon -->
                                                            </a>
                                                        @else
                                                            {{-- Display image if it's not a PDF file --}}

                                                            <a href="{{ asset($edit->trade_license) }}"
                                                                class="image-popup">
                                                                <img src="{{ asset($edit->trade_license) }}"
                                                                    class="img-thumbnail"
                                                                    style="width:100px;height:80px;" />
                                                            </a>
                                                        @endif
                                                    @else
                                                        <h6>No Image</h6>
                                                    @endif

                                                </div>

                                            </div>
                                        </div>

                                        {{-- <hr> --}}



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="step-5" class="">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header bg-transparent">
                                            <h3 class="card-title">Slider Image's
                                                <span class="badge  badge-round-info md">
                                                    <p style="font-size: revert;">✓</p>
                                                </span>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div id="f_i_thumnails" class="form-group col-md-12 gap-10">
                                                    <div id="loopImg" class="" style="display: flex;">

                                                        @if (!empty($edit->slider_images))
                                                            @php
                                                                $decodedImages = json_decode($edit->slider_images);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $value)
                                                                    <a href="{{ asset($value) }}"
                                                                        style="margin: auto;" class="image-popup">
                                                                        <img src="{{ asset($value) }}"
                                                                            class="img-thumbnail "
                                                                            style="width:250px;height:130px;" />
                                                                    </a>
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $edit->slider_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="step-6" class="">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header bg-transparent">
                                            <h3 class="card-title">Porfolio Image's
                                                <span class="badge  badge-round-info md">
                                                    <p style="font-size: revert;">✓</p>
                                                </span>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Category
                                                        1:</label>
                                                    @if ($edit && isset($edit->p_category1))
                                                        {!! Form::text('p_category1', $edit->p_category1, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('p_category1', null, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>
                                                <div id="f_i_thumnails" class="form-group  gap-10">
                                                    <div id="loopImg" class="gap-10">

                                                        @if (!empty($edit->p_c1_images))
                                                            @php
                                                                $decodedImages = json_decode($edit->p_c1_images);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $value)
                                                                    <a href="{{ asset($value) }}"
                                                                        style="margin: auto;" class="image-popup">
                                                                        <img src="{{ asset($value) }}"
                                                                            class="img-thumbnail "
                                                                            style="width:250px;height:130px;" />
                                                                    </a>
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $edit->p_c1_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Category
                                                        2:</label>
                                                    @if ($edit && isset($edit->p_category2))
                                                        {!! Form::text('p_category1', $edit->p_category2, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('p_category1', null, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>
                                                <div id="f_i_thumnails" class="form-group  gap-10">
                                                    <div id="loopImg" class="gap-10">

                                                        @if (!empty($edit->p_c2_images))
                                                            @php
                                                                $decodedImages = json_decode($edit->p_c2_images);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $value)
                                                                    <a href="{{ asset($value) }}"
                                                                        style="margin: auto;" class="image-popup">
                                                                        <img src="{{ asset($value) }}"
                                                                            class="img-thumbnail "
                                                                            style="width:250px;height:130px;" />
                                                                    </a>
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $edit->p_c1_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Category
                                                        3:</label>
                                                    @if ($edit && isset($edit->p_category3))
                                                        {!! Form::text('p_category3', $edit->p_category3, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('p_category3', null, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>
                                                <div id="f_i_thumnails" class="form-group  gap-10">
                                                    <div id="loopImg" class="gap-10">

                                                        @if (!empty($edit->p_c3_images))
                                                            @php
                                                                $decodedImages = json_decode($edit->p_c3_images);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $value)
                                                                    <a href="{{ asset($value) }}"
                                                                        style="margin: auto;" class="image-popup">
                                                                        <img src="{{ asset($value) }}"
                                                                            class="img-thumbnail "
                                                                            style="width:250px;height:130px;" />
                                                                    </a>
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $edit->p_c1_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Category
                                                        4:</label>
                                                    @if ($edit && isset($edit->p_category4))
                                                        {!! Form::text('p_category4', $edit->p_category4, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('p_category4', null, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>
                                                <div id="f_i_thumnails" class="form-group  gap-10">
                                                    <div id="loopImg" class="gap-10">

                                                        @if (!empty($edit->p_c4_images))
                                                            @php
                                                                $decodedImages = json_decode($edit->p_c4_images);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $value)
                                                                    <a href="{{ asset($value) }}"
                                                                        style="margin: auto;" class="image-popup">
                                                                        <img src="{{ asset($value) }}"
                                                                            class="img-thumbnail "
                                                                            style="width:250px;height:130px;" />
                                                                    </a>
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $edit->p_c1_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail12" class="ul-form__label">Category
                                                        5:</label>
                                                    @if ($edit && isset($edit->p_category5))
                                                        {!! Form::text('p_category5', $edit->p_category5, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                    @else
                                                        {!! Form::text('p_category5', null, ['id' => 'company_name', 'class' => 'form-control']) !!}
                                                    @endif
                                                </div>
                                                <div id="f_i_thumnails" class="form-group  gap-10">
                                                    <div id="loopImg" class="gap-10">

                                                        @if (!empty($edit->p_c5_images))
                                                            @php
                                                                $decodedImages = json_decode($edit->p_c5_images);
                                                            @endphp

                                                            @if ($decodedImages !== null)
                                                                @foreach ($decodedImages as $key => $value)
                                                                    <a href="{{ asset($value) }}"
                                                                        style="margin: auto;" class="image-popup">
                                                                        <img src="{{ asset($value) }}"
                                                                            class="img-thumbnail "
                                                                            style="width:250px;height:130px;" />
                                                                    </a>
                                                                    {{-- <span class="delete-icon" data-image-index="{{ $key }}">Delete</span> --}}
                                                                @endforeach
                                                            @else
                                                                <p>Invalid JSON data in $edit->p_c1_images</p>
                                                            @endif
                                                        @else
                                                            <p>images is empty or null</p>
                                                        @endif
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
    </div>
</div>

@endsection



@section('page-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/vendor/jquery.smartWizard.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#smartwizard').smartWizard({
            selected: 0, // Initial step
            keyNavigation: false, // Enable keyboard navigation
            autoAdjustHeight: false,
        });

    });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="{{ asset('assets/js/vendor/quill.min.js') }}"></script>



<script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
@if ($errors->any())
    <script>
        toastr.error("{{ $errors->first() }}");
    </script>
@endif
{!! Toastr::message() !!}

<!-- Include jQuery -->

<!-- Include a lightbox library (e.g., Magnific Popup) for the pop-up effect -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<!-- Add a JavaScript function to initialize the pop-up -->
<script>
    $(document).ready(function() {
        $('.image-popup').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    });
</script>
@endsection

@section('bottom-js')
<script src="{{ asset('assets/js/smart.wizard.script.js') }}"></script>
<script src="{{ asset('assets/js/quill.script.js') }}"></script>


<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
