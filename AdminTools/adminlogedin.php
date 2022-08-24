<?php
session_start();
include 'AdminUtils.php';
if(!isset($_SESSION['logInId']) || $_SESSION['logInType'] != 3) header('Location:index.php');

if (!(isset($_POST['deposemail']) && isset($_POST['deposAmount']) && isset($_POST['depospassword']) && isset($_POST['depostype']))) goto withdrawCheck;


include "DeopsiteFunction.php";
depositeFun();
goto page;

withdrawCheck:

if (!(isset($_POST['withemail']) && isset($_POST['withamount']) && isset($_POST['withpassword']) && isset($_POST['withtype']))) goto changePassCheck;

include "WithDrawFunc.php";
WithdrawFunction();
goto page;
changePassCheck:
if(!(isset($_POST['passToChange']) && isset($_POST['confPassToChange']))) goto unblockusercheck;
include 'adminChangePass.php';
changePass();

unblockusercheck:
if(!(isset($_POST['blockuserid']) && !strcmp($_POST['typeofunblock'], 'user'))) goto unblockadmincheck;
//echo "Hi";
unblockUser();
unblockadmincheck:
if(!(isset($_POST['blockcompid']) && !strcmp($_POST['typeofunblock'], 'company'))) goto page;
unblockCompany();
page:
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../CSS/adminloggedin.css">
</head>

