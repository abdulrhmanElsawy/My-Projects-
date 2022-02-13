// Select Elements

let allSpans = document.querySelectorAll(".buttons span"),
    results = document.querySelector(".results > span"),
    theInput = document.getElementById("the-input");

allSpans.forEach(span => {
    span.addEventListener("click", (e) => {
        if (e.target.classList.contains("check-item")) {
            checkItem();
        }
        if (e.target.classList.contains("add-item")) {
            addItem();
        }
        if (e.target.classList.contains("delete-item")) {
            deleteItem();
        }
        if (e.target.classList.contains("show-items")) {
            showItems();
        }
    })
});

function checkInput() {
    if (theInput.value === '') {
        results.innerHTML = '<span style="color:red">Input Can Not Be Empty</style>';
    }
}

function checkItem() {
    if (theInput.value !== '') {
        if (localStorage.getItem(theInput.value)) {
            results.innerHTML = `Found Local Item Called <span>${theInput.value}</span>`;

        } else {
            results.innerHTML = `No Local Storage  Item Called <span>${theInput.value}</span>`;
        }
    } else {
        checkInput();
    }

}

function addItem() {
    if (theInput.value !== '') {
        localStorage.setItem(theInput.value, "Test");

        results.innerHTML = `Local Storage Item <span>${theInput.value}</span> Added`
        theInput.value = "";
    } else {
        checkInput();
    }
}

function deleteItem() {
    if (theInput.value !== '') {
        if (theInput.value !== '') {
            if (localStorage.getItem(theInput.value)) {
                localStorage.removeItem(theInput.value);
                results.innerHTML = ` Local Item Called <span>${theInput.value}</span> Deleted`;
                theInput.value = "";

            } else {
                results.innerHTML = `No Local Storage  Item Called <span>${theInput.value}</span>`;

            }


        } else {
            checkInput();
        }
    }
}

function showItems() {
    if (localStorage.length) {
        // results.innerHTML = `Found Elements and There Number is: <span>${localStorage.length}</span>`;
        results.innerHTML = "";
        for (let [key, value] of Object.entries(localStorage)) {
            results.innerHTML += `<span class="keys">${key}</span>`
        }

    } else {
        results.innerHTML = `Local Storage Is Empty`
    }
}