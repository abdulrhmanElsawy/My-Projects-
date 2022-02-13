$(document).ready(function() {



    // calculate body  padding top depend on navbar height

    $('body').css('paddingTop', $('.navbar').innerHeight());












    $(".link").click(function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $('#' + $(this).data('scroll')).offset().top
        }, 1000);

    });
});