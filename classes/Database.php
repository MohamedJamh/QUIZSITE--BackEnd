<?php

class DataBase {
    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $dbname = "quizsite";

    static function connect() {
        try {
            $cnx_string = "mysql:host=".self::$servername.";dbname=".self::$dbname;
            $cnx = new PDO($cnx_string,self::$username,self::$password);
            return $cnx;
        } catch (Exception $e) {
            echo 'something went wrong';
        }
    }

}