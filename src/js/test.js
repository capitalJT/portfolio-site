console.log("hello World");

jQuery(function($) {
    $(document).ready(function() {
        $('.carousel-inner .carousel-item:first').addClass('active');

        $('.carousel').carousel({
            interval: 4000
        });
    });
});
