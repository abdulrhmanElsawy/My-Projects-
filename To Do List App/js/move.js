// Setting Up Variables
let theInput = document.querySelector(".add-task input"),
    theAddButton = document.querySelector(".add-task .plus"),
    tasksContainer = document.querySelector(".tasks-content"),

    tasksCount = document.querySelector(".tasks-count span"),
    tasksCompleted = document.querySelector(".tasks-completed span");

// Focus On input Field
window.onload = function() {
    theInput.focus();
};

// Adding The Task

theAddButton.onclick = function() {
    // IF input Is Empty 
    if (theInput.value === '' || theInput.value === null) {

        console.log("no value");

    } else {

        let noTaskMsg = document.querySelector(".no-tasks-message");

        // Check If Span with No Tasks Messages  Is Exist
        if (document.body.contains(document.querySelector(".no-tasks-message"))) {
            // Remove No Task message
            noTaskMsg.remove();
        }

        // Create Span Element
        let mainSpan = document.createElement("span");

        //Create Delete Button 
        let deleteElement = document.createElement("span");

        // Create The Span text
        let text = document.createTextNode(theInput.value);

        // Create The Delete Button Text
        let deleteText = document.createTextNode("Delete");

        // Add Text To  Span
        mainSpan.appendChild(text);

        // Add Class TO Span
        mainSpan.className = 'task-box';

        // Add Text To Delete Buttons
        deleteElement.appendChild(deleteText);

        // Add Class Todelete Button
        deleteElement.className = 'delete';

        // Add Delete Button To main span
        mainSpan.appendChild(deleteElement);

        // Add THe TasK to THE Container
        tasksContainer.appendChild(mainSpan);

        // Empty The Input
        theInput.value = '';

        // Return The focus
        theInput.focus();

        // Calcualte Tasks

        calculateTasks();


    }
};

document.addEventListener('click', function(e) {
    // Delete Task
    if (e.target.className == 'delete') {
        // Remove Current Task
        e.target.parentNode.remove();

        // Check Number Of Tasks in the container 
        if (tasksContainer.childElementCount == 0) {
            createNoTasks();
        }
    }

    // Finish Task
    if (e.target.classList.contains('task-box')) {

        // Toggle Task Finished
        e.target.classList.toggle("finished");
    }

    // Calcualte Tasks

    calculateTasks();
});


// Function To create No Tasks message

function createNoTasks() {
    // create message Span Element
    let msgSpan = document.createElement("span");

    // Create The Text Message
    let msgText = document.createTextNode("No Tasks To Show");

    // Add Text To Message span
    msgSpan.appendChild(msgText);


    // Add Class To span
    msgSpan.className = "no-tasks-message";

    // Append The Message Span Element To the Task Container
    tasksContainer.appendChild(msgSpan);
}

// Function TO calculate Tasks Tasks
function calculateTasks() {

    // CalculateAll  Tasks
    tasksCount.innerHTML = document.querySelectorAll('.tasks-content .task-box').length;

    // CalculateAll Completed Tasks
    tasksCompleted.innerHTML = document.querySelectorAll('.tasks-content .finished').length;
}