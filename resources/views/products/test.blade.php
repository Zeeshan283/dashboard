<form action="{{ route('testupload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="images[]" id="imageInput" multiple >
    <button type="button" id="chooseImages">Choose Images</button>
    <div id="thumbnails"></div>
    <button type="submit" style="display: none;">Upload Images</button>
</form>

<script>
    document.getElementById('chooseImages').addEventListener('click', function () {
        document.getElementById('imageInput').click();
    });

    document.getElementById('imageInput').addEventListener('change', function () {
        var thumbnails = document.getElementById('thumbnails');
        thumbnails.innerHTML = ''; // Clear previous thumbnails

        var files = this.files;
        for (var i = 0; i < files.length; i++) {
            var img = document.createElement('img');
            img.src = URL.createObjectURL(files[i]);
            img.style.maxWidth = '100px';
            thumbnails.appendChild(img);
        }

        // Show the upload button when at least one image is selected
        if (files.length > 0) {
            document.querySelector('button[type="submit"]').style.display = 'block';
        }
    });
</script>