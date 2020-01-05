app.controller("Home", ['$scope', 'Api', 'signUpErrApi', function ($scope, Api, signUpErrApi) {
    $scope.hide = true;
    $scope.updateData = function(){
        $scope.wait = true;
      Api.postData($scope.apiURL, localStorage.getItem('userId'), $scope.editData, 'updateUserData')
      .success(function(d){
        if(d.toLowerCase() === "ok")
            {
                $scope.getUserData();
                $scope.success = true;
            }else{
                $scope.failed = true;
            }
            $scope.wait = false;
        })
      .error(function(){
            $scope.failed = true;
            $scope.wait = false;
        });
    };
    $scope.ApiCall = function (func, params) {
        return signUpErrApi[func](params);
    };
    
        $scope.reserve = function(){
        $scope.reserveWait = true;
        Api.postData($scope.apiURL, $scope.userData.name, {reserved:1}, "reserve")
        .success(function(d){ 
                if(d.toLowerCase() === "ok"){
                    $scope.reserveSuccess = true;
                }else{
                    $scope.reserveFailed= true;
                }
                $scope.reserveWait = false;
            })
        .error(function(){
                $scepe.reserveWait = false;
                $scope.reserveFailed = true;
            });
    };
    
    $scope.getUserData();

}]);