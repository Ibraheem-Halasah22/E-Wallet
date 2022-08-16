<?php
function signUp(){

    $Name = $_POST['userName'];
    $ssn = $_POST['SSN'];
    $pass = $_POST['pass'];
    $confPass = $_POST['confPass'];
    $mail = $_POST['Email'];
    if (strcmp($pass, $confPass)) {
        echo "<script>alert('Passwords must match')</script>";
       return;
    }


    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db -> connect_error) {

        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
       return;
    }
    if (!strcmp($_POST['signUpType'], 'user')) {

        $queryStr = "INSERT INTO `users` (`UserName`, `SSN`, `Email`, `password`, `Blocked`,".
            " `NoOfInvalidTrials`,  `Balance`, `Disabled`) VALUES".
            " (?, ?, ?, SHA1(?), '0', '0',  '0', '0')";


        $stmt = $db ->prepare($queryStr);
        $stmt->bind_param("ssss",$Name, $ssn, $mail, $pass);


        if(!$stmt->execute()){
            echo "<script> alert('There\'s a problem in your data') </script>";
        } else{
            echo "<script> alert('You\'ve been signed up successfully') </script>";
        }
    }else if (!strcmp($_POST['signUpType'], 'company')){
        $queryStr = "INSERT INTO `companies` (`ComName`, `Email`, `Pass`, `Address`,".
            " `IsBlocked`, `NoOfInvalidTrials`, `Balance`, `Disabled`) VALUES ( ?, ".
            "?, SHA1(?), ?, '0', '0', '0', '0')";
        $stmt = $db ->prepare($queryStr);
        $stmt->bind_param("ssss",$Name,$mail,   $pass, $ssn);
        if(!$stmt->execute()){
            echo "<script> alert('There\'s a problem in your data') </script>";
        } else{
            echo "<script> alert('You\'ve been signed up successfully') </script>";
        }
    }
}


function signIn(){
    $loginMail = $_POST['loginmail'];
    $loginPass = $_POST['loginpass'];
    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db -> connect_error) {

        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }
    if (!strcmp($_POST['signInType'], 'user')) {
        $stmt = $db ->prepare("SELECT `Email` , `Password`, `Blocked` , `regId`, `NoOfInvalidTrials` ".
            " FROM `users` WHERE `Email` = ?  and ".
            "`Disabled` = 0");
        $stmt->bind_param("s",$loginMail);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows == 0){

            echo "<script> alert('Invalid Email/password') </script>";
            return;
        }
        $userData = $res->fetch_assoc();

        if($userData['Blocked']){
            echo "<script> alert('Your account is blocked, please activate it from an admin') </script>";
            return;
        }
        if(sha1($_POST['loginpass']) == $userData['Password']){
            session_start();
            $_SESSION['logInType'] = 1;
            $_SESSION['logInId'] = $userData['regId'];
            header("Location:useindex.php");
        }else{
            echo "<script> alert('Invalid Email / Password') </script>";
            $tempNoOfInvalidTrials = $userData['NoOfInvalidTrials'] + 1;

            $stmt = $db ->prepare("Update `users` set `NoOfInvalidTrials` = ".$tempNoOfInvalidTrials.
                " WHERE `Email` = ?");
            $stmt->bind_param("s",$loginMail);
            $stmt->execute();
            if($tempNoOfInvalidTrials == 3){
                $v = 1;
                $stmt = $db ->prepare("Update `users` set `Blocked` = ".$v.
                    " WHERE `Email` = ?");
                $stmt->bind_param("s",$loginMail);
                $stmt->execute();
            }
        }
        $stmt->close();
        $db->close();
    }
    else if (!strcmp($_POST['signInType'], 'company')) {
        $stmt = $db ->prepare("SELECT `Email` , `Pass`, `IsBlocked` , `regId`, `NoOfInvalidTrials` ".
            " FROM `companies` WHERE `Email` = ?  and ".
            "`Disabled` = 0");
        $stmt->bind_param("s",$loginMail);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows == 0){

            echo "<script> alert('Invalid Email/password') </script>";
            return;
        }
        $userData = $res->fetch_assoc();

        if($userData['IsBlocked']){
            echo "<script> alert('Your account is blocked, please activate it from an admin') </script>";
            return;
        }
        if(sha1($_POST['loginpass']) == $userData['Pass']){
            session_start();
            $_SESSION['logInType'] = 2;
            $_SESSION['logInId'] = $userData['regId'];
            header("Location:company.php");
        }else{
            echo "<script> alert('Invalid Email / Password') </script>";
            $tempNoOfInvalidTrials = $userData['NoOfInvalidTrials'] + 1;

            $stmt = $db ->prepare("Update `companies` set `NoOfInvalidTrials` = ".$tempNoOfInvalidTrials.
                " WHERE `Email` = ?");
            $stmt->bind_param("s",$loginMail);
            $stmt->execute();
            if($tempNoOfInvalidTrials == 3){
                $v = 1;
                $stmt = $db ->prepare("Update `companies` set `IsBlocked` = ".$v.
                    " WHERE `Email` = ?");
                $stmt->bind_param("s",$loginMail);
                $stmt->execute();
            }
        }
        $stmt->close();
        $db->close();
    }
}
