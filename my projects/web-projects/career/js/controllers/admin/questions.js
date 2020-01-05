app.controller('Questions',['$scope', 'Api', function ($scope, Api) {
    $scope.url = $scope.apiURL+"?questions";
    $scope.subData = null;
    $scope.hideInfo = true;
    
    $scope.timeStamp = function(d){
        return new Date(d).getTime();
    };
    
    $scope.getData = function (url) {
        $scope.loading = true;
        Api.getData(url)
            .success(function (d) {
            if(angular.isArray(d)){
                $scope.data = d;
            }else{
                console.log(d);
            }
            $scope.loading = false;
            })
            .error(function (err) {
            console.log(err);
        });
    };

    $scope.seeQuestion = function (d) {
        $scope.subData = d;
        $scope.hideInfo = false;
    };

    $scope.answerQuestion = function (id, data) {
        $scope.loading = true;
        data.answered = 1;
        Api.postData($scope.apiURL, id, data, "editQuestion")
            .success(function (d) {
                if(d.toLowerCase() === 'ok') {
                    $scope.success = true;
                    
                }else{
                    $scope.failed = true;
                }
                $scope.hideInfo = true;
                $scope.loading = false;
            })
            .error(function () {
                $scope.loading = false;
                $scope.failed = true;
            });
    };
        $scope.uploaded = 0;
        $scope.hideUploader = true;
        
        $scope.uploadAnswer = function(file){
            $scope.hideUploader = false;
            Api.uploadMedia('php/adminApi.php', file).then(
                function(d){
                    if(d.statusText.toLowerCase() == 'ok')
                    {
                        $scope.subData.answer = d.data;
                        $scope.hideUploader = true;
                    }
                },function(e){
                    console.log(e);
                },
                function(ev){
                    $scope.uploaded = parseInt(ev.loaded/ev.total) * 100;
                }
            );
            
        };
    $scope.delete = function (id, data) {
        var conf = window.confirm("Are you sure you want to delete this question");
        if(conf) {
            $scope.operationWait = true;
            Api.deleteData($scope.apiURL, id, "questions")
                .success(function (d) {
                    if(d.toLowerCase() === "ok"){
                        var ind = $scope.data.indexOf(data);                        
                        $scope.data.splice(ind, 1);
                        $scope.success = true;
                        $scope.q = {};
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