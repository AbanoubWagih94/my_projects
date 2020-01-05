app = angular.module("App", ['ngRoute', 'ngFileUpload', 'ngAnimate']);

app.config(function ($routeProvider) {
    $routeProvider.when('/home',{
        templateUrl : 'views/site/home.html',
        controller : 'Pages'
    }).when('/about',{
        templateUrl : 'views/site/about.html',
        controller : 'Pages'
    }).when('/services',{
        templateUrl : 'views/site/services.html',
        controller : 'Pages'
    }).when('/ourwork',{
        templateUrl : 'views/site/ourwork.html',
        controller : 'Pages'
    }).otherwise(
        {
            redirectTo:'/home'
        }
    );
});