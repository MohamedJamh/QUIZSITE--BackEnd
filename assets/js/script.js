// "use strict";

const steps = [...document.getElementsByClassName('step')];
const stepper = [...document.getElementsByClassName('navs')];
const timer = document.querySelector('#timer');
const question = document.querySelector("#question");
const progresseBar = document.getElementById("progressBar");
const nextBtn = document.getElementById("nextBtn");
const finalScore = document.getElementById("finalScore");
const description = document.getElementById("description");
var logContainer = document.getElementById("log");
var answerContainer = document.getElementById('answerContainer');
var questions;
var percentagePerQuestion;
var answers;
var questionSeconds;
var counterFunction;
var questionIndex = -1;
var currentPageIndex = 0;
var score = 0;
var log = [];

$.ajax({
    url: `./assets/data/quizdata.php`,
    dataType: "json",
    success: (data) => {
        questions = data;
        percentagePerQuestion = (1 * 100) / questions.length;
    }
});

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
    questionSeconds = 30;
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
    saveAnswer(submitedChoices);
    if(questionIndex + 1 == questions.length){
        $.post("controllers/quiz.controller.php",
        {
            correction:true
        },
        function(data,status){
            calculScore(data);
            let totale =  (score / percentagePerQuestion) + "/" + questions.length ;
            finalScore.innerText = Math.trunc(score) + "%";
            if (score < 50) {
                description.innerText = "Good luck next time You Got:  " + totale;
            } else if(50 <= score && score <= 70 ){
                description.innerText = 'Amazing score !  ' + totale;
            }else{
                description.innerText = "Genius !  " + totale;
            }

            $.post("controllers/quiz.controller.php",{quizScore : score});

            for(q of questions){

                let questionCorrection = document.createElement('div');
                questionCorrection.classList.add('question-correction');
                let questindiv = document.createElement('div');
                let questionParagraph = document.createElement('p');
                questionParagraph.innerText = q['question'];
                questindiv.appendChild(questionParagraph);
                questionCorrection.appendChild(questindiv);

                for(record of log){
                    for(rightAnswer of data){
                        if(q['id'] ==  record['id_question'] && q['id'] == rightAnswer['id_question']){
                            if(record['submited_answer'] == rightAnswer['correct_answer_order']){
                                for(singleAnswer of rightAnswer['correct_answer_order']){
                                    questionCorrection.innerHTML += `
                                        <div class='correct-answer'>
                                            <p>Correct answer:<i class='answer-icon fas fa-check'></i></p>
                                            <p>${q['choice'+singleAnswer]}</p>
                                        </div>
                                    `;
                                }
                            }else{
                                if(record['submited_answer'] == ''){
                                    questionCorrection.innerHTML += `
                                        <div class='wrong-answer'>
                                            <p>Your answer:<i class='answer-icon fas fa-xmark'></i></p>
                                            <p>No Answer Submited !</p>
                                        </div>
                                    `;
                                }else{
                                    for(singleAnswer of record['submited_answer']){
                                        questionCorrection.innerHTML += `
                                            <div class='wrong-answer'>
                                                <p>Your answer:<i class='answer-icon fas fa-xmark'></i></p>
                                                <p>${q['choice'+singleAnswer]}</p>
                                            </div>
                                        `;
                                    }
                                }
                                for(singleAnswer of rightAnswer['correct_answer_order']){
                                    questionCorrection.innerHTML += `
                                        <div class='correct-answer'>
                                            <p>Correct answer:<i class='answer-icon fas fa-check'></i></p>
                                            <p>${q['choice'+singleAnswer]}</p>
                                        </div>
                                    `;
                                }
                            }
                        }
                    }
                }
                logContainer.appendChild(questionCorrection);
            }

        },'json');
        stopCountDown();
        navigation(2);
    }else{
        if(submitedChoices.length != 0 || action == 'skip'){
            nextBtn.setAttribute('disabled' ,"");
            nextBtn.style.cursor = "no-drop";
            stopCountDown();
            resetAnswers();
            startCountDown();
            setQ();
            progresse();
            nextBtn.removeAttribute('disabled' ,"");
            nextBtn.style.cursor = "pointer";
            
        }
    }
}
function setQ(){
    answerContainer.innerHTML = "";
    questionIndex +=1;
    question.innerText = questions[questionIndex]['question'];
    Object.entries(questions[questionIndex]).forEach(q =>{
        const [key , value ] = q;
        if(key.includes('choice') && value != null){
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
    let selectedChoices = "";
    for(ch of choices){
        if(ch.checked){
            selectedChoices += choices.indexOf(ch)+1;
        }
    }
    return selectedChoices;
}
function saveAnswer(submitedAnswers){
    obj = [];
    obj["id_question"] = questions[questionIndex].id;
    obj["submited_answer"] = submitedAnswers;
    log.push(obj);
}
function calculScore(correctAnswers){
    for(record of log){
        for(rightAnswer of correctAnswers){
            if(record['id_question'] == rightAnswer['id_question'] && record['submited_answer'] == rightAnswer['correct_answer_order']){
                score += percentagePerQuestion;
            }
        }
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
    log = [];
    resetAnswers();
    startQuiz();
}


