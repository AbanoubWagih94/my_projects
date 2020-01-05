<?php
    define("__CONFIG__", true);
    require_once "inc/config.php";

    Page::ForceLogin();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Library</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="robots" content="follow" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="assets/Libs/bootstrap/css/bootstrap.min.css" />
    </head>
    <body style="background: url('assets/images/background.jpg');">
        <div id="container" class="container-fluid">
            <div id="Login_form" class="container-fluid">
                <form class="js-Login">
                    <div class="form-group">
                        <label for="EMail">Email:</label>
                        <input type="email" class="form-control" id="EMail"  placeholder="Email@example.com" required>
                    </div>

                    <div class="form-group">
                        <label for="Password">Password:</label>
                        <input type="password" class="form-control" id="Password"  placeholder="Enter your password" required>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="show-password" onclick="showPassword()">
                        <label for="show-password">Show Password</label>
                    </div>
                    <div class="alert alert-danger js-error" role="alert" style="display: none;"></div>
                    <div>
                        Don't have an account? <a href="#" id="reg" onclick="hideLog();">REGISTER HERE</a>
                    </div><br>
                    <button type="submit" class="btn btn-outline-light" id="log">Login</button>
                </form>
            </div>

            <div id="Register_form" class="container-fluid">
                <button type="button" id="close_btn" class="close" aria-label="Close" onclick="hideReg();">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form class="js-Register">
                    <div class="form-group">
                        <label for="Email">Email:</label>
                        <input type="email" class="form-control" id="Email" placeholder="Email@example.com" required>
                    </div>

                    <div class="form-group">
                        <label for="Name">Name:</label>
                        <input type="text" class="form-control" id="Name" placeholder="Enter your name" required>
                    </div>

                    <div class="form-group">
                        <label for="Password1">Password:</label>
                        <input type="password" class="form-control" id="Password1"  placeholder="Enter your password" required>
                    </div>

                    <div class="form-group">
                        <label for="Password2"> Retype your password:</label>
                        <input type="password" class="form-control" id="Password2"  placeholder="Retype your password" required>
                    </div>

                    <div class="alert alert-danger js-error" role="alert" style="display: none;"></div>
                    <button type="submit" class="btn btn-outline-light" >Register</button>
                </form>
            </div>
        </div>
        <?php require_once "inc/footer.php";?>

    <script>

    </script>
    </body>

</html>
