@extends('layouts.master')
@section('before-css')
{{-- css link sheet  --}}
<link rel="stylesheet" href="{{asset('assets/styles/vendor/smart.wizard/smart_wizard_theme_dots.min.css')}}">
<link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection


@section('main-content')
<div class="breadcrumb">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
                <h1>Training Page</h1>
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
                    
                    <div id="smartwizard" class="sw-theme-dots" >
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
                        <form method="post" action="{{ route('cfeatures.store') }}">
                                @csrf
                                <div class="card mb-4">
                                    <h5 class="card-header text-left">Course Features</h5>
                                    <hr class="my-0"/>
                                    <div class="card-body">
                                        <div class="row">
        <div class="col-sm-6">
            <div class="form-group" ml-10>
                <label for="instructor" class="form-label">Instructor</label>
                <input type="text" class="form-control" id="instructor" placeholder="Instructor Name" name="instructor"  required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="rating" class="form-label">Rating</label>
                <input type="text" class="form-control" id="rating" placeholder="Total rating" name="rating" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="lectures" class="form-label">Lectures</label>
                <input type="text" class="form-control" id="lectures" placeholder="Total lectures" name="lectures" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="duration" class="form-label">Duration</label>
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
                        <option>Mexico</option>
                        <option>Norway</option>
                        <option>Oman</option>
                        <option selected="selected">Pakistan</option>
                        <option>Palau</option>
                        <option>Saudi Arabia</option>
                        <option>Senegal</option>
                        <option>Serbia</option>
                        <option>Seychelles</option>
                        <option>Sierra Leone</option>
                        <option>Singapore</option>
                        <option>Slovak Republic</option>
                        <option>Slovenia</option>
                        <option>Solomon Islands</option>
                        <option>Somalia</option>
                        <option>South Africa</option>
                        <option>South Georgia &amp; South Sandwich Islands</option>
                        <option>South Sudan</option>
                        <option>Spain</option>
                        <option>Sri Lanka</option>
                        <option>St. Barthelemy</option>
                        <option>St. Helena</option>
                        <option>St. Martin (French part)</option>
                        <option>St. Pierre and Miquelon</option>
                        <option>Sudan</option>
                        <option>Suriname</option>
                        <option>Turkey</option>
                        <option>Uganda</option>
                        <option>Ukraine</option>
                        <option>United Arab Emirates</option>
                        <option>United Kingdom</option>
                        <option>United States</option>
                        <option>United States Minor Outlying Islands</option>
                        <option>Uzbekistan</option>
                        <option>Zambia</option>
                        <option>Zimbabwe</option>
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
                <input type="text" class="form-control" id="address" placeholder="Enter Address here" name="address">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Add an event listener to the type select element
            $('#coursetype').change(function () {
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
       $(document).ready(function () {
           $('#smartwizard').smartWizard({
               selected: 0,  // Initial step
               keyNavigation: false, // Enable keyboard navigation
   
           });
       });
   </script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script src="{{asset('assets/js/vendor/jquery.smartWizard.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="{{asset('assets/js/vendor/quill.min.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/j93evmvpkl9x9azhqkcx9436oknslp5bxmxurqkz2d1nm24j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
    selector: "textarea#details",
    height: 650, 
    relative_urls: false,
    paste_data_images: true,
    image_title: true,
    automatic_uploads: true,
    // images_upload_url: '/post/image/upload',
    // images_upload_url: '{{asset('upload')}}',
    images_upload_url: '{{URL::to("/uploads3")}}',
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
                cb(blobInfo.blobUri(), { title: file1.name });
            };
        };
        input.click();
    }
});
</script>
<script src="https://cdn.tiny.cloud/1/j93evmvpkl9x9azhqkcx9436oknslp5bxmxurqkz2d1nm24j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: "textarea#description",
    relative_urls: false,
    paste_data_images: true,
    image_title: true,
    automatic_uploads: true,
    // images_upload_url: '/post/image/upload',
    // images_upload_url: '{{asset('upload')}}',
    images_upload_url: '{{URL::to("/uploads3")}}',
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
                cb(blobInfo.blobUri(), { title: file.name });
            };
        };
        input.click();
    }
});
</script>
@endsection
@section('bottom-js')
<script src="{{asset('assets/js/smart.wizard.script.js')}}"></script>
<script src="{{asset('assets/js/quill.script.js')}}"></script>
@endsection