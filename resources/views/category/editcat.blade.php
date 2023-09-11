@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection

@section('main-content')

<h2>Edit Menu</h2>
<form action="{{ route('category.update', ['id' => $edit->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">

        <div class="row">

            <div class="form-group col-md-6">
                <label for="inputtext11" class="ul-form__label">Choose Menu:</label>
                <select class="form-control" id="customer_id" name="menu_id" data-live-search="true">
                    <option value="" selected disabled>Select Menu</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id}}"->{{ $menu->name}}</option>
                    @endforeach
                </select>
                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                    Please enter category name
                </small>
            </div>

            <div class="form-group col-md-6">
                <label for="inputtext11" class="ul-form__label">Name:</label>
                <input type="text" class="form-control" id="name"  name="name"  placeholder="Enter category name" value="{{ old ('name')}}">
                <span style="color: red">@error('name'){{ $message }}@enderror</span>
                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                    Name
                </small>
            </div>
            <div class="form-group col-md-6">
                <label for="inputtext11" class="ul-form__label">Commision:</label>
                <input type="number" class="form-control" id="commission" name="commission"  placeholder="Commission" value="{{ old ('number')}}">
                <span style="color: red">@error('commision'){{ $message }}@enderror</span>
                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                    Commission
                </small>
            </div>



            <div class="form-group col-md-6">
                <label for="inputEmail16" class="ul-form__label">Category Image:</label>
                <div class="input-right-icon">
                    <input type="file" class="form-control" id="inputEmail16"  name="img" >
                    </span>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail16" class="ul-form__label">Category App Image:</label>
                <div class="input-right-icon">
                    <input type="file" class="form-control" id="inputEmail16"  name="imageforapp" >
                    </span>
                </div>
            </div>
    </div>
    <button type="submit">Update</button>
</form>
@endsection

@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
