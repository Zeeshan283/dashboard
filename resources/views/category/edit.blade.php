@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection

@section('main-content')

<h2>Edit Menu</h2>
<form action="{{ route('menu.update', ['id' => $edit->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Name</label>
             {!! Form::text('name', null, [
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
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Icon</label>
            <select name="icon" id="icon"
                class="form-control faselect fstdropdown-select @error('icon') is-invalid @enderror"
                required>
                <option value="">Select Icon</option>
                @for ($i = 0; $i < count($data); $i++)
                    <option value="{{ $data[$i]['name'] }}">{!! $data[$i]['code'] !!}
                        {{ $data[$i]['name'] }}</option>
                @endfor
            </select>
            @error('icon')
                <span class="invalid-feedback1 font-weight-bold">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Image (1100 x 450)</label>
            <input type="file" name="image" id="image" class="form-control" required>
            @error('image')
                <span class="invalid-feedback1 font-weight-bold">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
            <label>Image For App (100 x 100)</label>
            <input type="file" name="imageforapp" id="imageforapp" class="form-control" required>
            @error('imageforapp')
                <span class="invalid-feedback1 font-weight-bold">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <button type="submit">Update</button>
</form>
@endsection

@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
