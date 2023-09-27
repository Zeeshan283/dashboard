@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection

@section('main-content')

<h2>Edit Menu</h2>
<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('menu.update', ['id' => $edit->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="form-group">
                        <label>Name</label>
                        {!! Form::text('name', old('name', $edit->name), [
                            'id' => 'name',
                            'class' => 'form-control',
                            'autofocus' => 'autofocus',
                            'required' => 'required',
                        ]) !!}
                        @error('name')
                            <span class="invalid-feedback1 font-weight-bold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="form-group">
                        <label>Icon</label>
                        <select name="icon" id="icon"
                            class="form-control faselect fstdropdown-select @error('icon') is-invalid @enderror"
                            required>
                            <option value="">Select Icon</option>
                            @for ($i = 0; $i < count($data); $i++)
                                <option value="{{ $data[$i]['name'] }}" @if(old('icon', $edit->icon) == $data[$i]['name']) selected @endif>{!! $data[$i]['code'] !!}
                                    {{ $data[$i]['name'] }}</option>
                            @endfor
                        </select>
                        @error('icon')
                            <span class="invalid-feedback1 font-weight-bold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12" style="margin-top: auto">
                    <div class="form-group" >
                        <button class="btn btn-outline-secondary" type="submit">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
