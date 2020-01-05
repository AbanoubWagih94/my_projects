app.controller("Edit", ['$scope', 'Api', '$location', '$route', function ($scope, Api, $location, $route) {
    
    $scope.hideInfo = true;
    $scope.addMode = false;
    $scope.url = $scope.apiURL+"?page="+$location.path()+"-"+$scope.lang+".json";
    $scope.data = {};

    $scope.getData = function (url) {
        $scope.loading = true;
        Api.getData(url).success(function (d) {
            if(d != "error"){
                $scope.data = d;
            }else{
                console.log(d);
            }
            $scope.loading = false;
        }).error(function (err) {
            console.log(err);
        });
    };

    $scope.addNew = function () {
        if($scope.addMode && $scope.subData)
            try{
                $scope.data.data.push($scope.subData);
            }catch (e){
                $scope.data.data = [];
                $scope.data.data.push($scope.subData);
            }

        $scope.hideInfo = true;
        console.log($scope.subData);
    };

    $scope.edit = function (ind) {
        $scope.subData = $scope.data.data[ind];
        $scope.hideInfo = false;
        $scope.addMode = false;
    };

    $scope.delete = function (ind) {
        $scope.data.data.splice(ind,1);
    };
    $scope.updateImg = function (file, err) {
        $scope.imgUpload = true;
        Api.uploadMedia($scope.apiURL,file).
        success(function (d) {
            if(d.toLowerCase() != "error")
            {
                $scope.imgUpload = false;
                $scope.subData.img = d;
            }
        });
    };

    $scope.cancel = function () {
        $route.reload();
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