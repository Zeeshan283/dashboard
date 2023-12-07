@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('website-assets/css/toastr.min.css') }}">
@endsection

@section('main-content') 
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid " id="">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Blog Management</h5>
                        </div>
                        <div class="card-body">
                        <form method="post" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
    @csrf
                                <div class="card mb-4">
                                    <h5 class="card-header text-left">Create Blogs</h5>
                                    <hr class="my-0"/>
                                    <div class="card-body">
                                        <div class="row col-lg-12">
        <div class="col-sm-6">
            <div class="form-group" ml-6>
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" placeholder="Title" name="title"  required>
            </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group ml-6">
    <label for="inputtext11" class="form-label">Category:</label>
    <select class="form-control" id="blog_category" name="blog_category_id">
        @foreach ($cat as $data)
            <option value="{{ $data->id }}">{{ $data->category }}</option>
        @endforeach
    </select>
</div>
        </div>
        <div class="col-sm-6">
<div class="form-group ml-6" id="sub_category_div">
    <label for="inputtext11" class="form-label">Subcategory:</label>
    <select class="form-control" id="blog_subcategory" name="blog_subcategory_id">
    @foreach ($cat as $data)
            <option value="{{ $data->id }}">{{ $data->subcategory }}</option>
        @endforeach
    </select>
</div>
        </div>
        <div class="col-sm-6">
            <div class="form-group" ml-6>
                <label for="inputtext11" class="form-label">Feature Image:</label>
                <input type="file" name="feature_image" class="form-control" style="height: fit-content;">
                @if ($errors->has('feature_image'))
                                                <span   style="color: red;"
                                                    class="invalid-feedback1 font-weight-bold">{{ $errors->first('feature_image') }}</span>
                                                @endif  
                                                </div>
        </div></div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control ckeditor"></textarea>
            </div>
        </div>
                                            </div>
                                        </div>
                            
                                        <div class="mt-2 " style="text-align: right">
                                            <button type="submit" class="btn btn-outline-secondary  me-2">Add Blogs</button>
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
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Your existing script -->
<script>
    $(document).ready(function() {
        // Event listener for the category dropdown change
        $('#blog_category').change(function() {
            var categoryId = $(this).val();

            // Ajax request to fetch subcategories based on the selected category
            $.ajax({
                url: '/get-subcategories', // Update the URL based on your route
                type: 'GET',
                data: { 'cat_id': categoryId },
                success: function(response) {
                    // Parse the JSON response
                    var subcategories = JSON.parse(response);

                    // Clear existing options
                    $('#blog_subcategory').empty();

                    // Append new subcategory options
                    $.each(subcategories, function(index, subcategory) {
                        $('#blog_subcategory').append('<option value="' + subcategory.id + '">' + subcategory.title + '</option>');
                    });

                    // Show the subcategory div
                    $('#sub_category_div').show();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

    @endsection

@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection


