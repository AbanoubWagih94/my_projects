app.controller("MbtiResults", ['$scope', '$routeParams', function($scope, $http, $routeParams){
    // $scope.res = $routeParams.personality + '-' +$scope.lang;
    $scope.url = "assessment-results/mbti-results/"+$scope.userData.mbti+".docx";

}]);