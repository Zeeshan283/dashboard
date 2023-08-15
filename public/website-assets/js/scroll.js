$(document).ready(function() {
    $(document).scroll(function() {
        // console.log($(document).scrollTop());
        if ($(document).scrollTop() > 150) {
            $('#sticky-footer-bar').addClass('fixed');
        } else {
            console.log($(document).scrollTop());
            $('#sticky-footer-bar').removeClass('fixed');
        }
    })

})