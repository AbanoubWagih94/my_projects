<?php

    if(!defined("__CONFIG__")){
        exit("You don\'t have config file");
    }

    if(!isset($_SESSION)){
        session_start();
    }

    include_once 'classes/Filter.php';
    include_once 'classes/DB.php';
    include_once 'classes/User.php';
    include_once 'classes/Page.php';
    include_once 'classes/Book.php';
    include_once 'classes/Category.php';
    $con = DB::getConnection();