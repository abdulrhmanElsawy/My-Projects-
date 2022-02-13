// remove the place holder in admin page on select
$(function() {

    "use strict";
    // Dashboard

    $('.toggle-info').click(function() {
        $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(200);
        if ($(this).hasClass('selected')) {
            $(this).html('<i class="fa fa-plus fa-lg"></i>');
        } else {
            $(this).html('<i class="fa fa-minus fa-lg"></i>');
        }
    });

    // Trigger The Selectbox it

    $("select").selectBoxIt({
        autoWidth: false
    });

    $("[placeholder]").focus(function() {
        $(this).attr("data-text", $(this).attr("placeholder"));

        $(this).attr("placeholder", " ");

    }).blur(function() {
        $(this).attr("placeholder", $(this).attr("data-text"));
    });

    // add Asterisl on Required Field

    $("input").each(function() {
        if ($(this).attr("required") === "required") {

            $(this).after("<span class='asterisk'>*</span>");

        }

    });



    // convert password field to text filed

    var passFiled = $(".password");

    $(".show-pass").hover(function() {

        passFiled.attr("type", "text");

    }, function() {

        passFiled.attr("type", "password");

    });

    // Confirmation message on button


    $('.confirm').click(function() {
        return confirm('Are you Sure');
    });

    // Category View Option
    $('.cat h3').click(function() {
        $(this).next('.full-view').fadeToggle(300);
    });

    $('.Option span').click(function() {
        $(this).addClass('active').siblings('span').removeClass('active');

        if ($(this).data('view') === 'full') {
            $('.cat .full-view').fadeIn(200);

        } else {
            $('.cat .full-view').fadeOut(200);
        }
    });

    //show Delete Button On Cild Cats
    $('.child-link').hover(function() {
        $(this).find('.show-delete').fadeIn(400);
    }, function() {
        $(this).find('.show-delete').fadeOut(400);
    })


});