@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')
 

   

    <div class="breadcrumb">
        <div class="col-md-6">
            <h1>FAQ's</h1>
        </div>
        <div class="col-md-6" style="text-align: right;  margin-left: auto;">
            <a href="{{ route('faqs.create') }}"><button class="btn btn-outline-secondary  ladda-button example-button m-1"
                    data-style="expand-left"><span class="ladda-label">Create</span></button></a>

        </div>
    </div>

    </div>

    <div class="separator-breadcrumb border-top"></div>
    <div class="row mt-4 mb-4">

        <div class="col-lg-12 col-xl-12 mt-3 mb-3">

            <div class="card">
                <div class="card-body">
                    <div class="accordion" id="accordionRightIcon">
                        @foreach ($data as $key => $value)
                        <div class="card ul-card__v-space">
                            <div class="card-header header-elements-inline">
                                <h6 class="card-title ul-collapse__icon--size ul-collapse__right-icon mb-0">
                                    <a data-toggle="collapse" class="text-default collapsed"
                                        href="#accordion-item-icon-right-{{ $key }}" aria-expanded="false">{{$value->question}}</a>
                                </h6>

                            </div>



                            <div id="accordion-item-icon-right-{{ $key }}" class="collapse" data-parent="#accordionRightIcon"
                                style="">
                                <div class="card-body">
                                    {{$value->answer}}
                                </div>
                            </div>
                        </div>
                        @endforeach

                         
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-js')
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
