@extends('layouts.master')
 @section('before-css')
 <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">

@endsection

@section('main-content')

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title text-center"> Edit User</h3>
                                </div>
        <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
            <div class="form-group col-md-4">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
            </div>
            <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
            </div>
            <div class="form-group col-md-4">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
            </div>
            <div class="form-group col-md-4">
                <label for="country">Country</label>
                <input type="text" name="country" id="country" class="form-control" value="{{ $user->country }}">
            </div>
            <div class="form-group col-md-4">
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" value="{{ $user->city }}">
            </div>
            <div class="form-group col-md-4">
                <label for="addres">Address</label>
                <input type="text" name="addres" id="addres" class="form-control" value="{{ $user->addres }}">
            </div>
            <div class="form-group col-md-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="male" {{ $user->status === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $user->status === 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
