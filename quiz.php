<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web page that provides a quiz in php fundamentals">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" ></script>
    <title>Quizsite</title>
</head>
<body>
    <header>
        <div class="stepper">
            <span class="navs fa-solid fa-info active"></span>
            <span class="navs fa-solid fa-code"></span>
            <span class="navs fa-solid fa-list-check"></span>
        </div>
        <div class="timer">
            <span id="timer" class="seconds">--</span>
            <span id="clock" class="icon fas fa-clock"></span>
        </div>
    </header>
    <div class="step">
        <div class="container">
            <div class="greeting">
                <h1>Welcome to <span>PHP Quiz</span>!</h1>
                <p>Improve Your Skills In <span>PHP</span> And Become a Master With Quizsite</p>
                <ul>
                    <li>Each question has a time limit of 30 second</li>
                    <li>If you exceeded the time the answer is submited false</li>
                    <li>Your score will be shown at the end</li>
                    <li>Good luck and remember IF IT WORKS DON'T TOUCH IT</li>
                </ul>
                <button class="btn" onclick="startQuiz();">Get Started</button>
            </div>
        </div>
    </div>
    <div class="step hidden">
        <div class="container">
            <div class="questions">
                <div class="header">
                    <p id="question">This a question Lorem ?</p>
                </div>
                <div id="answerContainer" class="answers">
                    <!-- answers right here  -->
                </div>
                <div class="footer">
                    <div class="progress-bar">
                        <div id="progressBar"></div>
                    </div>
                    <button id="nextBtn" class="btn" onclick="nexQ();">Next</button>
                </div>
            </div>
        </div>
    </div>
    <div class="step hidden">
        <div class="container">
            <div class="result">
                <p>Your Score is :<span id="finalScore"></span></p>
                <small id="description">this is a description</small>
                <div class="footer">
                    <button class="btn" onclick="restart();">
                        <i class="fa-solid fa-repeat"></i>
                    </button>
                    <button class="btn" onclick="location.reload();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="./assets/js/data.js"></script> -->
    <script src="./assets/js/script.js"></script>
    <script>
        function test(i){
            $.ajax({
                url: `./assets/data/quizdata.php?quizid=`+i,
                dataType: "json",
                success: (data) => {
                    console.log('yey');
                    console.log(questions);
                    console.log(data);
                }
            });
        }
        
    </script>
</body>
</html>