@extends('layouts.master')
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection
@section('main-content')
<form method="post" action="{{ route('addterm.store') }}">
    @csrf
    <div class="card mb-4">
        <h5 class="card-header text-center">Add Terms & Conditions</h5>
        <hr class="my-0"/>
        <div class="card-body">
            <div class="row">
                <div class="row">
                    <div class="col-sm-6 d-flex align-items-center">
                        <label for="inputtext11" class="form-label">Title:</label>
                        <input type="text" class="form-control ms-2" id="name" placeholder="Title" name="title" required>
                    </div>
                </div>

                 <div class="col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control ckeditor"></textarea>
                </div>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-outline-secondary me-2">Submit</button>
            </div>
        </div>
        <!-- /Account -->
    </div>
</form>
<script src="https://cdn.tiny.cloud/1/ki85z92gad4jwy6pn6wzw9uctxkdmgs0nn8tawovzdc0j1zb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
