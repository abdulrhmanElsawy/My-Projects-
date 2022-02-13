// Get Slider Items | Array.from[Es6 feature]
var sliderImages = Array.from(document.querySelectorAll('.slider-container img'));



// Get Number Of slides
var slidesCount = sliderImages.length;

// Set Current Slider
var currentSlide = 1;

// Slide NUmber String element 
var slideNumberElement = document.getElementById("slide-number");
console.log(slideNumberElement);

// Previous And Next Buttons
var nextButton = document.getElementById('next');
var prevButton = document.getElementById('prev');


//Handel Click on Previous and Next Buttons
nextButton.onclick = nextSlide;
prevButton.onclick = prevSlide;


// Create The Main Ul element
var paginationElement = document.createElement('ul');

// Set Id On Created element
paginationElement.setAttribute('id', 'pagination-ul');

// Create List  Items Based On Slides Count
for (var i = 1; i <= slidesCount; i++) {
    // Create The Li
    var paginationItem = document.createElement('li');

    // Set Custom Attribute
    paginationItem.setAttribute('data-index', i);

    // Set item Content
    paginationItem.appendChild(document.createTextNode(i));

    // Append Items To The Main Ul List
    paginationElement.appendChild(paginationItem);
}

// Add The Created Created Ul Element To The Page
document.getElementById('indicator').appendChild(paginationElement);


// Get The New created ul
var paginationCreatedUl = document.getElementById('pagination-ul');

// Get Pagination Items | Array.from[Es6 Feature]
var paginationBullets = Array.from(document.querySelectorAll('#pagination-ul li')),
    paginationBulletsCount = paginationBullets.length;


// Loop throgth all bullets Items
for (var i = 0; i < paginationBulletsCount; i++) {
    paginationBullets[i].onclick = function() {
        currentSlide = parseInt(this.getAttribute('data-index'));
        theChecker();
    }
}




// Trigger The checker function
theChecker();






// Function Next Slide
function nextSlide() {

    if (nextButton.classList.contains('disapled')) {
        // Do Nothing
        return false;
    } else {
        currentSlide++;
        theChecker();
    }
}

// Function previous Slide
function prevSlide() {
    if (prevButton.classList.contains('disapled')) {
        // Do Nothing
        return false;
    } else {
        currentSlide--;
        theChecker();
    }
}

// Create Checker function

function theChecker() {
    slideNumberElement.textContent = 'Slide #' + (currentSlide) + ' Of ' + (slidesCount);
    // Remove All Active Classes
    removeAllActive();

    // set Active Class On Current slide
    sliderImages[currentSlide - 1].classList.add('active');

    // set Active Class On Curent Pagintaion Item
    paginationCreatedUl.children[currentSlide - 1].classList.add('active');

    // Check If current Slide Is The First
    if (currentSlide == 1) {
        // Add Disapled Class On previous button
        prevButton.classList.add('disapled');
    } else {
        // remove Disapled Class On previous button
        prevButton.classList.remove('disapled');
    }


    // Check If current Slide Is The Last
    if (currentSlide == slidesCount) {

        // Add Disapled Class On next button
        nextButton.classList.add('disapled');
    } else {
        // remove Disapled Class On next button
        nextButton.classList.remove('disapled');
    }
}

// Remove All Active Classes From Images And Bullets

function removeAllActive() {
    // Loop throgth Images
    sliderImages.forEach(function(img) {
        img.classList.remove('active');

    });
    // Loop throgth pagination bullets
    paginationBullets.forEach(function(bullet) {
        bullet.classList.remove('active');
    });
};