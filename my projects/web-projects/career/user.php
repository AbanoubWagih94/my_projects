<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location:index.php");
    die("Redirection error");
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Zad Career Counseling</title>

    <!--Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />

    <!--Boot Strap-->
    <link href='css/gloria.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--Custom CSS-->
    <link rel="stylesheet" type="text/css" href="css/user.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    
    <!--Icons--> 
    <link rel="shortcut icon" href="images/fev-icon.jpg">    
    <link rel="icon" href="images/fev-icon.jpg">
    
    <!--Angular-->
    <script src="js/angular/angular.js"></script>
    <script src="js/angular-route/angular-route.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.js"></script>

    <!--ngFileUpload-->
    <script src="js/ng-file-upload/dist/ng-file-upload-shim.min.js"></script> <!-- for no html5 browsers support -->
    <script src="js/ng-file-upload/dist/ng-file-upload.min.js"></script>

    <!--jQuery-->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.js"></script>

    <!--App core-->
    <script src="js/core/userCore.js"></script>

    <!--introControl-->
    <script src="js/shhi.js"></script>
</head>
<body ng-app="App" ng-controller="User">
    <div class="pre-loader" ng-hide="preLoader"><img src="images/loading.gif" class="center-block"></div>
<div class="container-fluid">
<div>
    <div id="logo" class="center-block">
    <div id="fore-logo"><img src='images/career.png' class="img-responsive"></div>
    <div id="back-logo"><img src='images/career1.png' class="img-responsive"></div>
</div>
    <span class="pull-right glyphicon glyphicon-menu-hamburger" id="small-list" ng-click="dropDownActive = 420"></span>
<header style="height:{{dropDownActive}}px;" id="small-header">
    <nav id="small-nav">
        <span id="close" class="close glyphicon glyphicon-remove" style="position: absolute; top: 10px; right: 10px;font-size: 2em;" ng-click="dropDownActive = 0;dropActiveSmall = 0"></span>
        <div class="cont">
            <a class="list-ele" ng-click="preLoader=true" href="site.php"><b>{{siteStatic[lang].visitor}}</b></a>
            <a class="list-ele" href="#/consulting" ng-class="{active: isActive('/about')}" ng-click="dropDownActive = 0"><b>{{siteStatic[lang].consulting}}</b></a>
            <a class="list-ele" href="#/lectures" ng-class="{active: isActive('/services')}" ng-click="dropDownActive = 0"><b>{{siteStatic[lang].lectures}}</b></a>
            <a class="list-ele" ng-click="dropActiveSmall = !dropActiveSmall;"><b>{{siteStatic[lang].tests}}</b></a>
            <div ng-show="dropActiveSmall" style="border-top:1px dashed white">
                <ul>
                    <li><a href="#/mbti" class="list-ele" ng-click="dropActiveSmall = false;dropDownActive = 0;">MBTI</a></li>
                    <li><a href="#/holland" class="list-ele" ng-click="dropActiveSmall = false;dropDownActive = 0">Holland's Code</a></li>
                    <li><a href="#/enneagram" class="list-ele" ng-click="dropActiveSmall = false;dropDownActive = 0">Enneagram</a></li>
                    <li><a href="#/skills" class="list-ele" ng-click="dropActiveSmall = false;dropDownActive = 0">Skills</a></li>
                    <li><a href="#/values" class="list-ele" ng-click="dropActiveSmall = false;dropDownActive = 0">Values</a></li>
                </ul>
            </div>
            <a class="list-ele pointer" href="logout.php" ng-class="{active: isActive('/ourwork')}" ng-click="dropDownActive = 0;"><b>{{siteStatic[lang].logout}}</b></a>
        </div>
            <span class="pull-right" style="padding: 10px">
                <img src="images/us.png" ng-click="changeLang('en')" class="pointer">|
                <img src="images/eg.png" ng-click="changeLang('ar')" class="pointer">
                <h4><a ng-click="dropDownActive=0;hideInfo = flase" class="text-primary pointer" style="color:white; background-color:deepskyblue;padding:2px; border-radius:5px; text-decoration:none;" href="#/home"><b>{{userData.name}}</b></a></h4>
            </span>
    </nav>
