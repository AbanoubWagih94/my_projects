app.controller("Lectures", ['$scope', 'Api', '$timeout', function ($scope, Api, $timeout) {
    $scope.url = $scope.apiURL+"?lectures";
    $scope.hideInfo = true;
    $scope.pageStatic = {
        ar:{
            oldTitle: "المحاضرات المسجلة:",
            liveTitle: "المحاضرات المباشرة:",
            liveInfo: "المحاضرة القادمة تعقد في: ",
            toLecture:"اضغط للذهاب الي المحاضرة"
        },
        en:{
            oldTitle: "Recorded Lectures:",
            liveTitle: "Live Lectures:",
            liveInfo: "Next lecture held on: ",
            toLecture:"Click to go to lecture"
        }
    };

    $scope.watchVideo = function (url) {
        //alert(url);
        $scope.videoUrl = url;
        $timeout(function(){
            $scope.hideInfo = !$scope.hideInfo;    
        },200);
        
    };

    $scope.getData = function (url) {
        $scope.loading = true;
        Api.getData(url).success(function (d) {
            if(angular.isObject(d)){
                $scope.data = d.old;
                $scope.liveLecture = JSON.parse(d.live);
            }else{
                console.log(d);
            }
            $scope.loading = false;
        }).error(function (err) {
            console.log(err);
        });
    };
    
    /*pagination*/
           $scope.math = window.Math;
       $scope.start = 0;
       $scope.variance = 8;
       var varianceCopy = 8;
       
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