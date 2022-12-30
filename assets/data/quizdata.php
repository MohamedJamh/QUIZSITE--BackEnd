<?php
session_start();

if(isset($_SESSION['user']) && isset($_SESSION['quizdata'])){
    echo $_SESSION['quizdata'];
    // header("location: ../../quiz.php");
}else{
    header("location: ../../index.php");
}
