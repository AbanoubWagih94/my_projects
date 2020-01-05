app.factory("signUpErrApi", function ($http) {
    var form = {
        userErr: false,
        userLengthErr: false,
        mailErr: false,
        pwsErr: false,
        pwErr: false,
        submitted: false,
        phoneErr: false
        }, apiUrl = "php/signingApi.php?";
    return{
        user : function () {
            return form.userErr;
        },
        userLength : function () {
            return form.userLengthErr;
        },
        mail : function () {
            return form.mailErr;
        },
         phone : function () {
            return form.phoneErr;
        },
        pws : function () {
            return form.pwsErr;
        },
        pw : function () {
            return form.pwErr;
        },
        submit : function () {
            return form.submitted;
        },
        checkUser : function (user) {
            if(user.length < 6){
                form.userLengthErr = true;
                return;
            }else if(user.length > 6){
                form.userLengthErr = false;
            }
            $http.get(apiUrl+"userCheck="+user)
                .success(function (d) {
                    form.userErr =  Number(d);
                });
        },
        checkMail : function (mail) {
            $http.get(apiUrl+"mailCheck="+mail)
                .success(function (d) {
                    form.mailErr =  Number(d);
                });
        },
        checkPhone : function (phone){
            form.phoneErr =  !(/^[0-9]{11}$/.test(phone));
        },
        checkPw : function (pw) {
            if(pw.length < 8){
                form.pwErr = true;
            }else{
                form.pwErr = false;
            }
        },
        checkPws : function (pws) {
            if(pws[0] !== pws[1])
            {
                form.pwsErr = true;
            }else{
                form.pwsErr = false;
            }
        },
        submitCheck : function () {
            form.submitted = true;
        }
    };
});