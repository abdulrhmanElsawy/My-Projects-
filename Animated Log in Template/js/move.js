$(document).ready(function() {

    $(".submitbtn").click(function(e) {
        e.preventDefault();
        $(".loginEffect").animate({
            width: '100%'
        }, 200)
    })
    $(".loginEffect").mouseleave(function() {
        $(this).animate({
            width: '0'
        }, 200)
    })
})