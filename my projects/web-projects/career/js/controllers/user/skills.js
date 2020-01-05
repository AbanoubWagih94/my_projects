app.controller("Skills", ['$scope', 'Api', '$location', function($scope, Api, $location){
    if($scope.userData.skills)
        $location.path('/done');

    $scope.url = "data/assessment/skills-"+$scope.lang+".json";
    $scope.scores = [];
    $scope.excellence = [];
    $scope.improve = [];

    $scope.pageStatics = {
        toImprove: {
            ar:"مهارة تريد تحسينها",
            en:"Skill you need to improve"
        },
        toExcellence: {
            ar:"مهارة تتميز بها",
            en:"Skill you master"
        },
        skillLevel:{
            ar:"اختر مستوى مهارتك في كل من المهارات الاتيه",
            en:"Select your skill level"
        },
        intro:{
        	ar:"يشتمل هذا الإختبار على ثلاث خطوات :",
        	
            en:"This exercise has three steps." 
        },
        fli:{
            ar:"الخطوة الأولى : تحديد مستوى كل مهارة من المهارات التالية مع العلم بأن :",
            en:"Step 1: Assess your level of proficiency for each skill below by circling the appropriate number in the far left hand colum. Use the scale below to assign a rating."
        },
        sli:{
            ar:"1 = إذا لم يكن لديك هذه المهارة",
            en:"1 = if you do not have the skill"
        },
        tli:{
            ar:"2 = إذا كانت لديك هذه المهارة بمستوى أقل من المتوسط",
            en:"2 = if you are less skilled than most people"
        },
        foli:{
            ar:"3 = إذا كانت لديك هذه المهارة بمستوى متوسط",
            en:"3 = if you are as skilled as most people"
        },
        fili:{
            ar:"4 = إذا كانت لديك هذه المهارة بمستوى أعلى من معظم الناس",
            en:"4 = if you are somewhat more skilled than most people"
        },
        sili:{
            ar:"5 = إذا كانت لديك هذه المهارة بمستوى عالى جدا",
            en:"5 = if you are much more skilled than most people"
        },
        seli:{
            ar:"الخطوة الثانية : من فضلك اختر 15 مهارة تستمتع بتأديتهم بالعمود الثانى",
            en:"Step 2: Place a check mark next to 15 skills you most enjoy using in the first column on the right side of the page."
        },
        eli:{
            ar:"الخطوة الثالثة : من فضلك اختر 5 مهارات تود تطويرها والعمل على تحسينها بالعمود الأخير",
            en:"Step 3: Select five to seven skills you want to learn, develop, or improve by placing a check mark in the far right column."
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
        $scope.loading = true;
        var ex = [], im = [];
        for(var i = 0; i < $scope.excellence.length; i++){
            if($scope.excellence[i])
                ex.push(i);
        }
        for(i = 0; i < $scope.improve.length; i++){
            if($scope.improve[i])
                im.push(i);
        }
         var results = {
            data : $scope.scores,
            improve : im,
            excellent : ex
        };
        
        Api.postData($scope.apiURL, $scope.userData.name, {"skills":JSON.stringify(results),"lang":$scope.lang}, "userResults")
            .success(function (d) {
                if(d.toLowerCase() === "ok"){
                    $scope.userData.skills = 1;
                    $location.path('/done');
                }else{
                    $scope.failed = true;
                }
                $scope.load = false;
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
                    $scope.scores[i] = 1;
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
