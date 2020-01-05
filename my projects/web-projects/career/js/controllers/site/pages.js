app.controller("Pages", ['$scope', '$location', '$http', function($scope, $location, $http){
    
    $scope.routeTo = function (url) {
        $scope.isLoading(true);
        $scope.url = 'data'+url+"-"+$scope.lang+'.json';
        $scope.state = $http.get($scope.url).success(function (d) {
            $scope.data = d;
            $scope.isLoading(false);
        }).error(function (err) {
            console.log(err);
        });
    };

    if($location.path() != '')
        $scope.routeTo($location.path());

}]);