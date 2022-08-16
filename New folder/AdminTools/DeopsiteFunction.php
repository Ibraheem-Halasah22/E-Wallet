<?php
function depositeFun(){
    $depMail = $_POST['deposemail'];
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

    if (strcmp(sha1($_POST['depospassword']), $res->fetch_object()->Password)) {
        echo "<script> alert('Please confirm your password') </script>";
        return;
    }
    if (!strcmp($_POST['depostype'], 'user')) {
        $stmt = $db->prepare("SELECT `Email` , `Balance`, `regId` FROM `users` WHERE `Email` = ?  and `Disabled` = 0");
        $stmt->bind_param("s", $depMail);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows == 0) {
            echo "<script> alert('Invalid Email for Client') </script>";
            return;
        }
        $userData = $res->fetch_assoc();
        $mainBalance = $userData['Balance'] + $_POST['deposAmount'];
        $db->autocommit(FALSE);
        $stmt1 = $db->prepare("Update `users` set `Balance` = ? WHERE `Email` = ?  ");
        $stmt1->bind_param('is',  $mainBalance, $depMail);
        $stmt2 = $db->prepare("INSERT INTO `usersdeposites` ( `userid`, " .
            "`Value`, `DateAndTime`, `AdminId`) VALUES ( ?,  ?, " .
            " ?, ?)");
        $theDate = new DateTime('now');
        $stringDate = $theDate->format('Y-m-d H:i:s');
        $stmt2->bind_param('iisi', $userData['regId'], $_POST['deposAmount'], $stringDate, $adminId);
        if ($stmt1->execute() && $stmt2->execute()) {
            $db->commit();
            echo "<script> alert('Done!') </script>";
        } else {
            $db->rollback();
            echo "<script> alert('There\'s a problem') </script>";
        }
        $stmt->close();
        $db->close();
        return;
    } else if (!strcmp($_POST['depostype'], 'company')) {
        $stmt = $db->prepare("SELECT `Email` , `Balance`, `regId` FROM `companies` WHERE `Email` = ?  and `Disabled` = 0");
        $stmt->bind_param("s", $depMail);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows == 0) {
            echo "<script> alert('Invalid Email for Client') </script>";
            return;
        }
        $userData = $res->fetch_assoc();
        $mainBalance = $userData['Balance'] + $_POST['deposAmount'];
        $db->autocommit(FALSE);
        $stmt1 = $db->prepare("Update `companies` set `Balance` = ? WHERE `Email` = ?  ");
        $stmt1->bind_param('is', $mainBalance , $depMail);
        $stmt2 = $db->prepare("INSERT INTO `companiesdeposites` ( `userid`, " .
            "`Value`, `DateAndTime`, `AdminId`) VALUES ( ?,  ?, " .
            " ?, ?)");
        $theDate = new DateTime('now');
        $stringDate = $theDate->format('Y-m-d H:i:s');
        $stmt2->bind_param('iisi', $userData['regId'], $_POST['deposAmount'], $stringDate, $adminId);
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
