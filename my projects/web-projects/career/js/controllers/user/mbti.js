app.controller("Mbti", ['$scope', 'Api', '$location', function($scope, Api, $location){
    if($scope.userData.mbti)
        $location.path('/done');
    $scope.url = "data/assessment/mbti-"+$scope.lang+".json";
    $scope.pageStatic = {
        ar:{
            intro:"عزيزى / عزيزتى قم بإختيار الإختيار الاول او الثانى بما يعبر عنك مع العلم بأنه لا يوجد إجابة صحيحة وآخرى خاطئة وكلما كنت أمينا مع نفسك كلما كانت النتائج دقيقة. أجب بما هو واقع الآن ليس بما تود أن يعرفه عنك أصدقائك حتى يمكننا تحديد طبيعة شخصيتك بدقة.",
            },

        en:{
            intro:"Please check A or B for each question. The more honest you are with yourself on your answers, the more accurate the results will be. If you really have trouble deciding on an answer, just pick one choice. The collective set will reveal your true nature.",
           }

    };
    $scope.results = {
        EI:[],
        SN:[],
        TF:[],
        JP:[],
    };

    $scope.calculateResults = function () {
        $scope.loading = true;
        var personality = "";
        for(var i in $scope.results){
            var a = 0 , b = 0;
            for(var j = 0; j<$scope.results[i].length; j++){
                if($scope.results[i][j] === 'a')
                    a++;
                else if($scope.results[i][j] === 'b')
                    b++;
            }
            if(a > b)
                personality += i[0];
            else
                personality += i[1];

        }
        Api.postData($scope.apiURL, $scope.userData.name, {"mbti":personality}, 'userResults')
            .success(function (d) {
               if(d.toLowerCase() === "ok"){
                   $scope.userData.mbti = 1;
                   $location.path('/done');
               }else{
                   $scope.failed = true;
               }
               $scope.loading = false;
            })
            .error(function () {
                $scope.failed = true;
                $scope.loading = false;
            });

    };
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

    $scope.countTrue = function (arr) {
        var ret = 0;
        for(var i = 0; i < arr.length; i++)
        {
            if(arr[i])
            {
                ret++;
            }
        }
        return ret;
    };

    $scope.getData($scope.url);
}]);