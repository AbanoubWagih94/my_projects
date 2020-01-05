app.controller("UsersResults",['$scope', 'Api', function ($scope, Api) {
    $scope.url = $scope.apiURL+"?userResults";
    $scope.subData = {};
    
    $scope.markSeen = function(id, data){
        $scope.operationWait = true;
        Api.postData($scope.apiURL, id, {seen:1}, "markSeen")
        .success(function(d){
                if(d.toLowerCase() === "ok"){
                    $scope.success = true;
                    var ind = $scope.data.indexOf(data);
                    $scope.data[ind].seen = 1;
                }else{
                    $scope.failed = true;
                }
                $scope.operationWait = false;
            })
        .error(function(){
                $scepe.operationWait = false;
                $scope.failed = true;
            });
    };

    $scope.getData = function (url) {
        $scope.loading = true;
        Api.getData(url).success(function (d) {
            if(angular.isArray(d)){
                $scope.data = d;
            }else{
                //error page redirection
                $scope.data = "error getting these data";
            }
            $scope.loading = false;
        }).error(function () {
            //error page redirection
        });
    };
       /*pagination*/
        $scope.math = window.Math;
        $scope.start = 0;
        $scope.variance = 5;
        var varianceCopy = 5;
        
        $scope.changeStart = function(change){
         if(change === "add"){
            if($scope.start + $scope.variance <= $scope.data.length){
                 $scope.start += $scope.variance;
            }
         }else{
            if($scope.start - $scope.variance >= 0){
                 $scope.start -= $scope.variance;
            } 
         }
         };
         
         $scope.setFilter = function (q){
             if(q.length)
             {
                 $scope.variance = $scope.data.length;
                 $scope.start = 0;
             }else{
                 $scope.variance = varianceCopy;
             }
         };
        /*end pagination*/

    $scope.getData($scope.url);
}]);