var elements = $("#form :input");



const forminputs = $("input");
const formlabel = $("label");





document.getElementById("remain").innerText = elements.length + "Tasks Remain";

forminputs.click(function() {
    let unchecked = elements.length;
    for (var i = 0, element; element = elements[i++];) {

        if (element.type === "checkbox" && element.checked == 1) {
            $(".span-" + i).addClass("active");
            --unchecked;
        } else {
            $(".span-" + i).removeClass("active");
            ++unchecked;
        }


    }
    document.getElementById("remain").innerText = unchecked / 2 + "Tasks Remain";


});