<body>
<!-- =============== Navigation ================ -->
<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                        <span class="icon">
                            <img src="../imgaes/pen.png">
                        </span>
                    <span class="title">PENGUIN</span>
                </a>
            </li>


            <li>
                <a href="#deposit">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                    <span class="title">Deposit/withdraw</span>
                </a>
            </li>

            <li>
                <a href="#newad">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                    <span class="title">ADD MANGER</span>
                </a>
            </li>


            <li>
                <a href="#mange">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                    <span class="title">mange users</span>
                </a>
            </li>

            <li>
                <a href="#changepass">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                    <span class="title">change password</span>
                </a>
            </li>

            <li >
                <a
                   href="adminLogOut.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                    <span class="title">Sign Out</span>
                </a>
            </li>


        </ul>
    </div>

    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>


        </div>

        <!-- ================ Order Details List ================= -->
        <div id="mange" class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Recent Orders</h2>
                    <a href="#" class="btn">View All</a>
                </div>

                <table>
                    <thead>
                    <tr>
                        <td>Service</td>
                        <td>Price</td>
                        <td>User Name</td>

                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    adminShowCards();
                    ?>


                    </tbody>
                </table>
            </div>
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>blocked Customers</h2>
                </div>

                <table>
                    <?php
                    showBlockedUsers();
                    ?>

                </table>
            </div>
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Recent transaction</h2>
                    <a href="#" class="btn">View All</a>
                </div>

                <table>
                    <thead>
                    <tr>
                        <td>From</td>
                        <td>To</td>
                        <td>Value</td>


                    </tr>
                    </thead>

                    <tbody>
                   <?php
                   adminShowTrans();
                   ?>

                    </tbody>
                </table>
            </div>
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>blocked compenies</h2>
                </div>

                <table>
                    <?php
                    showBlockedCompanies();
                    ?>

                </table>
            </div>

            <!-- ================= New Customers ================ -->

        </div>
        <div id="deposit" class="soso12">
            <div id="card">
                <div id="card-content">
                    <div id="card-title">
                        <h2>DEPOSIT</h2>
                        <div class="underline-title"></div>
                    </div>
                    <form method="post" action="adminlogedin.php" class="form">
                        <label for="user-email" style="padding-top:13px">
                            &nbsp;Email
                        </label>
                        <input id="user-email" class="form-content" type="email" name="deposemail" autocomplete="on"
                               required/>
                        <div class="form-border"></div>
                        <label for="user-password" style="padding-top:22px">&nbsp;Password
                        </label>
                        <input id="user-password" class="form-content" type="password" name="depospassword" required/>
                        <div class="form-border"></div>
                        <label for="user-email12" style="padding-top:13px">
                            &nbsp;amount
                        </label>
                        <input id="user-email12" class="form-content" type="number" step="1" name="deposAmount"
                               autocomplete="on" required/>
                        <label style="float: left;" for="user1">user</label>
                        <input style="float: left;" id="user1" type="radio" name="depostype" value="user">
                        <label style="float: left;" for="compeny1">company</label>
                        <input style="float: left;" id="compeny1" type="radio" name="depostype" value="company">


                        <input id="submit-btn" type="submit" name="submit" value="GO"/>

                    </form>
                </div>
            </div>
            <div id="card1">
                <div id="card-content1">
                    <div id="card-title1">
                        <h2>Withdraw</h2>
                        <div class="underline-title"></div>
                    </div>
                    <form method="post" action="adminlogedin.php" class="form">
                        <label for="user-email" style="padding-top:13px">
                            &nbsp;Email
                        </label>
                        <input id="user-email1" class="form-content" type="email" name="withemail" autocomplete="on"
                               required/>
                        <div class="form-border"></div>
                        <label for="user-password" style="padding-top:22px">&nbsp;Password
                        </label>
                        <input id="user-password1" class="form-content" type="password" name="withpassword" required/>
                        <div class="form-border"></div>
                        <label for="user-email12" style="padding-top:13px">
                            &nbsp;amount
                        </label>
                        <input id="amount" class="form-content" type="number" name="withamount" required/>
                        <label style="float: left;" for="wwwuser">user</label>
                        <input style="float: left;" value="user" id="wwwuser" type="radio" name="withtype">
                        <label style="float: left;" for="hhhcompeny">company</label>
                        <input style="float: left;" value="company" id="hhhcompeny" type="radio" name="withtype">

                        <input id="submit-btn1" type="submit" name="submit" value="GO"/>

                    </form>
                </div>
            </div>

        </div>
        <div id="newad" class="soso12">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">
                        <h2>REGISTER NEW ADMIN</h2>
                        <div class="underline-title"></div>
                    </div>
                    <form method="post" action="" class="form">
                        <label for="user-email22" style="padding-top:13px">
                            &nbsp;Email
                        </label>
                        <input class="user-email" id="user-email22" class="form-content" type="email" name="email"
                               autocomplete="on" required/>
                        <div class="form-border"></div>
                        <label for="user-password22" style="padding-top:22px">&nbsp;Password
                        </label>
                        <input class="user-password" id="user-password22" class="form-content" type="password"
                               name="password" required/>
                        <div class="form-border"></div>
                        <label for="user-email22" style="padding-top:13px">
                            &nbsp;Confirm Password
                        </label>
                        <input class="user-email" id="user-email22" class="form-content" type="email" name="email"
                               autocomplete="on" required/>
                        <div class="form-border"></div>
                        <label for="user-email22" style="padding-top:13px">
                            &nbsp;Name
                        </label>
                        <input class="user-email" id="user-email22" class="form-content" type="email" name="email"
                               autocomplete="on" required/>
                        <div class="form-border"></div>

                        <input class="submit-btn" type="submit" name="submit" value="LOGIN"/>

                    </form>
                </div>
            </div>
        </div>
        <div id="changepass" class="soso12">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">
                        <h2>CHANGE PASSWORD</h2>
                        <div class="underline-title"></div>
                    </div>
                    <form method="post" action  = "adminlogedin.php" class="form">
                        <label for="user-email33" style="padding-top:13px">
                            entar your password
                        </label>
                        <input class="user-email" id="user-email33" class="form-content" type="password" name = "passToChange"
                               required/>
                        <div class="form-border"></div>
                        <label for="user-password44" style="padding-top:22px">conform password
                        </label>
                        <input class="user-password" id="user-password44" class="form-content" type="password"
                               name = "confPassToChange" required/>

                        <input class="submit-btn" type="submit" name="submit" value="CHANGE PASSWORD"/>

                    </form>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="../javascript/adminlogedin.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>