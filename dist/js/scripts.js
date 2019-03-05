// https://css-tricks.com/snippets/jquery/smooth-scrolling/
// Select all links with hashes

jQuery(function($) {
    $(document).ready(function() {
        $('a[href*="#"]')
        // Remove links that don't actually link to anything
            .not('[href="#"]')
            .not('[href="#0"]')
            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                    &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    var targetOffset = 0;
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top - targetOffset
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            //   var $target = $(target);
                            //   $target.focus();
                            //   if ($target.is(":focus")) { // Checking if the target was focused
                            //     return false;
                            //   } else {
                            //     $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                            //     $target.focus(); // Set focus again
                            //   };
                        });
                    }
                }
            });
    });

});


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