app.controller("Enneagram", ['$scope', 'Api', 'Helper', '$location', function($scope, Api, Helper, $location){
    if($scope.userData.enneagram)
        $location.path('/enneagram/done');
    $scope.url = "data/assessment/enneagram-"+$scope.lang+".json";
    $scope.pageStatic = {
        ar:{
            intro:"أشر إلى الإجابة التى تراها معبرة عنك فى كل فقرة بأغلب الأحيان.",
            introo:'فعلى سبيل المثال إذا شعرت أن جملة "إننى شخص ودود وإجتماعى" تعبر عنك أكثر من جملة "أنا خجول وهادئ" فاختر الجملة الأولى . في حين أنه من المؤكد أنك كنت خجولا وهادئاَ فى بعض الأوقات ولكننا إذا اخترنا بين الجملتين أيهما ستعبر عن سلوكك واتجاهك بدقة أكبر بأغلب الأحيان ؟'
            },

        en:{
            intro:"Check the statement that more true of you most of the time.",
            introo:'For example, if you feel that a statement such as "I have been friendly and outgoing" fits you better than "I have been shy and quiet," check the first statement. Of course, you may, at times have been somewhat shy and quiet, or you may not always have been friendly and outgoing. But if you were forced to choose between the two, which statement more accurately reflects your past general behavior and attitudes?'
           }

    };
    $scope.cat = [];
    $scope.calculateResults = function () {
        $scope.loading = true;
        var results = {
            A:0,
            B:0,
            C:0,
            D:0,
            E:0,
            F:0,
            G:0,
            H:0,
            I:0
        };
        for(var i=0; i<$scope.cat.length; i++){
            results[$scope.cat[i]] ++;
        }
        var personality = Helper.sortData(results)[0][1];
        Api.postData($scope.apiURL, $scope.userData.name, {"enneagram":personality}, "userResults")
            .success(function (d) {
                if(d.toLowerCase() === "ok"){
                    $scope.userData.enneagram = personality;
                    $location.path('/enneagram/done');
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