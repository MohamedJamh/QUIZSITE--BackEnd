// "use strict";

const steps = [...document.getElementsByClassName('step')];
const stepper = [...document.getElementsByClassName('navs')];
const timer = document.querySelector('#timer');
const question = document.querySelector("#question");
const progresseBar = document.getElementById("progressBar");
const nextBtn = document.getElementById("nextBtn");
const finalScore = document.getElementById("finalScore");
const description = document.getElementById("description");
var answerContainer = document.getElementById('answerContainer');

var questions;
var percentagePerQuestion;
var answers;
var questionSeconds;
var counterFunction;
var questionIndex = -1;
var currentPageIndex = 0;
var score = 0;

let myreq = new Request("./assets/js/data_q.json");
fetch(myreq).then(function(resp){
    return resp.json();
}).then(function(data){
    questions =  data;
    percentagePerQuestion = (1 * 100) / questions.length;
})

function progresse(){
    let width = Math.trunc((questionIndex + 1) * percentagePerQuestion) + "%";
    progresseBar.innerText = width;
    progresseBar.style.width = width;
}
function navigation(pageIndex){
    steps[currentPageIndex].classList.add('hidden');
    steps[pageIndex].classList.remove('hidden');

    stepper[currentPageIndex].classList.remove('active');
    stepper[pageIndex].classList.add('active');

    currentPageIndex = pageIndex;
}
function countDown(){
    questionSeconds -= 1;
    timer.innerText = questionSeconds;
    if(questionSeconds == 0){
        nexQ('skip');
    }
}
function startCountDown(){
    questionSeconds = 20;
    counterFunction = setInterval("countDown()",1000);
}
function stopCountDown(){
    clearInterval(counterFunction);
    timer.innerText = "--";
}
function startQuiz(){
    questions = questions.sort(function(){return Math.random() - 0.5;})
    navigation(1);
    startCountDown();
    setQ();
    progresse();
}
function nexQ(action = null){
    let submitedChoices = answerChecked();
    if(action != 'skip'){
        calculScore(submitedChoices);
    }

    if(questionIndex + 1 == questions.length){
        let totale =  (score / percentagePerQuestion) + "/" + questions.length ;
        finalScore.innerText = Math.trunc(score) + "%";
        if (score < 50) {
            description.innerText = "Good luck next time You Got:  " + totale;
        } else if(50 <= score && score <= 70 ){
            description.innerText = 'Amazing score !  ' + totale;
        }else{
            description.innerText = "Genius !  " + totale;
        }
        showAnswers();
        stopCountDown();
        setTimeout(function(){
            navigation(2);
        },3000);
    }else{
        if(submitedChoices.length != 0 || action == 'skip'){
            nextBtn.setAttribute('disabled' ,"");
            nextBtn.style.cursor = "no-drop";
            showAnswers();
            stopCountDown();
            setTimeout(function(){
                resetAnswers();
                startCountDown();
                setQ();
                progresse();
                nextBtn.removeAttribute('disabled' ,"");
                nextBtn.style.cursor = "pointer";
            },3000);
            
            
        }
    }
}
function setQ(){
    answerContainer.innerHTML = "";
    questionIndex +=1;
    question.innerText = questions[questionIndex]['question'];

    Object.entries(questions[questionIndex]).forEach(q =>{
        const [key , value ] = q;
        if(key.includes('choice')){

            let answerDiv = document.createElement('div');
            answerDiv.setAttribute('class','answer');
            let paragraph = document.createElement('p');
            let input = document.createElement('input');
            input.setAttribute('class','hidden');
            input.setAttribute('type','checkbox');
            input.setAttribute('name','choice');
            let span = document.createElement('span');
            span.innerText = value;
            let i = document.createElement('i');
            i.setAttribute('class','answer-icon fas');

            paragraph.appendChild(input);
            paragraph.appendChild(span);
            answerDiv.appendChild(paragraph);
            answerDiv.appendChild(i);
            answerContainer.appendChild(answerDiv);
        }
    });

    answers = [...document.querySelectorAll('.answer')];
    answers.forEach(element =>{
        element.addEventListener('click',(e) =>{
            element.classList.toggle('selected');
            const check = element.querySelector('input');
            check.checked = check.checked ^ true;
        })
    });
}
function answerChecked(){
    const choices = [...document.querySelectorAll('input[name="choice"]')]
    let selectedChoices = [];
    for(ch of choices){
        if(ch.checked){
            selectedChoices.push(choices.indexOf(ch)+1);
        }
    }
    return selectedChoices;
}
function calculScore(submitedAnswers){
    let correctAnswers = questions[questionIndex]['answer'];

    let allCorrect = false;
    if(correctAnswers.length == submitedAnswers.length){
        for( ansr of submitedAnswers){
            if(!correctAnswers.includes(ansr)){
                allCorrect = false;
                break;
            }else{
                allCorrect = true;
            }
        }
    }
    if(allCorrect){
        score += percentagePerQuestion;
    }
}
function showAnswers(){
    let correctAnswers = questions[questionIndex]['answer'];
    let answerNumber;
    for(ansr of answers){
        answerNumber = answers.indexOf(ansr) + 1;
        if(correctAnswers.includes(answerNumber)){
            ansr.classList.add('correct-answer')
            ansr.querySelector('i').classList.add('fa-check')
        }else{
            ansr.classList.add('wrong-answer')
            ansr.querySelector('i').classList.add('fa-xmark')
        }
    }
}
function resetAnswers(){
    for(ansr of answers){
        ansr.classList.remove('selected')
        ansr.querySelector('input').checked = false;
        ansr.classList.remove('correct-answer')
        ansr.querySelector('i').classList.remove('fa-check')
        ansr.classList.remove('wrong-answer')
        ansr.querySelector('i').classList.remove('fa-xmark')
    }
}
function restart(){
    questionIndex = -1;
    score = 0;
    resetAnswers();
    startQuiz();
}


