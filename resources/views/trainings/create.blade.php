@extends('layouts.master')
@section('before-css')
    {{-- css link sheet  --}}
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_dots.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/choices.min.css') }}">
    <style>
        .thumbnail {
            max-width: auto;
            max-height: 100px;
            margin: 5px;
        }

        .choices__input {
            background: #f3f4f6;
        }


        .choices_list--multiple .choices_item {
            /* width: 3%; */
            font-size: 14px;
            font-family: initial;
            /* background-color: #6b7280; */
            /* background-color: #e9ecef; */
            color: black;
            border-radius: 42px;
            /* height: 28px; */
            border: transparent;
        }

        .choices[data-type*=select-multiple] .choices__button {
            border-left: white;
            display: none;
        }
    </style>
@endsection

@endsection


@section('main-content')
<div class="breadcrumb">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <h1>Training Page </h1>
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

            <div id="smartwizard" class="sw-theme-dots">
                <ul style="justify-content: center;">
                    <li><a href="#step-1">Step 1<br /><small>Post Details</small></a></li>
                    <li><a href="#step-2">Step 2<br /><small>Training Details</small></a></li>
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
                    <div id="step-2" class="">
                        <div class="card-body">
                            <form method="post" action="{{ route('trainings.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card mb-4">
                                    <h5 class="card-header text-left">Course Features</h5>
                                    <hr class="my-0" />
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group ml-6">
                                                    <label for="inputtext11" class="form-label">Instructor:</label>
                                                    <select class="form-control" id="intructor_id" name="intructor_id">
                                                        @foreach ($instructor as $value)
                                                            <option value="{{ $value->id ?? null }}">
                                                                {{ $value->name ?? null }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="lectures" class="form-label">Lectures</label>
                                                    <input type="text" class="form-control" id="lectures"
                                                        placeholder="Total lectures" name="lectures" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="duration" class="form-label">Duration(hrs)</label>
                                                    <!-- <input type="text" class="form-control" id="duration" placeholder="duration" name="duration" required> -->
                                                    <select class="form-select" id="duration" name="duration">
                                                        <option value=""> --- Please Select --- </option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="skilllevel" class="form-label">Skill Level</label>
                                                    <select class="form-select" id="skilllevel" name="skilllevel">
                                                        <option value=""> Please Select </option>
                                                        <option>Basic Level</option>
                                                        <option>Intermediate</option>
                                                        <option>Expert Level</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="language" class="form-label">Languages</label>
                                                    <select class="form-select" id="language" name="language">
                                                        <option value=""> --- Please Select --- </option>
                                                        <option>English</option>
                                                        <option>Urdu</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="coursetype" class="form-label">Course Type</label>
                                                    <!-- <input type="text" class="form-control" id="duration" placeholder="duration" name="duration" required> -->
                                                    <select class="form-select" id="coursetype" name="coursetype">
                                                        <option value="coursetype"> --- Please Select --- </option>
                                                        <option>Online</option>
                                                        <option>Onsite</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6" id="addressField" style="display: none;">
                                                <div class="form-group" ml-10>
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="address"
                                                        placeholder="Enter Address here" name="address">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 " style="text-align: right">
                                        <button type="submit" class="btn btn-outline-secondary  me-2">Add</button>
                                    </div>
                                </div>
                                <!-- /Account -->
                        </div>
                    </div>
                    <div id="step-1" class="">
                        <div class="card-body">
                            <div class="card mb-4">
                                <h5 class="card-header text-left">Post Details</h5>
                                <hr class="my-0" />
                                <div class="card-body">
                                    <div class="row col-lg-12">
                                        <div class="col-sm-6">
                                            <div class="form-group ml-6">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="title"
                                                    placeholder="Title" name="title" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group ml-6">
                                                <label for="training_category_id" class="form-label">Category:</label>
                                                <select class="form-control" id="training_category_id"
                                                    name="training_category_id">
                                                    @foreach ($trainingCategories as $value)
                                                        <option value="{{ $value->id ?? null }}">
                                                            {{ $value->title }}
                                                        </option>
                                                    @endforeach 
                                                     
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group ml-6">
                                                <label for="inputtext11" class="form-label">Image</label>
                                                <input type="file" name="image" class="form-control"
                                                    style="height: fit-content;">
                                                @if ($errors->has('image'))
                                                    <span style="color: red;"
                                                        class="invalid-feedback1 font-weight-bold">{{ $errors->first('image') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" id="description" class="form-control ckeditor"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="mt-2" style="text-align: right">
                                    <button type="submit" class="btn btn-outline-secondary me-2">Create</button>
                                </div> -->
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Add an event listener to the type select element
        $('#coursetype').change(function() {
            // Show or hide the address field based on the selected course type
            if ($(this).val() === 'Onsite') {
                $('#addressField').show();
            } else {

                $('#addressField').hide();
            }
        });
    });
</script>
@stop
@section('page-js')

<script>
    $(document).ready(function() {
        $('#smartwizard').smartWizard({
            selected: 0, // Initial step
            keyNavigation: false, // Enable keyboard navigation

        });
    });
</script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script src="{{ asset('assets/js/vendor/jquery.smartWizard.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="{{ asset('assets/js/vendor/quill.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/j93evmvpkl9x9azhqkcx9436oknslp5bxmxurqkz2d1nm24j/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: "textarea#details",
        height: 650,
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
            input.setAttribute("type", "file1");
            input.setAttribute("accept", "image/*");
            input.onchange = function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function() {
                    var id = "blobid" + new Date().getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(",")[1];
                    var blobInfo = blobCache.create(id, file1, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), {
                        title: file1.name
                    });
                };
            };
            input.click();
        }
    });
</script>
<script src="https://cdn.tiny.cloud/1/j93evmvpkl9x9azhqkcx9436oknslp5bxmxurqkz2d1nm24j/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: "textarea#description",
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
@section('bottom-js')
<script src="{{ asset('assets/js/smart.wizard.script.js') }}"></script>
<script src="{{ asset('assets/js/quill.script.js') }}"></script>
@endsection
