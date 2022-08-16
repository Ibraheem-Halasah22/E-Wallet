<?php

if( empty($_POST['AdminUsername']) || empty($_POST['AdminPass'])) goto page;

    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db -> connect_error) {

echo "<script> alert('sorry Theres A problem in our database! \n please come again later') </script>";
header("Location:index.php");
}
$stmt = $db ->prepare("SELECT `Email` , `AdminId`, `Password` FROM `admins` WHERE `Email` = ? ");
$stmt->bind_param("s",$_POST['AdminUsername']);
$stmt->execute();
$res = $stmt->get_result();
if($res->num_rows == 0){

echo "<script> alert('Invalid username/password') </script>";
goto page;
}
$userData = $res->fetch_assoc();

if(sha1($_POST['AdminPass']) == $userData['Password']){
session_start();
    $_SESSION['logInType'] = 3;
    $_SESSION['logInId'] = $userData['AdminId'];
    $stmt->close();
    $db->close();
    header('Location:adminlogedin.php');
}else{
echo "<script> alert('Invalid username/password') </script>";

}
$stmt->close();
$db->close();
page:
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/e-wallet-logedout.css">
    <link rel="stylesheet" type="text/css" href="../Login_v3/fonts/iconic/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" type="text/css" href="../Login_v3/css/util.css">
    <link rel="stylesheet" type="text/css" href="../Login_v3/css/main.css">



</head>
<body>

    <div class="header12">
        <img id="icon"  src="../imgaes/pen.png">
        <a>PENGUIN</a>
    <div class="header-right">
        <a class="active" > <button id="loginbutton">LOGIN</button></a>
    </div>
</div>
    <section class="soso5" id="home">
        <div class="column">
            <h1>coming soon to IOS and android  </h1>
            <p>with penguin not only you can rest asured that you money is safe<br> but also now you can pay
                all of your bills from your house <br> not to forget our newest software that lets you buy
                <br>the best watches money can buy , with penguin security and style </p>
        </div>

        <img class="column" src="../imgaes/iphonepay.png" id="iphone">
        <img id="postioning" src="../imgaes/xEwallet.png">
    </section>

    <div id="login" class="limiter notshown">
        <form action="index.php" method="post">
            <div class="container-login100" style="background-image: url('../Login_v3/images/bg-01.jpg');">
                <div class="wrap-login100">
                    <form class="login100-form validate-form">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>
                        <span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

                        <div class="wrap-input100 validate-input" data-validate="Enter username">
                            <input class="input100" type="text" name="AdminUsername" placeholder="Username">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                            <input class="input100" type="password" name="AdminPass" placeholder="Password">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>

                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn">
                                Login
                            </button>
                        </div>

                        <div class="text-center p-t-90">
                            <a class="txt1" href="#">
                                Forgot Password?
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="../Login_v3/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="../Login_v3/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="../Login_v3/vendor/bootstrap/js/popper.js"></script>
    <script src="../Login_v3/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="../Login_v3/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="../Login_v3/vendor/daterangepicker/moment.min.js"></script>
    <script src="../Login_v3/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="../Login_v3/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="../Login_v3/js/main.js"></script>
    <script src="../javascript/login.js"></script>

    <section class="beg">
        <div class="let lefttri"></div>
        <div class="let lefttri2">
            <button></button>
            <button></button>
            <button></button>
            <button></button>
            <button></button>
            <button></button>
        </div>
        <div class="let lefttri3"></div>
</section>

</body>
</html>