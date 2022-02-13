// Select The Start Game buttons
document.querySelector(".control-buttons span").onclick = function() {

    // Prompt window to Ask For Name
    let yourName = prompt("Whats Your Name?");

    // if Name Is Empty
    if (yourName == "" || yourName == null) {

        // set Name To unknown
        document.querySelector(".name span").innerHTML = "Unknown Person";

        // Name Is Not Empty
    } else {

        // set name to your name
        document.querySelector(".name span").innerHTML = yourName;
    }

    // Remove The splash Screen
    document.querySelector(".control-buttons").remove();
};
// Effect Duration
let duration = 1000;

// Select Blocks Container
let blocksContainer = document.querySelector(".memory-game-blocks");

// Create Array From Game Blocks
let blocks = Array.from(blocksContainer.children);

// Create Range of keys and the three dots to put the array out in the made array []
let orderRange = [...Array(blocks.length).keys()];

shuffle(orderRange);
// Add  Order Css Propert To game blocks

blocks.forEach((block, index) => {
    // Ad  css Order Propery
    block.style.order = orderRange[index];

    // Add Click Event
    block.addEventListener('click', function() {
        // Trigger FlipBlock Function
        flipBlock(block);
    });
});

// Flib Block function
function flipBlock(selectedBlock) {

    // Add class IS-flipped
    selectedBlock.classList.add('is-flipped');

    // Collect All Flipped Cards
    let allFlippedBlocks = blocks.filter(flippedBlock => flippedBlock.classList.contains('is-flipped'));

    // If There is Two Selected Blocks
    if (allFlippedBlocks.length === 2) {

        // Stop Clicking function
        stopClicking();

        // Check Matched Block Function
        checkMatchedBlock(allFlippedBlocks[0], allFlippedBlocks[1]);

    }

}

// Stop Clicking function
function stopClicking() {
    // Add Class No Clicking On main Container
    blocksContainer.classList.add('no-clicking');

    setTimeout(() => {
        // Remove Class No Clicking After The duration
        blocksContainer.classList.remove('no-clicking');
    }, duration)
}

// Check Matched Block
function checkMatchedBlock(firstBlock, secondBlock) {
    let triesElement = document.querySelector('.tries span');
    if (firstBlock.dataset.technology === secondBlock.dataset.technology) {
        firstBlock.classList.remove('is-flipped');
        secondBlock.classList.remove('is-flipped');

        firstBlock.classList.add('has-match');
        secondBlock.classList.add('has-match');

        document.getElementById('success').play();
    } else {
        triesElement.innerHTML = parseInt(triesElement.innerHTML) + 1;


        setTimeout(() => {
            firstBlock.classList.remove('is-flipped');
            secondBlock.classList.remove('is-flipped');

        }, (duration - 500));

        document.getElementById('failed').play();
    }
}

// Shuffle Function

function shuffle(array) {
    // settings Vars
    let current = array.length,
        temp,
        random;
    while (current > 0) {
        // Get Random Number
        random = Math.floor(Math.random() * current); //!!!

        // Decrease Length By One
        current--;

        // save Current Element in stash
        temp = array[current];

        // Current Elemnt = Random Element

        array[current] = array[random];

        // Random Element = Get Element From Stash
        array[random] = temp;

    }
    return array;
}