</header>
<header id="header">
    <nav id="nav">
        <div class="cont">
            <span class="pull-left" style="font-family: sans-serif; font-size: 1em;">
            <b>
            <span style="color:deepskyblue;font-size: 3em; font-weight: 1200;">Zad </span>
            Career Counseling
            </b>
            </span>
            <div ng-show="lang=='en'">
            <a class="list-ele pointer" href="logout.php"><b>{{siteStatic[lang].logout}}</b></a>
            <a class="list-ele" href="#/lectures" ng-class="{active: isActive('/services')}" ><b>{{siteStatic[lang].lectures}}</b></a>
            <a class="list-ele" href="#/consulting" ng-class="{active: isActive('/about')}" ><b>{{siteStatic[lang].consulting}}</b></a>
                <div class="list-ele pointer" style="position: relative">
                    <a ng-mouseenter="dropActiveLarge = true;"><b>{{siteStatic[lang].tests}}</b></a>
                    <ul ng-show="dropActiveLarge" class="sub-menu" ng-mouseleave="dropActiveLarge = false;">
                        <li><a href="#/mbti" class="list-ele" ng-click="dropActiveLarge = false">MBTI</a></li>
                        <li><a href="#/holland" class="list-ele" ng-click="dropActiveLarge = false">Holland's Code</a></li>                        
                        <li><a href="#/enneagram" class="list-ele" ng-click="dropActiveLarge = false">Enneagram</a></li>
                        <li><a href="#/skills" class="list-ele" ng-click="dropActiveLarge = false">Skills</a></li>
                        <li><a href="#/values" class="list-ele" ng-click="dropActiveLarge = false">Values</a></li>
                    </ul>
                </div>
            <a class="list-ele" ng-click="preLoader=true" href="site.php"><b>{{siteStatic[lang].visitor}}</b></a>
            </div>
            <div ng-show="lang=='ar'">
            <a class="list-ele" ng-click="preLoader=true" href="site.php"><b>{{siteStatic[lang].visitor}}</b></a>
            <a class="list-ele" href="#/consulting" ng-class="{active: isActive('/about')}" ><b>{{siteStatic[lang].consulting}}</b></a>
                <div class="list-ele pointer" style="position: relative">
                    <a ng-mouseenter="dropActiveLarge = true;"><b>{{siteStatic[lang].tests}}</b></a>
                    <ul ng-show="dropActiveLarge" class="sub-menu" ng-mouseleave="dropActiveLarge = false;">
                        <li><a href="#/mbti" class="list-ele" ng-click="dropActiveLarge = false">MBTI</a></li>
                        <li><a href="#/holland" class="list-ele" ng-click="dropActiveLarge = false">Holland's Code</a></li>                        
                        <li><a href="#/enneagram" class="list-ele" ng-click="dropActiveLarge = false">Enneagram</a></li>
                        <li><a href="#/skills" class="list-ele" ng-click="dropActiveLarge = false">Skills</a></li>
                        <li><a href="#/values" class="list-ele" ng-click="dropActiveLarge = false">Values</a></li>
                    </ul>
                </div>
            <a class="list-ele" href="#/lectures" ng-class="{active: isActive('/services')}" ><b>{{siteStatic[lang].lectures}}</b></a>
            <a class="list-ele pointer" href="logout.php"><b>{{siteStatic[lang].logout}}</b></a>
            </div>
        </div>
            <span class="pull-right" style="direction: rtl; padding: 5px 10px 5px 0; margin-right:5%;">
                <span style="color:white;font-size:13px;"><b>{{siteStatic[lang].selectLang}}</b></span><br>
                <img src="images/us.png" ng-click="changeLang('en')" style="margin-left: 20px;" class="pointer">|
                <img src="images/eg.png" ng-click="changeLang('ar')" style="margin-left: 20px;" class="pointer">
                <h4><a ng-class="{active: isActive('/home')}" style="color:white; background-color:deepskyblue; border-radius:5px; padding:4px;" ng-click="hideInfo = flase" class="btn btn-info" href="#/home"><b>{{userData.name}}</b></a></h4>
            </span>
    </nav>

</header>
<div id="main" ng-view ng-class="{ar : lang == 'ar'}"></div>
    </div>

    <!--Custom Js   -->
    <script src="js/logo.js"></script>
    <!--Controllers-->
    <script src="js/controllers/user/mbti.js"></script>
    <script src="js/controllers/user/mbti-results.js"></script>
    <script src="js/controllers/user/holland.js"></script>
    <script src="js/controllers/user/enneagram.js"></script>
    <script src="js/controllers/user/enneagram-results.js"></script>
    <script src="js/controllers/user/skills.js"></script>
    <script src="js/controllers/user/values.js"></script>
    <script src="js/controllers/user/user.js"></script>
    <script src="js/controllers/user/lectures.js"></script>
    <script src="js/controllers/user/consulting.js"></script>
    <script src="js/controllers/user/home.js"></script>
    <!--Services-->
    <script src="js/services/helper.js"></script>
    <script src="js/services/api.js"></script>
    <script src="js/services/holland-helper.js"></script>
    <script src="js/services/signup-err.js"></script>
</body>
</html>