var app = angular.module("App",["ngRoute","ngFileUpload","ngAnimate"]);

app.config(function($routeProvider) {
    $routeProvider
        .when("/home", {
            templateUrl:'views/admin/homeEdit.html',
            controller:'Home'
        })
        .when("/about", {
            templateUrl:'views/admin/edit.html',
            controller:'Edit'
        })
        .when("/services", {
            templateUrl:'views/admin/edit.html',
            controller:'Edit'
        })
        .when("/ourwork", {
            templateUrl:'views/admin/edit.html',
            controller:'Edit'
        })
        .when('/contact',{
            templateUrl:'views/admin/contact.html',
            controller:'Contact'
        })
        .when('/usersResults',{
            templateUrl:'views/admin/users-results.html',
            controller:'UsersResults'
        })
        .when('/usersResults/:id',{
            templateUrl:'views/admin/users-results-details.html',
            controller:'UsersResultsDetails'
        })
        .when('/questions',{
            templateUrl:'views/admin/questions.html',
            controller:'Questions'
        })
        .when('/lectures-edit',{
            templateUrl:'views/admin/lectures-edit.html',
            controller:'LecturesEdit'
        })
        .otherwise(
        {redirectTo : '/home'}
    );
});