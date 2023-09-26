@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection

@section('main-content')

<h2>Edit Category</h2>
<form action="{{ route('category.update', ['id' => $edit->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">

        <div class="row">

            <div class="form-group col-md-6">
                <label for="inputtext11" class="ul-form__label">Choose Menu:</label>
                <select class="form-control" id="customer_id" name="menu_id" data-live-search="true">
                    <option value="" selected disabled>{{ $cat_name->name}}</option>
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
                <input type="text" class="form-control" id="name"  name="name"  placeholder="Enter category name" value="{{ $edit->name}}">
                <span style="color: red">@error('name'){{ $message }}@enderror</span>
                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                    Name
                </small>
            </div>
            <div class="form-group col-md-6">
                <label for="inputtext11" class="ul-form__label">Commision:</label>
                <input type="number" class="form-control" id="commission" name="commission"  placeholder="Commission" value="{{ $edit->commission}}">
                <span style="color: red">@error('commision'){{ $message }}@enderror</span>
                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                    Commission
                </small>
            </div>



            <div class="form-group col-md-6">
                <label for="inputEmail16" class="ul-form__label">Category Image:</label>
                <div class="input-right-icon">
                    <input type="file" class="form-control" id="imageInput"  name="img">
                    <img id="imagePreviewDesktop" src="{{ asset($edit->img) }}" alt="Image Description" style="max-width: 100px; max-height: 100px;">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail16" class="ul-form__label">Category App Image:</label>
                <div class="input-right-icon">
                    <input type="file" class="form-control" id="inputEmail16" name="imageforapp" value="{{ asset($edit->imageforapp) }}">
                    <img id="imagePreviewMobile" src="{{ asset($edit->imageforapp) }}" alt="Image Description" style="max-width: 100px; max-height: 100px;">
                </div>
            </div>
    </div>
    <button type="submit" class="btn btn-outline-secondary">Update</button>
</form>
@endsection

@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
<script>
    // Get references to the input and image elements for the desktop image
    const imageInputDesktop = document.getElementById('imageInput');
    const imagePreviewDesktop = document.getElementById('imagePreviewDesktop');

    // Add an event listener to the desktop file input
    imageInputDesktop.addEventListener('change', function () {
        // Check if a file is selected
        if (imageInputDesktop.files && imageInputDesktop.files[0]) {
            const reader = new FileReader();

            // When the file is loaded, set the desktop image source to the loaded data
            reader.onload = function (e) {
                imagePreviewDesktop.src = e.target.result;
            };

            // Read the selected file as a data URL (base64)
            reader.readAsDataURL(imageInputDesktop.files[0]);
        }
    });

    // Get references to the input and image elements for the mobile image
    const imageInputMobile = document.getElementById('inputEmail16');
    const imagePreviewMobile = document.getElementById('imagePreviewMobile');

    // Add an event listener to the mobile file input
    imageInputMobile.addEventListener('change', function () {
        // Check if a file is selected
        if (imageInputMobile.files && imageInputMobile.files[0]) {
            const reader = new FileReader();

            // When the file is loaded, set the mobile image source to the loaded data
            reader.onload = function (e) {
                imagePreviewMobile.src = e.target.result;
            };

            // Read the selected file as a data URL (base64)
            reader.readAsDataURL(imageInputMobile.files[0]);
        }
    });
</script>


@endsection

