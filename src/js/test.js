console.log("Hello World, from test.js");

jQuery(function($) {
    $(document).ready(function() {
        $('.carousel-inner .carousel-item:first').addClass('active');

        $('.carousel').carousel({
            interval: 4000
        });
    });
});

jQuery(function($) {
    $(document).ready(function() {

        // using this library https://github.com/js-cookie/js-cookie

        if (( $( ".single-galleries" ).length ) && (!Cookies.get("modal_shown"))) {

            var modalCookieExpire = new Date(Date.now() + 3 * 24 * 60 * 60 * 1000); // 3 days
            //var modalCookieExpire = new Date(Date.now() + 60 * 1000); // 1 min
            Cookies.set('modal_shown', 'yes', { expires: modalCookieExpire });

            function showBlogModal(){
                $('#modalAdvert').modal({backdrop: 'static', keyboard: false}); // Disable click outside of bootstrap modal area to close modal
            }

            // Show modal after set time
            // setTimeout(showBlogModal, 60000); // 1min
            setTimeout(showBlogModal, 10000); // 10 secs
        }
    });
});