@extends('layouts.master')
@section('before-css')


@endsection

@section('main-content')
            <div class="breadcrumb">
                <h1>Create category</h1>
            </div>

            <div class="separator-breadcrumb border-top"></div>
            <div class="2-columns-form-layout">
                <div class="">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <h3 class="card-title"> Create category</h3>
                                </div>
                                <form action="{{route('addcat.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">

                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label for="inputtext11" class="ul-form__label">Choose Menu:</label>
                                                <select class="form-control" id="customer_id" name="menu_id" data-live-search="true">
                                                    <option value="" selected disabled>Select Menu</option>
                                                    @foreach ($menus as $menu)
                                                        <option value="{{ $menu->id}}">{{ $menu->name}}</option>
                                                    @endforeach
                                                </select>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Please enter category name
                                                </small>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputtext11" class="ul-form__label">Name:</label>
                                                <input type="text" class="form-control" id="first_name"  name="name"  placeholder="Enter category name" value="{{ old ('firstname')}}">
                                                <span style="color: red">@error('name'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Name
                                                </small>
                                            </div>
                                            {{-- <div class="form-group col-md-6">
                                                <label for="inputtext11" class="ul-form__label">Commision:</label>
                                                <input type="number" class="form-control" id="commission" name="commission"  placeholder=Commission" value="{{ old ('lastname')}}">
                                                <span style="color: red">@error('commision'){{ $message }}@enderror</span>
                                                <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                                    Commission
                                                </small>
                                            </div> --}}




                                            <div class="form-group col-md-6">
                                                <label for="inputEmail16" class="ul-form__label">Category Image(160x80)px</label>
                                                <div class="input-right-icon">
                                                    <input type="file" class="form-control" id="inputEmail16"  name="img" >
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail16" class="ul-form__label">Category App Image(160x80)px</label>
                                                <div class="input-right-icon">
                                                    <input type="file" class="form-control" id="inputEmail16"  name="imageforapp" >
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inputtext11" class="ul-form__label">Category Side Slider's:</label>
                                                
                                                <input type="file" name="side_sliders[]" id="imageInput"  class="form-control" multiple >
                                                <button type="button" class="d-none form-control" style="width: auto;"id="chooseImages">Choose Images</button>
                                                    
                                            </div>

                                            <div class="form-group col-md-6">

                                                    <div id="thumbnails" class="image-container_1"></div>
                                                    <div id="fileLimitMessage" style="color: red;"></div>
                                                </div>




                                    </div>

                                    <div class="card-footer">
                                        <div class="mc-footer">
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn  btn-outline-secondary m-1">Save</button>
                                                    <button type="button" class="btn btn-outline-secondary m-1">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('page-js')

<script>
    document.getElementById('chooseImages').addEventListener('click', function () {
        document.getElementById('imageInput').click();
        
    });

    document.getElementById('imageInput').addEventListener('change', function () {
        
        var RemoveImg = document.getElementById('loopImg');
        if (RemoveImg) {
            RemoveImg.style.display = 'none';
        }

        var files = this.files;
        var maxImages = 100; // Set your maximum image limit here
        var fileLimitMessage = document.getElementById('fileLimitMessage');
        if (files.length > maxImages) {
            fileLimitMessage.textContent = 'Please select a maximum of ' + maxImages + ' images.';
            this.value = ''; // Clear selected files
        } else {
            fileLimitMessage.textContent = ''; // Clear the message if within the limit
        }
    });
    document.getElementById('imageInput').addEventListener('change', function () {
        
        var thumbnails = document.getElementById('thumbnails');
        thumbnails.innerHTML = ''; // Clear previous thumbnails

        var files = this.files;
    var maxImages = 100; // Set your maximum image limit here
    for (var i = 0; i < Math.min(files.length, maxImages); i++) {
        var img = document.createElement('img');
        img.src = URL.createObjectURL(files[i]);
        img.style.maxWidth = '100px';
        thumbnails.appendChild(img);
    }

        // Show the upload button when at least one image is selected
        
    });
</script>


@endsection

@section('bottom-js')




@endsection
