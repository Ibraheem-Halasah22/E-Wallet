<?php
session_start();
include "userUtils.php";
if(!isset($_SESSION['logInId']) || $_SESSION['logInType'] != 1) header('Location:index.php');
if(isset($_POST['emailToTransTo']) && isset($_POST['moneyAmOfTrans'])){
    transferMoney();
    goto page;

}
if(isset($_POST['billToPayFromUser'])){
    payBill();
    goto page;

}
page:
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
  <!-- ======= Styles ====== -->
  <link rel="stylesheet" href="try.css">
</head>

<body>
<!-- =============== Navigation ================ -->
<div class="container">
  <div class="navigation">
    <ul>
      <li>
        <a href="#">
                        <span class="icon">
                            <img src="imgaes/coolpen.jpg">
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
                            <ion-icon name="archive-outline"></ion-icon>
                        </span>
          <span class="title">history</span>
        </a>
      </li>

      <li>
        <a href="#">
                        <span class="icon">
                            <ion-icon name="diamond-outline"></ion-icon>
                        </span>
          <span class="title">transfer money</span>
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
      <li>
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
              showBalanceForUser();
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
            <td>Price</td>
            <td>name of service</td>
              <td></td>
          </tr>
          </thead>

          <tbody>
          <?php
          showNonPaidBills();
          ?>


          </tbody>
        </table>
      </div>

      <!-- ================= New Customers ================ -->

    </div>
    <div class="s">
    <div class="details ">
      <div class="recentOrders">
        <div class="cardHeader">
          <h2>past transactions</h2>
          <a href="#" class="btn">View All</a>
        </div>

        <table>
          <thead>
          <tr>
            <td>from</td>
            <td>to</td>
            <td>price</td>
            <td>date</td>
          </tr>
          </thead>

          <tbody>


          <tr>
            <td>you</td>
            <td>ibrahem</td>
            <td>1000$</td>
            <td>11/2/2020</td>
          </tr>
          </tbody>
        </table>
      </div>
      <div class="recentOrders">
        <div class="cardHeader">
          <h2>past bills</h2>
          <a href="#" class="btn">View All</a>
        </div>

        <table>
          <thead>
          <tr>
            <td>Name of company</td>
            <td>name of service</td>
            <td>price</td>

          </tr>
          </thead>

          <tbody>


          <tr>
            <?php
            showPaidForUser();
            ?>

          </tr>
          </tbody>
        </table>
      </div>
    </div>

      <div id="changepass2" class="soso12">
        <div class="card">
          <div class="card-content">
            <div class="card-title">
              <h2>transferring</h2>
              <div class="underline-title"></div>
            </div>
            <form method="post" action="useindex.php" class="form">

              <div class="form-group">

                <input class="form-field" type="text" placeholder="email you want to" name="emailToTransTo">

              </div>
              <div class="form-group">

                <input class="form-field" type="text" placeholder="amount of money" name="moneyAmOfTrans">
                <span>$$$</span>
              </div>


              <button class="button3" type="submit" name="submit" value="CHANGE PASSWORD" />GO<span></span></button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- =========== Scripts =========  -->
<script src="../../../../Users/hp/Downloads/try/try.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>