<?php

if(!defined("__CONFIG__")){
    exit("You don\'t have config file");
}

class DB
{
    protected static $con;

    private function __construct()
    {
        try{
            self::$con = new PDO("mysql:charset=utf8; host=localhost; port=3306; dbname=lotussol_library","lotussol_abanoub", "Abanoub123456",
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            )
            );
        } catch (PDOException $exception) {
            exit ('Could not connect to database');
        }
    }

    public static function getConnection(){
        if(!self::$con){
            new DB();
        }

        return self::$con;
    }
}