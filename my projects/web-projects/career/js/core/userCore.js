app = angular.module("App", ['ngRoute', 'ngFileUpload','ngAnimate']);

app.config(function ($routeProvider) {
    $routeProvider
        .when('/home',{
            templateUrl:"views/user/user-data.html",
            controller:"Home"
        })
        .when('/mbti',{
            templateUrl: "views/user/mbti.html",
            controller: "Mbti"
        })
        .when('/holland',{
            templateUrl: "views/user/holland.html",
            controller: "Holland"
        })
        .when('/enneagram',{
            templateUrl: "views/user/enneagram.html",
            controller: "Enneagram"
        })
        .when('/enneagram/done',{
            templateUrl: "views/user/enneagram-results.html",
            controller: "EnneagramResults"
        })
        .when('/skills',{
            templateUrl: "views/user/skills.html",
            controller: "Skills"
        })
        .when('/values',{
            templateUrl: "views/user/values.html",
            controller: "Values"
            })
        .when('/done',{
            templateUrl: "views/user/results.html",
        })
        .when('/lectures',{
            templateUrl: "views/user/lectures.html",
            controller: "Lectures"
        })
        .when('/consulting',{
            templateUrl: "views/user/consulting.html",
            controller: "Consulting"
        })
        .otherwise(
        {
            redirectTo:'/home'
        }
    );
});