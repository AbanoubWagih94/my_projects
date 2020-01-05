<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="ar">
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
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="icon" href="images/fev-icon.png">    
    
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
    <script src="js/core/siteCore.js"></script>

</head>
<body ng-app="App" ng-controller="Site">
<div class="pre-loader" ng-hide="preLoader"><img src="images/loading.gif" class="center-block"></div>
<div id="logo" class="center-block">
    <div id="fore-logo"><img src='images/career.png' class="img-responsive"></div>
    <div id="back-logo"><img src='images/career1.png' class="img-responsive"></div>
</div>
<span class="pull-right glyphicon glyphicon-menu-hamburger" id="small-list" ng-click="dropActive = 300"></span>
<header style="height:{{dropActive}}px;" id="small-header">
    <nav id="small-nav">
        <span id="close" class="close glyphicon glyphicon-remove" style="position: absolute; top: 10px; right: 10px;font-size: 2em;" ng-click="dropActive = 0"></span>
        <div class="cont">
            <a class="list-ele" href="#/home" ng-class="{active: isActive('/home')}" ng-click="dropActive = 0"><b>{{siteStatic[lang].home}}</b></a>
            <a class="list-ele" href="#/about" ng-class="{active: isActive('/about')}" ng-click="dropActive = 0"><b>{{siteStatic[lang].about}}</b></a>
            <a class="list-ele" href="#/services" ng-class="{active: isActive('/services')}" ng-click="dropActive = 0"><b>{{siteStatic[lang].services}}</b></a>
            <a class="list-ele" href="#/ourwork" ng-class="{active: isActive('/ourwork')}" ng-click="dropActive = 0"><b>{{siteStatic[lang].ourWork}}</b></a>
            <a class="list-ele" href="#/home#find" ng-click="dropActive = 0"><b>{{siteStatic[lang].contact}}</b></a>
        </div>

            <span class="center-block" style="padding: 10px;"> 
                <img src="images/us.png" ng-click="dropActive=0;changeLang('en')" class="pointer">|
                <img src="images/eg.png" ng-click="dropActive=0;changeLang('ar')" class="pointer">
                <?php
                if(!isset($_SESSION['user']))
                    {
                        echo '<h5><a ng-click="dropActive=0; hideInfo = flase" class="text-primary pointer"><b style="color:white; background-color:deepskyblue; border-radius:5px; padding:4px; text-decoration:none;">{{siteStatic[lang].login}}</b></a></h5>';
                    }else{
                        echo '<h5><a href="user.php" style="color:white; background-color:deepskyblue; border-radius:5px; padding:4px; text-decoration:none;">'.$_SESSION['user'][0]['name'].'</a></h5>'; 
                    }
                ?>
            </span>
    </nav>
</header>
<header id="header">
    <nav id="nav">
        <div class="cont">
         <span class="pull-left" style="font-family: sans-serif; font-size: 1em;">
         <b>
            <span style="color:deepskyblue;font-size: 3em;font-weight: 900;">Zad </span>
            Career Counseling
            </b>
        </span>
        <div ng-show="lang=='en'">
            <a class="list-ele" href="#/home#find"><b>{{siteStatic[lang].contact}}</b></a>
            <a class="list-ele" href="#/ourwork" ng-class="{active: isActive('/ourwork')}"><b>{{siteStatic[lang].ourWork}}</b></a>
            <a class="list-ele" href="#/services" ng-class="{active: isActive('/services')}" ><b>{{siteStatic[lang].services}}</b></a>
            <a class="list-ele" href="#/about" ng-class="{active: isActive('/about')}"><b>{{siteStatic[lang].about}}</b></a>
            <a class="list-ele" href="#/home" ng-class="{active: isActive('/home')}" ><b>{{siteStatic[lang].home}}</b></a>
        </div>
        <div ng-show="lang=='ar'">
            <a class="list-ele" href="#/home" ng-class="{active: isActive('/home')}" ><b>{{siteStatic[lang].home}}</b></a>
            <a class="list-ele" href="#/about" ng-class="{active: isActive('/about')}"><b>{{siteStatic[lang].about}}</b></a>
            <a class="list-ele" href="#/services" ng-class="{active: isActive('/services')}" ><b>{{siteStatic[lang].services}}</b></a>
            <a class="list-ele" href="#/ourwork" ng-class="{active: isActive('/ourwork')}"><b>{{siteStatic[lang].ourWork}}</b></a>
            <a class="list-ele" href="#/home#find"><b>{{siteStatic[lang].contact}}</b></a>
        </div>
        </div>
        <span class="pull-right" style="direction: rtl; padding: 5px 10px 5px 0; margin-right:5%;">
                <span style="color:white;font-size:13px;"><b>{{siteStatic[lang].selectLang}}</b></span><br>
                <img src="images/us.png" ng-click="changeLang('en')" style="margin-left: 20px;" class="pointer">|
                <img src="images/eg.png" ng-click="changeLang('ar')" style="margin-left: 20px;" class="pointer">
                <?php
                if(!isset($_SESSION['user']))
                    {
                        echo '<h5><a ng-click="dropActive=0;hideInfo = false" class="text-primary pointer" style="color:white; background-color:deepskyblue; border-radius:5px; padding:4px;"><b>{{siteStatic[lang].login}}</b></a></h5>';
                    }else{
                        echo '<h5><a href="user.php" style="color:white; background-color:deepskyblue; border-radius:5px; padding:4px;">'.$_SESSION['user'][0]['name'].'</a></h5>'; 
                    }
                ?>
            </span>
            
    </nav>
</header>
<div class="load" ng-show="loading" style="height: 550px">
    <img ng-src="{{imgUrl+'loading.gif'}}" class="img-responsive center-block">
