<?php
include "{$_SERVER['DOCUMENT_ROOT']}/QUIZSITE--BackEnd/classes/User.php";
include "{$_SERVER['DOCUMENT_ROOT']}/QUIZSITE--BackEnd/classes/Database.php";

session_start();

if(isset($_GET['addAccount'])) addAccount();
if(isset($_GET['quizid'])) getIntoQuiz();


if(isset($_GET['testdata'])) test();

function addAccount(){
    $username = htmlspecialchars($_GET['username']);
    $user = new User($username);
    $user->createAccount();
    $_SESSION['user'] = $user;
    header('location: ../index.php');
}

function getQuizes(){
    $user = new User('hamid');
    $quizes = $user->getAllQuizes();
    foreach ($quizes as $key => $value) {
        $id = $value['id'];
        $name = $value['name'];
        echo "
            <form action='quiz.php' method='GET' >
                <div class=''>
                    <img src='' alt=''>
                </div>
                <div class''>
                    <input type='text' value='$id' onlick=("test(i) name='quizid'>
                    <span>$name</span>
                    <button type='submit' >Get Into</button>
                </div>
            </form>
        ";
    }
    
}

function getIntoQuiz(){
    $quiz_id = $_GET['quizid'];
    $result = $_SESSION['user']->getQuiz($quiz_id);
    $_SESSION['quizdata'] = json_encode($result);
    header("location: ../assets/data/quizdata.php");
}
function test(){
    die;
    return 'yo';
}

