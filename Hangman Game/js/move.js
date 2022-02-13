// letters

const letters = "abcdefghijklmnopqrstuvwxyz";

// Get Array From letters

let lettersArray = Array.from(letters);

// Select Letters Container

let letterContainer = document.querySelector(".letters");

// Generate Letters
lettersArray.forEach(letter => {
    // Create Span
    let span = document.createElement("span");

    // Create Letter Text Node
    let theLetter = document.createTextNode(letter);

    // Append The Letter To span
    span.appendChild(theLetter);

    // Add Class On Span
    span.className = 'letter-box';

    // Append Span To The Letters Container
    letterContainer.appendChild(span);
});

// Object of Words + categories

const words = {
    programming: ["php", "javascript", "go", "scale", "r", "mysql", "python"],
    movies: ["prestige", "inception", "parasite", "interstellar", "whiplash", "memento", "coco", "Up"],
    people: ["alpert einstein", "hitchcock", "alexander", "cleopatra", "mahatma ghandi"],
    countries: ["Syria", "palestine", "Yemen", "Egypt", "Bahrain", "Qatar"]

}

// Get Random Property
let allKeys = Object.keys(words);

// Get a Random Key Index From Only the Keys I have (depends on keys length)
let randomPropNumber = Math.floor(Math.random() * allKeys.length);

// Category
let randomPropName = allKeys[randomPropNumber];

// category Words
let randomPropValue = words[randomPropName];

// Random Number depends on words
let randomValueNumber = Math.floor(Math.random() * randomPropValue.length);

// the Choosen Word
let randomValueWord = randomPropValue[randomValueNumber];


// Set Category Info
document.querySelector(".game-info .category span").innerHTML = randomPropName;

// Select Letters Guess Container ELement 
let lettesGuessContainer = document.querySelector(".letters-guess");

// convert ChooseN Word To an Array
let lettersAndSpaceArray = Array.from(randomValueWord);

// Create Spans Depend On Word Letters

lettersAndSpaceArray.forEach(letter => {
    // Create Empty span
    let emptySpan = document.createElement("span");

    // if letter is Space
    if (letter === ' ') {

        // Add Class To The Span
        emptySpan.className = "with-space";
    }

    // Append Span to The Letter Guess Container
    lettesGuessContainer.appendChild(emptySpan);
});

// Select Guess Spans
let guessSpans = document.querySelectorAll(".letters-guess span");

// Set Wrong Attemps

let wrongAttemps = 0;

// Select The Draw Element
let theDraw = document.querySelector(".hangman-draw");



// Handle Clicking On Letters

document.addEventListener("click", (e) => {

    // Set the Choose Status
    let theStatus = false;


    if (e.target.className === 'letter-box') {
        e.target.classList.add("clicked");

        // Get Clicked Letter
        let theClickedLetter = e.target.innerHTML.toLowerCase();

        // The Choosen Word 
        let theChoosenWord = Array.from(randomValueWord.toLowerCase());

        theChoosenWord.forEach((wordLetter, WordIndex) => {
            // if The Clicked Letter Equal To one of the Chosen letters 
            if (theClickedLetter == wordLetter) {

                // Set Status To Correct
                theStatus = true;

                // loop On All Guess Spans 
                guessSpans.forEach((span, spanIndex) => {
                    if (WordIndex === spanIndex) {
                        span.innerHTML = theClickedLetter;
                    }
                });

            }
        });

        // out Side The loop
        // If Letter IS Wrong 
        if (theStatus !== true) {
            // increase The Wrong Attemps 
            wrongAttemps++;

            // Add Class Wrong On The Draw Element 
            theDraw.classList.add(`wrong-${wrongAttemps}`);

            // Play Fail Sound 
            document.getElementById("fail").play();

            if (wrongAttemps === 7) {
                document.getElementById("Hamoot").play();
            }

            if (wrongAttemps === 8) {
                endGame();

                letterContainer.classList.add("finished");
            }

        } else {
            // Play Success Sound
            document.getElementById("success").play();
        }

    }
});

// End Game Function 
function endGame() {
    // Create popUp Div
    let div = document.createElement("div");

    // Create Text  
    let divText = document.createTextNode(`Game Over, The Word IS ${randomValueWord}`);

    // Append The Text To the Div  
    div.appendChild(divText);

    // Add Class On Div 
    div.className = 'popup';

    // Append To The Body 
    document.body.appendChild(div);
}