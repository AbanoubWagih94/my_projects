<?php

    define("__CONFIG__", true);
    require_once '../inc/config.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        header("Content-Type: application/json");

        $return = [];

        $email = Filter::String($_POST['email']);

        $findUser = User::findUser($email, true);
        if($findUser) {
            $hash = $findUser->password;
            $password = $_POST['password'];

            if(password_verify($password, $hash)) {
                $return['is_logged_in'] = true;
                $return['redirect'] = '/library/mainPage.php?message=welcome';
                $_SESSION['user_id'] = (int)$findUser->user_id;
            } else {
                $return['error'] = "Invalid user email/password combo";}

        } else {
            $return['error'] = "You don\'t have any account";
            $return['is_logged_in'] = false;
        }
        echo json_encode($return, JSON_PRETTY_PRINT); exit();
    } else {
        exit("Invalid URL");
    }