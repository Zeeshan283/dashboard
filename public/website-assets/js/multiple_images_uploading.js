function CHooseImage() {
    document.getElementById('image').click();
}
var images = [];

function image_select() {
    var image = document.getElementById('image').files;
    for (i = 0; i < image.length; i++) {
        images.push({
            'name': image[i].name,
            'url': URL.createObjectURL(image[i]),
            'file': image[i]
        });
    }

    document.getElementById('all_images').innerHTML = image_show();
}

function image_show() {
    var image = "";
    var images_paths = [];
    images.forEach((i) => {
        image += `<div class="image_container d-flex justify-content-center position-relative">
        <img src="${i.url}" alt="Image">
        <span class="position-absolute" onClick="delete_image(${images.indexOf(i)})">&times;</span>
    </div>`;
        images_paths += `<input type="text" name="multiple_images[]" id="multiple_images" value="${i.url+'_'+i.name}" />`;

    });
    document.getElementById('images_paths').innerHTML = images_paths;



    return image;
}

function delete_image(i) {
    images.splice(i, 1);
    document.getElementById('all_images').innerHTML = image_show();
}