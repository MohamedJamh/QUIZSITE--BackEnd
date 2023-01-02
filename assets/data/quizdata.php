<?php
require_once '../../controllers/quiz.controller.php';


if(isset($_SESSION['user']) && isset($_SESSION['quizid'])){
    $quiz_id = $_SESSION['quizid'];
    $result = $_SESSION['user']->getQuiz($quiz_id);
    echo json_encode($result);
}else{
    header("location: ../../index.php");
}
