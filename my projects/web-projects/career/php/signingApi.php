<?php
require_once "controller.php";

function check($field, $arg){
    $res = count(db::select_condition($field, 'userdata', "$field='$arg'"));
    echo $res? 1 : 0;
}

if (isset($_GET['userCheck'])){
    check('name', $_GET['userCheck']);
}
else if(isset($_GET['logged'])){
    if($_SESSION['user']){
        echo"ok";
    }else{
        echo"no";
    }
}
else if(isset($_GET['mailCheck'])){
    check('mail', $_GET['mailCheck']);
}

else if(isset($_POST['signUp'])){
    $_POST['signUp']['password'] = md5($_POST['signUp']['password']);
    if(
        Controller::changeDataBase('userdata',$_POST['signUp'],array('name', 'password', 'mail', 'phone'),false, 2)
        &&
        Controller::changeDataBase('userresults',$_POST['signUp'],array('name'),false, 2)){
        echo "ok";
    }else{
        db::delete('userdata', "WHERE name=".$_POST['name']);
        db::delete('userresults', "WHERE name=".$_POST['name']);
        echo "error";
    }
}

else if(isset($_POST['signIn'])){
    $_POST['signIn']['password'] = md5($_POST['signIn']['password']);
    Controller::signIn($_POST['signIn']['name'] , $_POST['signIn']['password']);

}

else if(isset($_POST['addContact'])){
    Controller::changeDataBase('contact', $_POST['addContact'], array('fullName', 'email', 'notes'));
}

else{
    echo "error";
}