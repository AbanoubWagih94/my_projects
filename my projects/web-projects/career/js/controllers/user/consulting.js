app.controller('Consulting',['$scope', 'Api', function ($scope, Api) {
    $scope.url = $scope.apiURL+"?consults="+localStorage.getItem("userId");
    $scope.subData = null;
    $scope.hideInfo = true;
    $scope.addMode = false;
    $scope.pageStatic = {
        ar:{
            title:"الإستشارات:",
            noData:"مرحبا في قسم الإستشارات اضف سؤالا ليتم الإجابه عليه من قبل المختص!",
            submit: "إرسال",
            delete: "حذف",
            addQuestion: "إضافه سؤال",
            QA: "مشاهده الإجابه",
        },

        en:{
            title:"Consulting:",
            noData:"Welcome to consulting section add a question to be Answered by counselor",
            submit: "Submit",
            delete: "Delete",
            addQuestion: "Add Question",
            QA: "See Q&A",
        }

    };


    $scope.getData = function (url) {
        $scope.loading = true;
        Api.getData(url).success(function (d) {
            if(angular.isArray(d)){
                $scope.data = d;
            }else{
                console.log("err");
            }
            $scope.loading = false;
        }).error(function (err) {
            console.log(err);
        });
    };
    $scope.seeQuestion = function (d) {
        $scope.subData = d;
        $scope.hideInfo = false;
    };

    $scope.addQuestion = function () {
        $scope.loading = true;
        if(!$scope.addMode)
            return false;
        
        $scope.subData = {
            user_id : $scope.userData.id,
            user_name : $scope.userData.name,
            question : $scope.subData.question
        };

        Api.postData($scope.apiURL, false, $scope.subData, "addQuestion")
            .success(function (d) {
                if(d.toLowerCase() === "ok") {
                    $scope.success = true;
                    if($scope.addMode)
                    {
                        $scope.data.push($scope.subData);
                        $scope.getData($scope.url);
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