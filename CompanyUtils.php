<?php

function showBalance(){

    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db->connect_error) {
        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }

    $comID = $_SESSION['logInId'];
    $stmt = $db->prepare("SELECT `Balance` FROM `companies` WHERE `regId` = ? ");
    $stmt->bind_param("i", $comID);
    $stmt->execute();
    $res = $stmt->get_result();
    $bal = $res->fetch_object()->Balance;

    echo $bal;
}

function issueBill(){
    $Emaill = $_POST['billName'];
    $amount = $_POST['billAmount'];
    $Service = $_POST['billService'];
    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db -> connect_error) {

        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }
    $stmt = $db ->prepare("SELECT `Email`, `Regid` FROM `users` WHERE `Email` = ?  ");
    $stmt->bind_param("s",$Emaill);
    $stmt->execute();
    $res = $stmt->get_result();
    if($res->num_rows == 0 ){

        echo "<script> alert('Invalid Email of Client') </script>";
        return;
    }
    $userId = $res->fetch_object()->Regid;

    $stmt = $db ->prepare( "INSERT INTO `bills` ( `ComId`, `UserId`, ".
        " `SName`, `Value`, `Paid`, `IssueDate` ) VALUES ( ?, ?, ".
        " ?, ?, ?, ?)");
    $v = '0';
    $theDate = new DateTime('now');
    $stringDate = $theDate->format('Y-m-d H:i:s');
    $stmt->bind_param("iisiss", $_SESSION['logInId'], $userId, $Service, $amount, $v,$stringDate);
    if($stmt->execute()) {
        echo "<script> alert('Done') </script>";

    }
    else echo "<script> alert('There\'s a problem') </script>";


}

include "BillCardForCompany.php";
function showCards(){
    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db -> connect_error) {

        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }
    $stmt = $db ->prepare( "SELECT * FROM `bills` WHERE `ComId` =?");
    $stmt->bind_param("i", $_SESSION['logInId']);
    $stmt->execute();
    $res= $stmt->get_result();
    $n = $res->num_rows;
    if(!$n){ echo "You don't have bills"; return;}
    for($i =0 ; $i < $n; $i++){
        $billData= $res->fetch_assoc();
        $card = new BillCardForCompany();

        //BillId 	ComId Descending 1 	UserId 	SName 	Value 	Paid 	IssueDate 	PaymentDate
        $card->service = $billData['SName'];
        $card->userName = $billData['UserId'];
        $card->amount = $billData['Value'];
        $card->paid = $billData['Paid'];
        $card->show();
     }
    return;

}


