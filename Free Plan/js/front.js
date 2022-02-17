const rangeval = $("#range-value");
const rangeinput = $("#range");


rangeval.text(rangeinput.val());
$(document).on('change', rangeinput, function() {
    rangeval.text(rangeinput.val());
    rangeval.css("left", (rangeinput.val() / 1000) - 2 + "vh")
});


$(".right span").click(function() {
    $(this).toggleClass("active");
});