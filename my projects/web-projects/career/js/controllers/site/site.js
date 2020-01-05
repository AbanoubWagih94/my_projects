app.controller("Site", ['$scope', '$location', '$route', 'Api', 'signUpErrApi', function($scope, $location, $route, Api, signUpErrApi){
    $scope.showSign = function(){
        $scope.hideInfo = false;    
    };
    $scope.loggedIn = localStorage.getItem('userId') || false;
    $scope.preLoader = true;
    $scope.apiURL = "php/signingApi.php";
    $scope.imgUrl ="images/";
    $scope.lang = localStorage.getItem('userLang') || "en";
    $scope.contact = {};
    $scope.userSignIn = {};
    $scope.userSignUp = {};
    $scope.contacted = localStorage.getItem("contacted");
    $scope.loading = false;
    $scope.wait = false;
    $scope.formShow = [true, false];
    $scope.hideInfo = true;
    $scope.siteStatic = {
        ar: {
            start:"ابدأ الان",
            home:"الرئيسية",
            about:"عن الموقع",
            services:"خدماتنا",
            ourWork:"اعمالنا",
            contact:"تواصل معنا",
            contacted:"لقد تم ارسال بياناتك الي الموقع وسيتم التواصل معك",
            wait:"انتظر من فضلك....",
            email:"البريد الاليكتروني:",
            phone:"رقم الهاتف المحمول:",
            userName:"اسم المستخدم",
            password:"كلمة المرور:",
            passwordRepeat:"اعاده كلمه المرور:",
            submit:"ارسال",
            login:"تسجيل الدخول",
            register:"حساب جديد",
            signInError:"اسم المستخدم او كلمة المرور غير صحيحة",
            wait:"انتظر من فضلك....",
            submitErr:"تم تسجيل حسابك بنجاح يمكنك استخدام بياناتك في تسجيل الدخول",
            userErr:"اسم المستخدم موجود من قبل",
            userLengthErr:"اسم المستخدم يجب الا يقل عن 6 احرف",
            pwErr:"كلمة المرور يجب الا تقل عن 8 حروف",
            pwsErr:"كلمة المرور غير متطابقة",
            mailErr:"البريد الالكتروني مستخدم من قبل",
            phoneErr:"ادخل رقم هاتف محمول صحيح:",
            signInSuccess:"تم تسجيل الدخول  بنجاح جاري توجيهك إلى لوحة التحكم",
            selectLang:"اختر اللغة",
            registerNow:"سجل الأن"
        },
        en: {
            start:"Start Now",
            home:"Home",
            about:"About",
            services:"Services",  
            ourWork:"Our Work",
            contact:"Find Us",
            contacted:"You have Already sent a note to the site you will get contact soon!",
            wait:"Please wait.....",
            email:"Email:",
            phone:"Mobile Number:",
            userName:"Username:",
            password:"Password:",
            passwordRepeat:"Password Repeat:",
            submit:"Submit",
            login:"Sign In",
            register:"Sign Up",
            signInError:"Username or password is incorrect",
            wait:"Please wait....",
            submitErr:"Your account has been created successfully you can login with your data now!",
            userErr:"Username is already used",
            userLengthErr:"Username should be 8 chars at least",
            pwErr:"Password length should be 6 chars at least",
            pwsErr:"Passwords don't match",
            mailErr:"Email is already used",
            phoneErr:"Enter a valid mobile Number:",
            signInSuccess:"signed in successfully, redirecting you to control panel",
            selectLang:"Select language",
            registerNow:"Register now"
        }

    };
    $scope.dropActive = 0;

    $scope.isLoading = function (x) {
      $scope.loading = x;
    };

    $scope.isActive = function (path) {

        if($location.path() === path){
            return true;
        }
        return false;
    };

    $scope.changeLang = function (x) {
        $scope.lang = x;
        localStorage.setItem('userLang', x);
        $route.reload();
    };

    $scope.contactSubmit = function () {
        $scope.wait = true;
        Api.postData($scope.apiURL, false, $scope.contact, 'addContact')
            .success(function (d) {
                if(d.toLowerCase() === "ok")
                {
                    localStorage.setItem("contacted", true);
                    $scope.contacted = true;
                }else{
                    alert("your data wasn't submitted please try again!");
                }
                $scope.wait = false;
            })
            .error(function () {
                $scope.wait = false;
                alert("your data wasn't submitted please try again!");
            });
    };

    $scope.form = function (x) {
        $scope.border_pos = (x*46+4)+"%";
        for(var i = 0; i < $scope.formShow.length; i++)
        {
            $scope.formShow[i] = false;
        }
        $scope.formShow[x] = true;
    };
    
    $scope.signIn = function () {
        $scope.signInWait = true;
        Api.postData($scope.apiURL, false, $scope.userSignIn, 'signIn')
            .success(function (d) {
                if(d.toLowerCase() === "ok"){
                    $scope.signInWait = false;
                    $scope.signInSuccess = true;
                    location.replace('user.php');
                }else{
                    $scope.signInWait = false;
                    $scope.signInError = true;
                }
            })
            .error(function () {
                $scope.signInWait = false;
                alert("Error connecting the server");
            });
    };

    $scope.ApiCall = function (func, params) {
        return signUpErrApi[func](params);
    };

    $scope.signUp = function () {
        $scope.signUpWait = true;
        Api.postData($scope.apiURL, false, $scope.userSignUp, "signUp")
            .success(function (d) {
                if(d.toLowerCase() === "ok")
                {
                    $scope.ApiCall('submitCheck');
                }else{
                    alert("Error connecting the server");
                }
                $scope.signUpWait = false;
            })
            .error(function () {
                $scope.signUpWait = false;
                alert("Error connecting the server");
            });
    };
    $scope.sessionChecker = function(){
      Api.getData($scope.apiURL+"?logged")
      .success(function(d){
            if(d.toLowerCase() === "ok"){
                location.replace('user.php');
            }else if(d.toLowerCase() === "no"){
                $scope.hideInfo = false;
            }else{
                alert("internal server error");
            }
        })
      .error(function(){
            alert("internal server error");
        });
    };
}]);