app.controller("EnneagramResults", ['$scope', function($scope){
    $scope.result = $scope.userData.enneagram;
    $scope.url = "assessment-results/enneagram-results/"+$scope.result+ '-' + $scope.lang+".pdf";
    $scope.type = {
      "ar":{
          A:"صانع السلام",
          B:"المخلص",
          C:"المنجز",
          D:"المصلح",
          E:"المتفرد",
          F:"المساعد",
          G:"المتحدى",
          H:"الباحث",
          I:"المتحمس"
      },
        "en":{
            A:"The Peacemaker",
            B:"The Loyalist",
            C:"The Achiever",
            D:"The Reformer",
            E:"The Individualist",
            F:"The Helper",
            G:"The Challenger",
            H:"The Investigator",
            I:"The Enthusiast"
        }
    };
}]);