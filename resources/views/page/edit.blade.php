@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')
    <form method="post" action="{{ route('pages.update', ['page' => $value->id]) }}">
        @csrf
        @method('PATCH')
        <div class="card mb-4">
            <h5 class="card-header text-left">Edit Page's</h5>
            <hr class="my-0" />
            <div class="card-body">
                <div class="row">
                    <div class="row">
                        <div class="col-12">
                            <label for="inputtext11" class="form-label">Title:</label>
                            <textarea name="question" id="question" class="form-control " rows="3">{{ $value->question }}</textarea>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <label for="answer" class="form-label">Details:</label>
                            <textarea name="answer" id="answer" class="form-control ckeditor" rows="20">{{ $value->answer }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-2 " style="text-align: right">
                    <button type="submit" class="btn btn-outline-secondary  me-2">Update</button>
                </div>
            </div>
            <!-- /Account -->
        </div>
    </form>
    <script src="https://cdn.tiny.cloud/1/j93evmvpkl9x9azhqkcx9436oknslp5bxmxurqkz2d1nm24j/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: "textarea#answer",
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
@section('page-js')
@endsection
