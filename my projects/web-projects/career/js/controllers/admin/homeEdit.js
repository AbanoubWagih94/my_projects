app.controller("Home", ['$scope', 'Api', '$location', function ($scope, Api, $location) {
    
    $scope.url = $scope.apiURL+"?page="+$location.path()+"-"+$scope.lang+".json";
    $scope.data = {};

    $scope.getData = function (url) {
        $scope.loading = true;
        Api.getData(url).success(function (d) {
            if(d != "error")
            {
                $scope.data = d;
                $scope.loading = false;
            }
        }).error(function (err) {
            console.log(err);
        });
    }


    $scope.updateImg = function (file, err) {
        $scope.imgUpload = true;
        Api.uploadMedia($scope.apiURL,file).
        success(function (d) {
            if(d.toLowerCase() != "error")
            {
                $scope.imgUpload = false;
                $scope.data.cover = d;
            }
        });
    };

    $scope.save = function () {
        $scope.opaerationWait = true;
        Api.postData($scope.apiURL,$location.path()+"-"+$scope.lang+".json",$scope.data)
            .success(function (d) {
                if(d.toLowerCase() === "ok")
                    $scope.success = true;
                else
                    $scope.failed = true;
                $scope.operationWait = false;
            })
            .error(function (err) {
                $scope.failed = true;
                $scope.operationWait = false;
            });
    };
    $scope.getData($scope.url);

}]);