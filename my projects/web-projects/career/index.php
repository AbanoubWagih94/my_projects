<?php
session_start();
if(isset($_SESSION['user'])){
    header('Location:user.php');
    die("Redirection Error");
}else{
    header('Location:site.php');
    die("Redirection Error");
}