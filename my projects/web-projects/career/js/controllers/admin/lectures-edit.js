app.controller('LecturesEdit',['$scope', 'Api', function ($scope, Api) {
    $scope.url = $scope.apiURL+"?edit_lectures";
    $scope.subData = null;
    $scope.addMode = false;
    $scope.hideInfo = true;
    $scope.data = [];
    $scope.getData = function (url) {
        $scope.loading = true;
        Api.getData(url).success(function (d) {
            if(angular.isObject(d)){
                $scope.data = d['old'];
                $scope.liveLecture =JSON.parse(d['live']);
                $scope.liveLecture.dateTime = new Date($scope.liveLecture.dateTime);
                $scope.liveLecture.active = ($scope.liveLecture.active == 'true'? true : false);
            }else{
               console.log("err");
            }
            $scope.loading = false;
        }).error(function (err) {
            console.log(err);
        });
    };

    $scope.setLiveLecture = function () {
        try
        {
            $scope.liveLecture.timeStamp = $scope.liveLecture.dateTime.getTime();
        }catch(e){
            $scope.liveFailed = true;
        }
        Api.postData($scope.apiURL, "/liveLectures.json", $scope.liveLecture)
            .success(function (d) {
                if(d.toLowerCase() === "ok"){
                    $scope.liveOk = true;
                }else{
                    $scope.liveFailed = true;
                }
            })
            .error(function () {
                $scope.liveFailed = true;
            });
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

    $scope.editLecture = function (d) {
        $scope.subData = d;
        $scope.hideInfo = false;
    };

    $scope.addLecture = function (id, data) {
        $scope.loading = true;
        var mode = "";
        if($scope.addMode){
            mode = "addLecture";
        }else{
            mode = "editLecture";
        }
        Api.postData($scope.apiURL, id, data, mode)
            .success(function (d) {
                if(d.toLowerCase() === 'ok') {
                    $scope.success = true;
                    if($scope.addMode)
                    {
                        $scope.data.push($scope.subData);
                        $scope.addMode = false;
                    }
                }else{
                    $scope.failed = true;
                }
                $scope.hideInfo = true;
                $scope.loading = false;
            })
            .error(function () {
                $scope.failed = true;
                $scope.loading = false;
            });
    };

    $scope.delete = function (id, data) {

        var conf = window.confirm("Are you sure you want to delete this Lecture");
        if(conf) {
            $scope.operationWait = true;
            Api.deleteData($scope.apiURL, id, "lectures")
                .success(function (d) {
                    if(d.toLowerCase() === "ok"){
                        var ind = $scope.data.indexOf(data);
                        $scope.data.splice(ind, 1);
                        $scope.q = {};
                        $scope.success = true;
                    }else{
                        $scope.failed = true;
                    }
                    $scope.operationWait = false;
                })
                .error(function () {
                    $scope.failed = true;
                    $scope.operationWait = false;
                });
        }
    };
    /*pagination*/
        $scope.math = window.Math;
        $scope.start = 0;
        $scope.variance = 3;
        var varianceCopy = 3;
        
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