@extends('layouts.master')
@section('before-css')

@endsection
@section('main-content')
            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title text-center">Edit</h3>
                                </div>
        
                        {!! Form::model($data, [
                            'method' => 'PATCH',
                            'action' => ['App\Http\Controllers\PaymentController@update', $data->id],
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
            <div class="card-body">
                <div class="row">
            <div class="form-group col-md-4">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}">
            </div>
            
                </div>
            </div>
            <div style="
    text-align: center;
">
            <button type="submit" class="btn btn-outline-secondary ">Update</button>
</div>
            
        {!! Form::close() !!}
    </div>
@endsection
@section('page-js')
    <script src="{{ URL::asset('website-assets/js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}
@endsection
