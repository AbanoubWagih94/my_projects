app.controller("Admin", ['$scope', '$route', '$location', function ($scope, $route) {
    $scope.siteStatic = {
      ar:{
          wait:"انتظر من فضلك....."
      },
        en:{
            wait:"please wait...."
        }
    };
    $scope.dropActive = true;
    $scope.imgBaseUrl = "images/";
    $scope.lang = "en";
    $scope.apiURL = 'php/adminApi.php';
    $scope.changeLang = function (x) {
        $scope.lang = x;
        $route.reload();
    };
    $scope.pri = function(){ 
        document.getElementById("titop").style.visibility='visible';
        document.getElementById("header").style.visibility='hidden';
        print();
        document.getElementById("titop").style.visibility='hidden';
        document.getElementById("header").style.visibility='visible';
    }
}]);
      