<?php
session_start();
if(isset($_SESSION['logInId']) && $_SESSION['logInType'] == 1) header("Location:usesindex.php");
else if(isset($_SESSION['logInId']) && $_SESSION['logInType'] == 1) header("Location:company.php");
else header("Location:loginall.php");
