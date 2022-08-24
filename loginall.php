
<?php

include "signInOrUp.php";
//echo $_POST['userName'].'<br>.';
//echo $_POST['SSN'].'<br>';
//echo $_POST['signUpType'].'<br>';
if (!(isset($_POST['userName']) && isset($_POST['SSN']) && isset($_POST['Email']) && isset($_POST['pass'])
    && isset($_POST['signUpType']) && isset($_POST['confPass']))) goto login_check;
signUp();
goto page;
login_check:
if(empty($_POST['loginmail']) || empty($_POST['loginpass'])) goto page;
signIn();
page:
?>
<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Login and Registration Form in HTML | CodingNepal</title>
    <link rel="stylesheet" href="try/loginall.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="wrapper">
    <div class="title-text">
        <div class="title login">
            Login Form
        </div>
        <div class="title signup">
            Signup Form
        </div>
    </div>
    <div class="form-container">
        <div class="slide-controls">
            <input type="radio" name="slide" id="login" checked>
            <input type="radio" name="slide" id="signup">
            <label for="login" class="slide login">Login</label>
            <label for="signup" class="slide signup">Signup</label>
            <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
            <form action="loginall.php" method="post" class="login">
                <div class="field">
                    <input type="text" name = "loginmail" placeholder="Email Address" required>
                </div>
                <div class="field">
                    <input type="password" name="loginpass" placeholder="Password" required>
                </div>
                <div class="field radioshow">

                    <div>
                        <input  style="    width: 20px;
                                             height: 20px;
                                              padding-top:20px ;
                                            padding-right:10px ;   "
                                type="radio" id="complogin" name="signInType" value="company" CHECKED >
                        <label for="complogin">company</label>
                    </div>

                    <div>
                        <input style="    width: 20px;
    height: 20px;
    padding-top:20px;
    padding-right:10px ;
" type="radio" id="userlogin" name="signInType" value="user"  >
                        <label for="userlogin">user</label>
                    </div>
                </div>
                <div class="pass-link">
                    <a href="#">Forgot password?</a>
                </div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Login">
                </div>
                <div class="signup-link">
                    Not a member? <a href="">Signup now</a>
                </div>
            </form>
            <form action="loginall.php" method="post" class="signup">
                <div class="field">
                    <input type="text" name="userName" placeholder="Name" required>
                </div>
                <div class="field">
                    <input type="text" name="SSN" placeholder="SSN" required>
                </div>
                <div class="field">
                    <input type="text" placeholder="Email Address" name="Email" required>
                </div>

                <div class="field">
                    <input type="password" placeholder="Password" name="pass" required>
                </div>
                <div class="field">
                    <input type="password" placeholder="Confirm password" name="confPass" required>
                </div>

                <div class="field radioshow">


                    <div>
                        <input style="     width: 20px;
                                           height: 20px;
                                           padding-top:20px;
                                           padding-right:10px ;
"                        type="radio" id="dewey" name="signUpType" value="company" CHECKED>
                        <label for="dewey">Company</label>
                    </div>

                    <div>
                        <input style="    width: 20px;
    height: 20px;
    padding-top:20px;
    padding-right:10px ;
"
                               type="radio" id="louie" name="signUpType" value="user" >
                        <label for="louie">User</label>
                    </div>
                </div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Signup">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const loginText = document.querySelector(".title-text .login");
    const loginForm = document.querySelector("form.login");
    const loginBtn = document.querySelector("label.login");
    const signupBtn = document.querySelector("label.signup");
    const signupLink = document.querySelector("form .signup-link a");
    signupBtn.onclick = (() => {
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
    });
    loginBtn.onclick = (() => {
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
    });
    signupLink.onclick = (() => {
        signupBtn.click();
        return false;
    });
</script>
</body>
</html>
