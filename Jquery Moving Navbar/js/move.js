$(document).ready(function() {



    // calculate body  padding top depend on navbar height

    $('body').css('paddingTop', $('.navbar').innerHeight());



    $(".link").click(function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $('#' + $(this).data('scroll')).offset().top + 25
        }, 1000);

    });

    $('.navbar li a').click(function() {
        // $('.navbar a').removeClass('active');
        // $(this).addClass('active');

        $(this).addClass('active').parent().siblings().find("a").removeClass('active');
    });

    // Sync Navbar Links With Sections

    $(window).scroll(function() {
            $('.block').each(function() {
                if ($(window).scrollTop() > $(this).offset().top) {
                    var blockId = $(this).attr('id');
                    $('.navbar a').removeClass('active');
                    $(".navbar li a[data-scroll='" + blockId + "']").addClass("active");


                }
            })
        })
        // Scroll button
    $(window).on("sc roll", function() {
        if ($(window).scrollTop() > 500) {
            $(".scrollbtn").fadeIn(1000);
        } else {
            $(".scrollbtn").fadeOut(1000);
        }

    })




    $(".scrollbtn").click(function() {

        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    })
});