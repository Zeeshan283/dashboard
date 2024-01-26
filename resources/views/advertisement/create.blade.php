@extends('layouts.master')

@section('style')
@endsection
@section('main-content')
    <div class="page-body">
        <div class="breadcrumb">
            <div class="col-md-6">
                <h1>Advertisement Management's</h1>
            </div>
        </div>
        <br>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add Advertisement</h5>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" method="POST" action="{{ route('advertisements.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="make" value="{{ Auth::user()->name }}">
                                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                <div class="row product-adding">
                                    <div class="col-xl-5">
                                        <div class="add-product">
                                            <div class="row">
                                                <div class="">
                                                    <img src="{{ asset('assets/images/products/weather-2.jpg') }}" loading="lazy"
                                                        id="show_image" alt="" width="80%"
                                                        class="img-fluid image_zoom_1 blur-up lazyloaded"
                                                        onclick="document.getElementById('imageshow').click()">
                                                    <input class="upload d-none" type="file" name="image"
                                                        id="imageshow" required><i class="fa fa-plus"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7">
                                        <span class="needs-validation add-product-form" novalidate="">
                                            <div class="form">
                                                <div class="form-group mb-3  row">
                                                    <div class="col-xl-2 col-sm-4 mb-0">
                                                        <label for="validationCustom01" class="">Title
                                                            :</label>
                                                    </div>
                                                    <div class="col-xl-8 col-sm-7">
                                                        <input class="form-control " id="validationCustom01" type="text"
                                                            required="" name="name">
                                                        {{-- <div class="valid-feedback">Looks good!</div> --}}
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <div class="col-xl-2 col-sm-4 mb-0">
                                                        <label for="validationCustom02" class="ul-form__label">Old Price
                                                            :</label>
                                                    </div>
                                                    <div class="col-xl-8 col-sm-7">
                                                        <input class="form-control " name="old_price"
                                                            id="validationCustom02" type="text" required=""
                                                            placeholder="100"
                                                            onkeypress="return onlyDecimalNumberKey(event)">
                                                        {{-- <div class="valid-feedback">Looks good!</div> --}}
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <div class="col-xl-2 col-sm-4 mb-0">
                                                        <label for="validationCustom02" class="ul-form__label">Sale Price
                                                            :</label>
                                                    </div>
                                                    <div class="col-xl-8 col-sm-7">
                                                        <input class="form-control" name="sale_price"
                                                            id="validationCustom02" type="text" required=""
                                                            placeholder="99"
                                                            onkeypress="return onlyDecimalNumberKey(event)">
                                                        {{-- <div class="valid-feedback">Looks good!</div> --}}
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <div class="col-xl-2 col-sm-4 mb-0">
                                                        <label for="validationCustomUsername" class="ul-form__label">Days
                                                            :</label>
                                                    </div>

                                                    <div class="col-xl-8 col-sm-7">
                                                        <input class="form-control" name="days"
                                                            id="validationCustomUsername" type="text" required=""
                                                            onkeypress="return onlyNumberKey(event)">
                                                        {{-- <div class="invalid-feedback offset-sm-4 offset-xl-3">Please choose
                                                            Valid Code.</div> --}}
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <div class="col-xl-2 col-sm-4 mb-0">
                                                        <label for="validationCustomUsername" class="ul-form__label">Image
                                                            Dim
                                                            :</label>
                                                    </div>

                                                    <div class="col-xl-8 col-sm-7">
                                                        <input class="form-control" name="imageDimention"
                                                            id="validationCustomUsername" placeholder="350 X 300"
                                                            type="text" required="">
                                                        {{-- <div class="invalid-feedback offset-sm-4 offset-xl-3">Please choose
                                                            Valid Code.</div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form">
                                                <div class="form-group row">
                                                    <div class="col-xl-2 col-sm-4 mb-0">
                                                        <label class="ul-form__label">Quantity :</label>
                                                    </div>
                                                    <div class=" col-xl-2 col-sm-7 ">

                                                        <div class="qty-box">
                                                            <div class="input-group">
                                                                <input class="qty-adj form-control" name="quantity"
                                                                    required type="text" value="1"
                                                                    onkeypress="return onlyNumberKey(event)" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </span>
                                    </div>
                                </div>
                                <div class="row product-adding">
                                    <div class="col-xl-12">

                                        <div class="form-group col-md-12">
                                            <label for="inputtext11" class="ul-form__label">Add Details :<span
                                                    style="color: red;">*</span></label>
                                            <textarea id="details12" name="details"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row product-adding">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-light">Discard</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

    </div>
    <script src="https://cdn.tiny.cloud/1/j93evmvpkl9x9azhqkcx9436oknslp5bxmxurqkz2d1nm24j/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: "textarea#details12",
            relative_urls: false,
            paste_data_images: true,
            image_title: true,
            automatic_uploads: true,
            // images_upload_url: '/post/image/upload',
            // images_upload_url: '{{ asset('upload') }}',
            images_upload_url: '{{ URL::to('/uploads3') }}',
            file_picker_types: "image",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            // override default upload handler to simulate successful upload
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement("input");
                input.setAttribute("type", "file");
                input.setAttribute("accept", "image/*");
                input.onchange = function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function() {
                        var id = "blobid" + new Date().getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(",")[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                };
                input.click();
            }
        });
    </script>
@endsection
