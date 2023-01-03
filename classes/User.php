<?php

class user{
    private $id;
    private $username;
    private $ip_adresse;
    private $mac_adresse;
    private $os;
    private $browser;


    function __construct($username,$ip,$os,$browser){
        $this->username = $username;
        $this->ip_adresse = $ip;
        $this->os = $os;
        $this->browser = $browser;
    }

    public function getUsername(){
        return $this->username;
    }

    function createAccount(){
        try {
            echo $this->username;
            Database::connect()->exec("INSERT INTO `user`(`username`) VALUES ('$this->username')");
            $_SESSION['message'] = 'All good';
        } catch (\Throwable $th) {
            $_SESSION['message'] = 'Something Went Wrong';
        }
    }

    function getAllQuizes(){
        $req = Database::connect()->query("SELECT * FROM quiz");
        $result_quizes = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result_quizes;
    }
    function getQuiz($idquiz){
        $req = Database::connect()->query("
            select DISTINCT q.id_question as id, q.content as question,
            (select an.answer_content from answers as an where an.order like 1 AND an.id_question like q.id_question ) as choice1,
            (select an.answer_content from answers as an where an.order like 2 AND an.id_question like q.id_question ) as choice2,
            (select an.answer_content from answers as an where an.order like 3 AND an.id_question like q.id_question ) as choice3,
            (select an.answer_content from answers as an where an.order like 4 AND an.id_question like q.id_question ) as choice4
            from quiz as quiz, answers as a, questions q
            where quiz.id = $idquiz
            AND quiz.id = q.id_quiz
            AND q.id_question  = a.id_question"
        );
        $result_quize = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result_quize;
    }
    function quizAnswers($quiz_id){
        $sql = "SELECT `id_question`, `correct_answer_order` FROM `questions` WHERE  `id_quiz` = $quiz_id ;";
        $req = Database::connect()->query($sql);
        $result_correction = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result_correction;
    }
    function submitScore($id_quiz,$score,$ip,$os,$browser){
        $date = date('Y-m-d')." ".date("H:i:s");
        $sql = "INSERT INTO `history`(`username`,`id_quiz`, `score`, `date`, `ip_adresse`, `os`, `browser`) VALUES ('$this->username',$id_quiz,'$score','$date','$this->ip_adresse','$this->os','$this->browser');";
        $req = Database::connect()->query($sql);
    }
}

