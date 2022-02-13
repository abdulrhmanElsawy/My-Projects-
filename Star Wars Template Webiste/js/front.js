
// remove the place holder in admin page on select
$(function () {

    "use strict";

    // Switch Between Login and Sign UP

    $('.login-page h1 span').click(function(){
        $(this).addClass('selected').siblings().removeClass('selected');

        $('.login-page form').hide();

        $( '.'  + $(this).data('class')).fadeIn(100);
        
    });

    // Trigger The Selectbox it

    $("select").selectBoxIt({
        autoWidth:false
    });

    $("[placeholder]").focus(function () {
        $(this).attr("data-text" , $(this).attr("placeholder"));

        $(this).attr("placeholder", " ");

    }).blur(function () {
        $(this).attr("placeholder", $(this).attr("data-text"));
    });

    // add Asterisl on Required Field

    $("input").each(function () {
        if ($(this).attr("required") === "required") {

            $(this).after("<span class='asterisk'>*</span>");

        }

    });

    // Confirmation message on button


    $('.confirm').click(function(){
        return confirm('Are you Sure');
    });

    $('.live').keyup(function(){
        $($(this).data('class')).text($(this).val());
    });


});