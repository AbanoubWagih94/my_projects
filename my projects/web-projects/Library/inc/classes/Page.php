<?php
if(!defined("__CONFIG__")){
    exit("You don\'t have config file");
}

class Page
{
    public static function ForceLogin(){
        if (isset($_SESSION['user_id'])) {
            header("Location: /library/mainPage.php");
            exit();
        }
    }

    public static function ForceLogout(){
        if (!isset($_SESSION['user_id'])) {
            header("Location: /library/index.php");
            exit();
        }
    }
}