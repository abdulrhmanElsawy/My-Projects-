const quizData = [{
        question: 'How old is me ?',
        a: '10',
        b: '20',
        c: '30',
        d: '40',
        correct: 'c'
    }, {
        question: 'What is the most used programming language in 2022 ?',
        a: 'java',
        b: 'c',
        c: 'python',
        d: 'javaScript',
        correct: 'd'
    }, {
        question: "who is the president of Us in 2019 ?",
        a: 'Florin Pop',
        b: 'Donald Trump',
        c: 'Ivan Saldano',
        d: 'Mihai Andrei',
        correct: 'b'
    }, {
        quetion: 'what does HTML stand for ?',
        a: 'Hypertext Markup Language',
        b: 'Cascading Syle sheet',
        c: 'Jason Object notation',
        d: 'Helicopters Terminals Motorbots Lamborginis',
        correct: 'a'
    }, {
        question: 'what year was JavaScript Launnched ?',
        a: '1996',
        b: '1995',
        c: '1994',
        d: 'none of the above',
        correct: 'd'

    }


];

const answerEls = document.querySelectorAll(".answer");
const questionEl = document.getElementById("question");
const quiz = document.getElementById("quiz");

const a_text = document.getElementById("a_text");
const b_text = document.getElementById("b_text");
const c_text = document.getElementById("c_text");
const d_text = document.getElementById("d_text");
const submitBtn = document.getElementById("submit");


let currentQuiz = 0;
let score = 0;

loadQuiz();


// Functions

function loadQuiz() {
    deselectAnswers();
    const currentQuizData = quizData[currentQuiz];
    questionEl.innerText = currentQuizData.question;

    a_text.innerText = currentQuizData.a;
    b_text.innerText = currentQuizData.b;
    c_text.innerText = currentQuizData.c;
    d_text.innerText = currentQuizData.d;



}


function deselectAnswers() {
    answerEls.forEach((answerEl) => {
        answerEl.checked = false;
    });
}

function getSelected() {
    const answerEl = document.querySelectorAll(".answer");

    let answer = undefined;

    answerEl.forEach((answerEl) => {
        if (answerEl.checked) {
            answer = answerEl.id;
        }
    });
    return answer;

}

submitBtn.addEventListener('click', () => {
    // check to see the answer
    const answer = getSelected();


    if (answer) {
        if (answer === quizData[currentQuiz].correct) {
            score++;
        }
        currentQuiz++;
        if (currentQuiz < quizData.length) {
            loadQuiz();
        } else {
            quiz.innerHTML = `<h2>You answered correctly at ${score} / ${quizData.length} Questions .</h2>
            <button onClick="location.reload()">Reload</button>`;
        }

    }




});