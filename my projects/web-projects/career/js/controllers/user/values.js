app.controller("Values", ['$scope', 'Api', '$location', function($scope, Api, $location){
    if($scope.userData.value)
        $location.path('/done');

    $scope.url = "data/assessment/values-"+$scope.lang+".json";
    $scope.scores = [];
    $scope.excellence = [];

    $scope.pageStatics = {
        toExcellence: {
            ar:"قيمة تحبها",
            en:"Value you love"
        },
        skillLevel:{
            ar:"إلي اى مدى تهتم ب؟",
            en:"How much do you care about?"
        },
        intro:{
            ar:"ترد هنا ادناه القيم المرتبطة بالعمل قم بتعيين مدى أهمية كل قيمة بالنسبة لك مع العلم بأن :",
            en:"Here are listed below work-related set how important each value values for you with the knowledge that:"
        },
        fli:{
            ar: "1 = تجنب التعامل مع أصحاب هذه السمة",
            en: "1 = avoid dealing with the owners of this attribute"
        },
        sli:{
            ar: "2 = ليس مهما",
            en: "2 = not important"
        },
        tli:{
            ar: "3 =  مهم بعض الشئ",
            en: "3 = somewhat important"
        },
        foli:{
            ar: "4 = مهم جدا",
            en: "4 = very important"
        },
        fili:{
            ar: "5 = مهم جدا جدا",
            en: "5 = very very important"
        },
        endi:{
            ar:"اغلق الإرشادات لبداية الاختبار",
            en:"Close the instructions to begin the test."
        }
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

    $scope.calculateResults = function () {
        //$scope.loading = true;
        var ex = [];
        for(var i = 0; i < $scope.excellence.length; i++){
            if($scope.excellence[i]){
                $scope.data[i].score = $scope.scores[i];
                ex.push({score:$scope.data[i].score, value:$scope.data[i].category});
            }
        }
        Api.postData($scope.apiURL, $scope.userData.name, {"value":JSON.stringify(ex)}, "userResults")
            .success(function (d) {
               if(d.toLowerCase() === "ok"){
                    $scope.userData.value = 1;
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
                for(var i=0; i < $scope.data.length; i++){
                    $scope.scores[i] = 0;
                }
            }else{
                console.log(d);
            }
            $scope.loading = false;
        }).error(function (err) {
            console.log(err);
        });
    };
    $scope.getData($scope.url);

}]);
