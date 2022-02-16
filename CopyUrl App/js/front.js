const form = document.querySelector("form");
const btn = document.querySelector("button");

form.addEventListener("submit", (e) => {
    e.preventDefault();

});


function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).val()).select();
    document.execCommand("copy");
    btn.innerText = 'Copied !';
    $temp.remove();
}

$("button").mouseleave(function() {
    btn.innerText = "Copy Link";
});