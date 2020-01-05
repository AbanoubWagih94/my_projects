<?php

    define('__CONFIG__', true);
    require_once '../inc/config.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        header("Content-Type: application/json");
        $return = [];

        $email = Filter::String($_POST['email']);
        $name = Filter::String($_POST['name']);

        $findUser = User::findUser($email, false);

        if($findUser){
            $return['error'] = "You already have account";
            $return['is_logged_in'] = false;
        } else {
            $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
            $addUser = $con->prepare("INSERT INTO app_users (email, name, password, privillege) VALUES (LOWER(:email), LOWER(:name) ,:password, 0)");
            $addUser->bindParam(':email', $email, PDO::PARAM_STR);
            $addUser->bindParam(':name', $name, PDO::PARAM_STR);
            $addUser->bindParam(':password', $password, PDO::PARAM_STR);
            $addUser->execute();

            $userId = $con->lastInsertId();
            $_SESSION['user_id'] = (int)$userId;

            $return['is_logged_in'] = true;
            $return['redirect'] = '/library/mainPage.php?message=welcome';
        }
        echo json_encode($return,JSON_PRETTY_PRINT); exit();
    } else {
        exit('Invalid URL');
    }