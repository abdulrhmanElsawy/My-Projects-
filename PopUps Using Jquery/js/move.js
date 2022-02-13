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
    var scrollToTopbtn = $(".scrollbtn");
    $(window).on("scroll", function() {
        if ($(window).scrollTop() > 500) {
            if (scrollToTopbtn.is(':hidden')) {
                scrollToTopbtn.fadeIn(1000);
                scrollToTopbtn.css("backgroundColor", "#333");
            }

        } else {
            scrollToTopbtn.fadeOut(1000);
        }
    })




    $(".scrollbtn").click(function() {
        scrollToTopbtn.css("backgroundColor", "green")
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    })


    // $(".circle").click(function() {
    //     $(this).css({
    //         "backgroundColor": "#333",
    //         "left": 50,

    //     });
    //     $(".blackmodbtn").css({
    //         "backgroundColor": "#eee"
    //     })
    //     $(".block").css({
    //         "backgroundColor": "black",
    //         "color": "white"
    //     })

    // })

    // $(".circle").dblclick(function() {
    //     $(this).css({
    //         "backgroundColor": "#eee",
    //         "left": 0,

    //     });
    //     $(".blackmodbtn").css({
    //         "backgroundColor": "#333"
    //     })
    //     $(".block").css({
    //         "backgroundColor": "#eee",
    //         "color": "#333"
    //     })

    // })

    // pop Up

    $(".show-popup").click(function() {
        $(".popUp").fadeIn(1000);
    })
    $('.popUp').click(function(e) {
        $(this).fadeOut(400)
    })

    $('.popUp .inner').click(function(e) {
        e.stopPropagation();
    })

    $(".closebtn").click(function(e) {
        e.preventDefault();
        $(".popUp").fadeOut(400);
    })

    $(document).keydown(function() {
        $(".popUp").fadeOut(400);
    })

    // End Pop Up

    // Buttons Effect

    $(".from-left").hover(function() {
        $(this).find('span').eq(0).animate({
            width: '100%'
        }, 200)
    }, function() {
        $(this).find('span').eq(0).animate({
            width: '0'
        }, 200)
    })
});