</div>

<div class="hidden-info" ng-hide="hideInfo"> 
    <div id="login-form-wrapper">
        <button type="button" class="close text-danger" aria-label="Close" ng-click="hideInfo = true" style="position: absolute;right:10px "><span aria-hidden="true" style="font-size: 1em">&times;</span></button>
        <nav id="login-form" style="direction: ltr">
            <a ng-click="form(0)">{{siteStatic[lang].register}}</a>
            <a ng-click="form(1)">{{siteStatic[lang].login}}</a>
        </nav>
        <div id="border" style="left:{{border_pos}}"></div>
        <div ng-class="{ar : lang == 'ar'}">
            <br><br>
            <div class="alert alert-success fade in" ng-show="ApiCall('submit')">
                {{siteStatic[lang].submitErr}}
            </div>
            <form ng-submit="signUp()" ng-show="formShow[0] && !ApiCall('submit')" class="fading-form">
                <div class="form-group">
                    <label for="sName">{{siteStatic[lang].userName}}</label>
                    <input ng-model="userSignUp.name" type="text" class="form-control" id="sName" placeholder="{{siteStatic[lang].userName}}" ng-blur="ApiCall('checkUser', userSignUp.name)" required>
                    <br>
                    <div class="alert alert-danger fade in" ng-show="ApiCall('userLength')">
                        {{siteStatic[lang].userLengthErr}}
                    </div>
                    <div class="alert alert-danger fade in" ng-show="ApiCall('user')">
                        {{siteStatic[lang].userErr}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">{{siteStatic[lang].email}}</label>
                    <input ng-model="userSignUp.mail" type="email" class="form-control" id="email" placeholder="ex@ex.ex" ng-blur="ApiCall('checkMail', userSignUp.mail)" required>
                    <br>
                    <div class="alert alert-danger fade in" ng-show="ApiCall('mail')">
                        {{siteStatic[lang].mailErr}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">{{siteStatic[lang].phone}}</label>
                    <input ng-model="userSignUp.phone" type="tel" class="form-control" id="phone" placeholder="Mobile:010xxxxxxxx" ng-blur="ApiCall('checkPhone', userSignUp.phone)" required>
                    <br>
                    <div class="alert alert-danger fade in" ng-show="ApiCall('phone')">
                        {{siteStatic[lang].phoneErr}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="spw">{{siteStatic[lang].password}}</label>
                    <input ng-model="userSignUp.password" type="password" class="form-control" id="spw" placeholder="*******"  ng-blur="ApiCall('checkPw', userSignUp.password)" required>
                </div>
                <br>
                <div class="alert alert-danger fade in" ng-show="ApiCall('pw')">
                    {{siteStatic[lang].pwErr}}
                </div>
                <div class="form-group">
                    <label for="pwr">{{siteStatic[lang].passwordRepeat}}</label>
                    <input ng-model="userSignUp.passwordRepeat" type="password" class="form-control" id="pwr" placeholder="*******" ng-blur="ApiCall('checkPws', [userSignUp.password, userSignUp.passwordRepeat])" required>
                    <br>
                    <div class="alert alert-danger fade in" ng-show="ApiCall('pws')">
                        {{siteStatic[lang].pwsErr}}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" ng-disabled="(ApiCall('pw') || ApiCall('pws') || ApiCall('mail') || ApiCall('user') || ApiCall('phone'))"><span class="glyphicon glyphicon-send" ></span> {{siteStatic[lang].submit}}</button>
                <div class="alert alert-info fade in" ng-show="signUpWait">
                    {{siteStatic[lang].wait}}
                </div>
            </form>

            <form ng-submit="signIn()" ng-show="formShow[1]" class="fading-form">
                <div class="form-group">
                    <label for="lname">{{siteStatic[lang].userName}} / {{siteStatic[lang].email}} </label>
                    <input ng-model="userSignIn.name" type="text" class="form-control" id="lname" placeholder="{{siteStatic[lang].userName}}" required>
                </div>

                <div class="form-group">
                    <label for="lpw">{{siteStatic[lang].password}}</label>
                    <input ng-model="userSignIn.password" type="password" class="form-control" id="lpw" placeholder="*******" required>
                </div>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> {{siteStatic[lang].submit}}</button>
                <br><br>
                <div class="alert alert-danger fade in" ng-show="signInError">
                    <a class="close" aria-label="close" ng-click="signInError = false">&times;</a>
                    {{siteStatic[lang].signInError}}
                </div>
                <div class="alert alert-info fade in" ng-show="signInWait">
                    {{siteStatic[lang].wait}}
                </div>
                <div class="alert alert-success fade in" ng-show="signInSuccess">
                    {{siteStatic[lang].signInSuccess}}
                </div>
            </form>
        </div>
    </div>
</div>
<div id="main" ng-view class="container-fluid"></div>
<footer class="container-fluid">
    <nav class="center-block" id="social">
        <a href="https://www.facebook.com/Zad.Career.Counseling" target="_blank" class="face"><i class="fa fa-facebook-square"></i></a>
        <a href="#" class="twit"><i class="fa fa-twitter-square"></i></a>
        <a href="https://www.youtube.com/channel/UCGdpDnaoTwh1Knf3FJ9gLKA" class="you"><i class="fa fa-youtube"></i></a>
    </nav>
    <pre class="footer" style="color:white;">©created by A3 team</pre>
</footer>
<script src="js/logo.js"></script>
<!--Controllers-->
    <script src="js/controllers/site/site.js"></script>
    <script src="js/controllers/site/pages.js"></script>
<!--Services-->
    <script src="js/services/api.js"></script>
    <script src="js/services/signup-err.js"></script>
</body>
</html>