app.controller("UsersResultsDetails",['$scope', 'Api', '$routeParams',function ($scope, Api, $routeParams) {
    $scope.seeResults = function (id) {
        $scope.loading = true;
        $scope.contacts = false;
        Api.getData($scope.apiURL+"?id="+id+"&lang="+$scope.lang)
            .success(function (d) {
                try {
                    $scope.subData = d.db[0];
                    $scope.subData.holland = JSON.parse($scope.subData.holland);
                    $scope.subData.value = JSON.parse($scope.subData.value);
                    console.log($scope.subData.value);
                    if(d.db[0].skills) {
                        var data = JSON.parse(d.db[0].skills).data;
                        var im = JSON.parse(d.db[0].skills).improve;
                        var ex = JSON.parse(d.db[0].skills).excellent;
                        var f = JSON.parse(d.file);
                        $scope.subData.skills = {
                            data: [],
                            improve: [],
                            excellent: []
                        };

                        for (var i = 0; i < data.length; i++) {
                            f[i].score = data[i];
                            $scope.subData.skills.data.push(f[i]);
                        }
                        for (i = 0; i < im.length; i++) {
                            $scope.subData.skills.improve.push(f[im[i]]);
                        }
                        for (i = 0; i < ex.length; i++) {
                            $scope.subData.skills.excellent.push(f[ex[i]]);
                        }
                    }
                }catch (e){
                    alert(e);
                    $scope.getFailed = true;
                }
                $scope.loading = false;
            })
            .error(function () {
                $scope.getFailed = true;
                $scope.loading = false;
                alert("internal server error");
            });
    };
    
    $scope.getContacts = function(){
        Api.getData($scope.apiURL+"?getContacts="+$scope.subData.name)
        .success(function(d){
                if(angular.isObject(d)){
                    $scope.contacts = d;
                }else{
                    alert("internal server error");
                }
            })
        .error(function(){
               alert("internal server error");
            });
    };
    
    $scope.seeResults($routeParams.id);
}]);