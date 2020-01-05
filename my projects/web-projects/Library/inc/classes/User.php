<?php

    if(!defined("__CONFIG__")){
        exit("You don\'t have config file");
    }

class User
{
    private  $con ;

    public $user_id;
    public $email;
    public $password;
    public $name;

    public  function __construct($user_id)
    {
        $this->con = DB::getConnection();
        $user_id = Filter::Int($user_id);
        $user = $this->con->prepare("SELECT user_id, name, email, password FROM app_users WHERE user_id = :user_id LIMIT 1");
        $user->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $user->execute();

        if($user->rowCount()){
            $user = $user -> fetch(PDO::FETCH_OBJ);

            $this->email = (string)$user->email;
            $this->user_id = (int)$user->user_id;
            $this->name = (string)$user->name;
            $this->password = (string)$user->password;
        } else {
            header("Location:/logout.php");
        }
    }

    public static function findUser($email, $return_assoc = false){
        $con = DB::getConnection();

        $email = Filter::String($email);

        $findUser = $con->prepare("SELECT user_id, password FROM app_users WHERE email =:email LIMIT 1");
        $findUser->bindParam(':email', $email);
        $findUser->execute();

        if($return_assoc) {
            return $findUser->fetch(PDO::FETCH_OBJ);
        }

        $user_found = (bool) $findUser->rowCount();
        return $user_found;
    }
}