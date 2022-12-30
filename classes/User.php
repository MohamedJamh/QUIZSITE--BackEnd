<?php

class user{
    private $id;
    private $username;
    private $ip_adresse;
    private $mac_adresse;
    private $os;
    private $browser;


    function __construct($username){
        $this->username = $username;
    }

    public function getUsername(){
        return $this->username;
    }

    function createAccount(){
        try {
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
            select DISTINCT q.content as question,
            (select an.answer_content from answers as an where an.order like 1 AND an.id_question like q.id_question ) as choice1,
            (select an.answer_content from answers as an where an.order like 2 AND an.id_question like q.id_question ) as choice2,
            (select an.answer_content from answers as an where an.order like 3 AND an.id_question like q.id_question ) as choice3,
            (select an.answer_content from answers as an where an.order like 4 AND an.id_question like q.id_question ) as choice4,
            q.correct_answer_order as answer
            from quiz as quiz, answers as a, questions q
            where quiz.id = $idquiz
            AND quiz.id = q.id_quiz
            AND q.id_question  = a.id_question"
        );
        $result_quize = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result_quize;
    }
}