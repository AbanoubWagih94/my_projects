<?php
require_once "controller.php";

if(!isset($_SESSION['user'])){
    die("You aren't logged in");
}



if(isset($_GET['getUserData'])){
    $res = db::select_all('userdata','id='.$_SESSION['user'][0]['id']);
    echo json_encode($res[0]);
}
else if(isset($_GET['lectures'])){

    Controller::getComplex('lectures', 'liveLectures.json', 'old', 'live');

}

else if(isset($_GET['consults'])){
    echo json_encode(db::select_all('questions',"user_id=".$_GET['consults']));
}

else if(isset($_POST['delete']) && $_POST['table']){

    $res = db::delete($_POST['table'], "id=".$_POST['delete']);
    Controller::checkDataBase($res);

}

else if(isset($_POST['addQuestion'])){
    Controller::changeDataBase('questions', $_POST['addQuestion'], array('user_id', 'user_name', 'question'));
}

else if(isset($_POST['userResults']) && isset($_POST['id'])){
    $arrayKeys = array_keys($_POST['userResults']);
    if(strlen($_POST['userResults'][$arrayKeys[0]]) === 1)
    {
        $userdata[$arrayKeys[0]] = $_POST['userResults'][$arrayKeys[0]];

    }else{
        $userdata[$arrayKeys[0]] = 1;
    }
    if(
        Controller::changeDataBase('userdata', $userdata, $arrayKeys, array('name',$_POST['id']), 2)
        &&
        Controller::changeDataBase('userresults', $_POST['userResults'], $arrayKeys, array('name',$_POST['id']), 2)){
        echo "ok";
    }else{
        echo "error";
    }

}

else if(isset($_POST['updateUserData']) && isset($_POST['id'])){
    
    $_POST['updateUserData']['password'] = md5($_POST['updateUserData']['password']);
    Controller::changeDataBase('userdata', $_POST['updateUserData'], array('password'), $_POST['id']);

}

else if(isset($_POST['reserve']) && isset($_POST['id'])){
    
        Controller::changeDataBase('userresults', $_POST['reserve'], array('reserved'), array('name', $_POST['id']));
    
}

else{
    echo "error";
}