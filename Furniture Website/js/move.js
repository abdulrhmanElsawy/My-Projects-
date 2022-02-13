let icon = document.getElementById("icon");
let myElement = document.getElementById("nav");
icon.addEventListener("click", ToggleNav);

function ToggleNav() {
    if (myElement.style.display === "block") {
        myElement.style.display = "none";
    } else {
        myElement.style.display = "block";
    }
}