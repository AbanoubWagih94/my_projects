app.controller("User", ['$scope', '$route', '$http', '$location',function ($scope, $route, $http, $location) {
    $scope.dropDownActive = 0;
    $scope.dropActiveLarge = false;
    $scope.dropActiveSmall = false;
    $scope.thankMessage = 
        [
         {
            "ar":"شكرا علي اتمامك الاختبار يرجي المتابعة مع المستشار الخاص بك",
            "en":"Thanks for finishing the test you can contact your consulter."
        },
         {
            "ar":"في حال اتمامك كل الإختبارات سيظهر زر كالأتي في صفحه المعلومات الخاصة بك",
            "en":"In case you have finished all assessments Reservation button as following will appear in your info page"
        },
        {
            "ar":"احجز الان",
            "en":"Reserve Now"
        },
        {
            "ar":"في حال لم تنتهي بعد!",
            "en":"In case not finished yet!"
        },
        {
            "ar":"يمكنك إتمام الإختبارات في اى وقت.",
            "en":"You can complete your assessments any time."
        }
        ];
    $scope.siteStatic = {
      ar:{
          intro:"ملحوظة : تذكر أنه لا يوجد إجابة صحيحة وأخرى خاطئة وأنه ليس هناك نمط شخصية أفضل من الآخر بالإضافة إلى أننا هنا لا نحكم على أى شخص إن كان جيد أم لا لذلك استرخى وأجب بأمانة عن الأدوات التالية حتى نستطيع تحديد مجال شغفك بدقة كما يمكنك الإجابة على أين من الأدوات التالية متى شئت.",
          submit:"إراسال",
          wait:"انتظر من فضلك.....",
          tests:"الإختبارات",
          lectures:"المحاضرات",
          consulting:"الإستشارات",
          logout:"تسجيل الخروج",
          visitor:"الرئيسية",
          name:"اسم المستخدم",
          pw:"كلمة مرور جديدة",
          pwr:"اعادة كلمه المرور",
          mail:"البريد الالكتروني",
          phone:"الهاتف المحمول",
          error:"خطأ اثناء تحديث بياناتك",
          success:"تم تحديث البيانات",
          userLengthErr:"اسم المستخدم يجب الا يقل عن 6 احرف",
          pwErr:"كلمه المرور يجب الا تقل عن 8 حروف",
          pwsErr:"كلمة المرور غير متطابقة",
          selectLang:"اختر اللغة",
          testFinished:"تم",
          testNotFinished:"لم يتم",
          editPw:"تعديل كلمة المرور",
          testsList:"قائمة الاختبارات:",
          userInfo:"معلومات المستخدم:"
      },
        en:{
            intro:"Note :Remember that there are no “right” answers and that no personality type is better than any other. Furthermore, we do not indicate how healthy or unhealthy a person is, so relax and answer the statements simply and honestly.",
            submit:"Submit",
            wait:"please wait....",
            tests:"Tests",
            lectures:"Lectures",
            consulting:"Consulting",
            logout:"Logout",
            visitor:"Home",
            name:"Username",
            pw:"New Password",
            pwr:"Repeat Password",
            mail:"Email",
            phone:"Mobile",
            error:"Error updating your data",
            success:"Successfully updated your data",
            userLengthErr:"username should be 8 chars at least",
            pwErr:"password length should be 6 chars at least",
            pwsErr:"passwords don't match",
            selectLang:"Select language",
           testFinished:"Finished",
           testNotFinished:"Not finished",
            editPw:"Edit Password",
            testsList:"Test List:",
            userInfo:"User Info:"           
        }

    };

    $scope.imgBaseUrl = "images/";
    $scope.apiURL = 'php/userApi.php';
    $scope.lang = localStorage.getItem('userLang') || "en";
    $scope.changeLang = function (x) {
        $scope.lang = x;
        localStorage.setItem('userLang', x);
        $route.reload();
    };
    
        $scope.isActive = function (path) {

        if($location.path() === path){
            return true;
        }
        return false;
    };

    $scope.userData = {};

   $scope.getUserData = function () {
       $http.get($scope.apiURL + "?getUserData")
           .success(function (d) {
               $scope.preLoader = true;
               $scope.userData = d;
               localStorage.setItem("userId", d.id);
           })
           .error(function () {
               //redirect to error page
           });
   };
   $scope.logout = function(){
    $http.get("logout.php")
    .success(function(d){
      if(d){
        location.reload();
      }
    });
   };

    $scope.getUserData();
}]);