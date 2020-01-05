app.controller("Holland", ['$scope', 'Api', 'HollandHelper', '$location', function($scope, Api, HollandHelper, $location){
    if($scope.userData.holland)
        $location.path('/done');
    $scope.pageStatic = {
      ar:{
            title:"بعد قراءة كل عبارة من العبارات التالية  ضع علامة أمام العبارة التى تعبر عنك هل تحب:"
        },
        en:{
            title:"Check the items that best describe you"
        }
    };
    $scope.url = "data/assessment/holland-"+$scope.lang+".json";
    $scope.checked = [];

    $scope.calculateResults = function () {
        $scope.loading = true;
        var results = {
            R:0,
            I:0,
            A:0,
            S:0,
            E:0,
            C:0
        };
        for(var i = 0 ; i < $scope.data.length; i++){
            if($scope.checked[i]){
                results[$scope.data[i].category] ++;
            }
        }
        var personality = HollandHelper.getCopmintations(results);

        Api.postData($scope.apiURL, $scope.userData.name, {"holland": JSON.stringify(personality)}, "userResults")
            .success(function (d) {
                if(d.toLowerCase() === "ok"){
                    $scope.userData.holland = 1;
                    $location.path('/done');
                }else {
                    $scope.failed = true;
                }
                $scope.loading = false;
            })
            .error(function () {
               $scope.failed = true;
               $scope.loading = false;
            });

    };

    var shuffle = function(arr){
      for(var i = 0; i < arr.length; i++){
        var ind = Math.floor(Math.random() * 100)+1;
        var temp = arr[i];
        arr[i] = arr[ind];
        arr[ind] = temp;
      }
      return arr;
    };
    
    $scope.getData = function (url) {
        $scope.loading = true;
        Api.getData(url).success(function (d) {
            if(d != "error"){
                var x = shuffle(d);
                $scope.data = x;
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
