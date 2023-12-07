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
                            <h5>Edit Blogs</h5>
                        </div>
                        <div class="card-body">
                            <!-- <form method="post" action="{{ route('blogs.update',['blog'=> $edit->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH') -->
                                <form method="post" action="{{ route('blogs.update',['blog'=> $edit->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card mb-4">
                                    <h5 class="card-header text-left">Update  Blogs </h5>
                                    <hr class="my-0"/>
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="row col-lg-12">
                                            <div class="col-sm-6">
                                                <div class="form-group ml-6">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{$edit->title}}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group ml-6">
                                                    <label for="inputtext11" class="form-label">Category:</label>
                                                    <select class="form-control" id="blog_category" name="blog_category_id">
                                                        @foreach ($categories as $data)
                                                            <option value="{{ $data->blog_category_id }}">{{ $data->blog_category_id }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
            <div class="form-group ml-6">
                <label for="inputtext11" class="form-label">Sub Category</label>
                <input type="text" class="form-control" id="blog_sub_category_id" placeholder="Sub Category" name="blog_sub_category_id" required>
            </div>
        </div>
                                            <div class="col-sm-6">
                                                <div class="form-group ml-6">
                                                    <label for="inputtext11" class="form-label">Feature Image:</label>
                                                    <input type="file" name="feature_image" class="form-control" style="height: fit-content;">
                                                    @if ($errors->has('feature_image'))
                                                        <span style="color: red;" class="invalid-feedback1 font-weight-bold">{{ $errors->first('feature_image') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" id="description" class="form-control ckeditor"  value="{{$edit->description}}"></textarea>
                                            </div>
                                        </div>
                                            </div>
                                        </div>
                            
                                        <div class="mt-2 " style="text-align: right">
                                            <button type="submit" class="btn btn-outline-secondary  me-2">Submit</button>
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
    @endsection

@section('page-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables.script.js') }}"></script>
@endsection
