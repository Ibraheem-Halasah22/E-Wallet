<?php
include "CompanyUtils.php";
session_start();
if(!isset($_SESSION['logInId']) || $_SESSION['logInType'] != 2) header('Location:index.php');
if(isset($_POST['billName']) && isset($_POST['billAmount']) && isset($_POST['billService'])) issueBill();

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="CSS/try.css">
</head>

<body>
<!-- =============== Navigation ================ -->
<div class="container">
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                        <span class="icon">
                            <img src="imgaes/pen.png">
                        </span>
                    <span class="title">PENGUIN</span>
                </a>
            </li>

            <li>
                <a href="#">
                        <span class="icon">
                            <ion-icon name="pricetag-outline"></ion-icon>
                        </span>
                    <span class="title">bills</span>
                </a>
            </li>




            <li>
                <a href="#">
                        <span class="icon">
                            <ion-icon name="wallet-outline"></ion-icon>
                        </span>
                    <span class="title">my balance</span>
                </a>
            </li>

            <li >

                <a href="signOutComOrUser.php">
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
        <!-- ======================= Cards ================== -->
        <div class="cardBox">

            <div class="card1" >
                <div>
                    <div class="numbers">$<?php

                        showBalance();
                        ?></div>
                    <div class="cardName">in your wallet</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="cash-outline"></ion-icon>
                </div>
            </div>
        </div>

        <!-- ================ Order Details List ================= -->
        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>bills</h2>
                    <a href="#" class="btn">View All</a>
                </div>

                <table>
                    <thead>
                    <tr>
                        <td>Name</td>
                        <td>name of service</td>
                        <td>Price</td>
                        <td>Paid?</td>

                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    showCards();
                    ?>


                    </tbody>
                </table>
            </div>

            <!-- ================= New Customers ================ -->

        </div>
        <div class="s">
            <div id="changepass2" class="soso12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-title">
                            <h2>ISSUE BILL</h2>
                            <div class="underline-title"></div>
                        </div>
                        <form method="post" class="form">

                            <div class="form-group">

                                <input class="form-field" type="text" name="billName" placeholder="email to transfer to">

                            </div>
                            <div class="form-group">

                                <input class="form-field" type="number" name="billAmount" placeholder="amount of money">
                                <span>$$$</span>
                            </div>

                            <div class="form-group">

                                <input class="form-field" type="text" name="billService" placeholder="name of service">

                            </div>


                            <button class="button3" type="submit" name="submit"  />GO<span></span></button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="try.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>