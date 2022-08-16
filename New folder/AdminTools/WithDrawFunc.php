<?php
function WithdrawFunction(){
    $withMail = $_POST['withemail'];
    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db->connect_error) {
        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }

    $adminId = $_SESSION['logInId'];
    $stmt = $db->prepare("SELECT `Password` FROM `admins` WHERE `AdminId` = ? ");
    $stmt->bind_param("i", $adminId);
    $stmt->execute();
    $res = $stmt->get_result();

    if (strcmp(sha1($_POST['withpassword']), $res->fetch_object()->Password)) {
        echo "<script> alert('Please confirm your password') </script>";
        return;
    }
    if (!strcmp($_POST['withtype'], 'user')) {

        $stmt = $db->prepare("SELECT `Email` , `Balance`, `regId` FROM `users` WHERE `Email` = ?  and `Disabled` = 0");
        $stmt->bind_param("s", $withMail);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows == 0) {
            echo "<script> alert('Invalid Email for Client') </script>";
            return;
        }
        $userData = $res->fetch_assoc();
        $mainBalance = $userData['Balance'] - $_POST['withamount'];
        if($mainBalance< 0) {
            echo "<script> alert('Client don\'t have enough value' ) </script>"; return;
        }
        $db->autocommit(FALSE);
        $stmt1 = $db->prepare("Update `users` set `Balance` = ? WHERE `Email` = ?  ");
        $stmt1->bind_param('is',  $mainBalance, $withMail);
        $stmt2 = $db->prepare("INSERT INTO `userswithdraws` ( `userid`, " .
            "`Value`, `DateAndTime`, `AdminId`) VALUES ( ?,  ?, " .
            " ?, ?)");
        $theDate = new DateTime('now');
        $stringDate = $theDate->format('Y-m-d H:i:s');
        $stmt2->bind_param('iisi', $userData['regId'], $_POST['withamount'], $stringDate, $adminId);
        if ($stmt1->execute() && $stmt2->execute()) {
            $db->commit();
            echo "<script> alert('Done!') </script>";
        } else {
            $db->rollback();
            echo "<script> alert('There\'s a problem') </script>";
        }
        $stmt->close();
        $db->close();

    } else if (!strcmp($_POST['withtype'], 'company')) {
        $stmt = $db->prepare("SELECT `Email` , `Balance`, `regId` FROM `companies` WHERE `Email` = ?  and `Disabled` = 0");
        $stmt->bind_param("s", $withMail);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows == 0) {
            echo "<script> alert('Invalid Email for Client') </script>";
            return;
        }
        $userData = $res->fetch_assoc();
        $mainBalance = $userData['Balance'] - $_POST['withamount'];
        if($mainBalance< 0) {
            echo "<script> alert('Client don\'t have enough value' ) </script>"; return;
        }
        $db->autocommit(FALSE);
        $stmt1 = $db->prepare("Update `companies` set `Balance` = ? WHERE `Email` = ?  ");
        $stmt1->bind_param('is', $mainBalance , $withMail);
        $stmt2 = $db->prepare("INSERT INTO `companieswithdraws` ( `userid`, " .
            "`Value`, `DateAndTime`, `AdminId`) VALUES ( ?,  ?, " .
            " ?, ?)");
        $theDate = new DateTime('now');
        $stringDate = $theDate->format('Y-m-d H:i:s');
        $stmt2->bind_param('iisi', $userData['regId'], $_POST['withamount'], $stringDate, $adminId);
        if ($stmt1->execute() && $stmt2->execute()) {
            $db->commit();
            echo "<script> alert('Done!') </script>";
        } else {
            $db->rollback();
            echo "<script> alert('There\'s a problem') </script>";
        }
        $stmt->close();
        $db->close();

    }


}
