<?php
require_once "controller.php";

if(isset($_GET['edit_lectures'])){

    Controller::getComplex('lectures', 'liveLectures.json', 'old', 'live');

}

else if(isset($_POST['d']) && isset($_POST['id'])){

    Controller::updateData($_POST['d'], $_POST['id']);

}

else if(isset($_FILES['file'])){

    Controller::uploadMedia($_FILES['file']);

}

else if(isset($_GET['page'])){

    Controller::getData($_GET['page']);

}

else if(isset($_GET['id']) && isset($_GET['lang'])){
    Controller::getComplex('userresults', 'assessment'.DIRECTORY_SEPARATOR.'skills-'.$_GET['lang'].'.json', 'db', 'file',"id=".$_GET['id']);
}

else if(isset($_GET['contact'])){

    $res = db::select_all('contact', 1);
    echo json_encode($res);

}

else if(isset($_GET['questions'])){

    $res = db::select_all('questions', 1);
    echo json_encode($res);

}

else if(isset($_GET['userResults'])){

    $res = db::select_condition('id,name,lang,reserved,seen','userresults', 1, "ORDER BY name ASC");
    echo json_encode($res);

}

else if(isset($_POST['markSeen']) && isset($_POST['id'])){
    
    Controller::changeDataBase('userresults', $_POST['markSeen'], array('seen'), $_POST['id']);
    
}

else if(isset($_POST['delete']) && $_POST['table']){

    $res = db::delete($_POST['table'], "id=".$_POST['delete']);
    Controller::checkDataBase($res);

}

else if(isset($_POST['editQuestion']) && isset($_POST['id'])){

    Controller::changeDataBase('questions', $_POST['editQuestion'], array("answer", "answered"), $_POST['id']);

}

else if(isset($_POST['addLecture'])){

    Controller::changeDataBase('lectures', $_POST['addLecture'], array("url", "title_ar", "title_en", "img"));
}

else if(isset($_POST['editLecture']) && isset($_POST['id'])){
    Controller::changeDataBase('lectures', $_POST['editLecture'], array("url", "title_ar", "title_en", "img"), $_POST['id']);
}

else if(isset($_GET['getContacts'])){
     $res = db::select_condition('phone,mail', 'userdata', "name='".$_GET['getContacts']."'");
      echo json_encode($res[0]);
}

else{
    echo "error";
}
