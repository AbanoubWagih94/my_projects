function ID(id) {
    return document.getElementById(id);
}

function hideLog(){
    ID('Login_form').style.display = "none";
    ID("Register_form").style.display = "block";
}

function hideReg() {
    ID("Register_form").style.display = "none"
    ID('Login_form').style.display = "block";
}

function showPassword() {

    if(ID('Password').type == "password"){
        ID('Password').type = "text";
    } else {
        ID('Password').type = "password";
    }
}

$(document)
.on('submit', 'form.js-Register', function (event) {
    event.preventDefault();

    var _form = $(this);
    var _error = $(".js-error");

    var data = {
        email: $('#Email').val(),
        name: $('#Name').val(),
        password1: $('#Password1').val(),
        password2: $('#Password2').val()
    };


    if(data.email.length < 6){
        _error
            .text("Please enter a valid email address")
            .show();
        return false;
    } else if(data.password1.length < 8) {
        _error
            .text("Please enter a password that is at least 8 characters long.")
            .show();
        return false;
    } else if(data.password1 != data.password2) {
        _error
            .text("Second password didn't match first password.")
            .show();
        return false;
    }

    _error.hide();

    $.ajax({
        type:'POST',
        url: '/library/ajax/register.php',
        data: data,
        dataType:'json',
        async:true
    })
        .done(function ajaxDone(data) {
            if(data.redirect !== undefined){
                window.location = data.redirect;
            } else if(data.error !== undefined){
                _error
                    .text(data.error)
                    .show();
            }
            console.log(data);
        })
        .fail(function ajaxFailed(e) {
            console.log(e);
        })
        .always(function ajaxAlwaysDoThis(data) {
        console.log("always");
        });

    return false;
})
    .on('submit', 'form.js-Login', function (event) {
        event.preventDefault();

        var _form = $(this);
        var _error = $(".js-error");

        var data = {
            email: $('#EMail').val(),
            password: $('#Password').val()
        }

        if(data.email.length < 6){
            _error
                .text("Please enter a valid email address")
                .show();
            return false;
        } else if(data.password.length < 8) {
            _error
                .text("Please enter a password that is at least 8 characters long.")
                .show();
            return false;
        }

        _error.hide();

        $.ajax({
            type:'POST',
            url: '/library/ajax/login.php',
            data:data,
            dataType:'json',
            async:true
        })
            .done(function ajaxDone(data) {
                if(data.redirect !== undefined){
                    window.location = data.redirect;
                } else if(data.error !== undefined){
                    _error
                        .text(data.error)
                        .show();
                }
                console.log(data);
            })
            .fail(function ajaxFailed(e) {
                console.log(e);
            })
            .always(function ajaxAlwaysDoThis(data) {
                console.log("always");
            });

        return false;
    });