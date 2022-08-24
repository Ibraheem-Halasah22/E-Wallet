<?php
include "BillCard.php";
function adminShowCards(){

    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db -> connect_error) {

        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }
    $stmt = $db ->prepare( "SELECT * FROM `bills`");
    $stmt->execute();
    $res= $stmt->get_result();
    $n = $res->num_rows;
    if(!$n){ echo "There's no bills"; return;}
    for($i =0 ; $i < $n; $i++){
        $billData= $res->fetch_assoc();
        $card = new BillCard();

        //BillId 	ComId Descending 1 	UserId 	SName 	Value 	Paid 	IssueDate 	PaymentDate
        $card->service = $billData['SName'];
        $card->userName = $billData['UserId'];
        $card->price = $billData['Value'];

        $card->show();
    }
    return;

}
function adminShowTrans(){
    //	ID 	FromID 	ToId 	value 	TransferDate


        $db = new mysqli('localhost', 'root', '', 'web_project');
        if ($db -> connect_error) {

            echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
            return;
        }
        $stmt = $db ->prepare( "SELECT * FROM `transfers`");
        $stmt->execute();
        $res= $stmt->get_result();
        $n = $res->num_rows;
        if(!$n){ echo "There's no Trans"; return;}
        for($i =0 ; $i < $n; $i++){
            $billData= $res->fetch_assoc();
            $card = new BillCard();

            //BillId 	ComId Descending 1 	UserId 	SName 	Value 	Paid 	IssueDate 	PaymentDate
            $card->service = $billData['FromID'];
            $card->userName = $billData['value'];
            $card->price = $billData['ToId'];

            $card->show();
        }
        return;



}

function showBlockedUsers(){
    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db -> connect_error) {

        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }
    $stmt = $db ->prepare( "SELECT * FROM `users` WHERE `Blocked` = '1'");
    $stmt->execute();
    $res= $stmt->get_result();
    $n = $res->num_rows;
    if(!$n){ echo "There's no Trans"; return;}
    include "BlockedUserCard.php";
    for($i =0 ; $i < $n; $i++){
        $blockUserData= $res->fetch_assoc();
        $card = new BlockedUserCard();

        //
        //Full texts
        //	Regid 	UserName 	SSN 	Email 	password 	Blocked 	NoOfInvalidTrials 	Balance 	Disabled
        $card->userId = $blockUserData['Regid'];
        $card->userName = $blockUserData['UserName'];
        //$card->price = $blockUserData['ToId'];

        $card->show();
    }
}
function showBlockedCompanies(){
    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db -> connect_error) {

        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }
    $stmt = $db ->prepare( "SELECT * FROM `companies` WHERE `IsBlocked` = '1'");
    $stmt->execute();
    $res= $stmt->get_result();
    $n = $res->num_rows;
    if(!$n){ echo "There's no Blocked companies"; return;}

    include "BlockedCompanyCard.php";
    for($i =0 ; $i < $n; $i++){
        $blockUserData= $res->fetch_assoc();
        $card = new BlockedCompanyCard();

        //
        //Full texts
        //	Regid 	UserName 	SSN 	Email 	password 	Blocked 	NoOfInvalidTrials 	Balance 	Disabled
        $card->userId = $blockUserData['Regid'];
        $card->companyName = $blockUserData['ComName'];
        //$card->price = $blockUserData['ToId'];

        $card->show();
    }
}
function unblockUser(){
    $myId = $_POST['blockuserid'];
    //
    //Full texts
    //Regid 	ComName 	Email 	Pass 	Address 	IsBlocked 	NoOfInvalidTrials 	Balance 	Disabled

    //
    //Full texts
    //Regid 	UserName 	SSN 	Email 	password 	Blocked 	NoOfInvalidTrials 	Balance 	Disabled
    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db -> connect_error) {

        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }
    $stmt = $db ->prepare( "UPDATE `users` set `blocked` = '0' , `NoOfInvalidTrials` = 0 WHERE `Regid` =?");
    $stmt->bind_param("i", $myId);
    if($stmt->execute()){echo '<script>alert("Unblocked successfully")</script>';}
    $stmt->close();
    $db->close();
}

function unblockCompany(){
    $myId = $_POST['blockcompid'];
    //
    //Full texts
    //Regid 	ComName 	Email 	Pass 	Address 	IsBlocked 	NoOfInvalidTrials 	Balance 	Disabled

    //
    //Full texts
    //Regid 	UserName 	SSN 	Email 	password 	Blocked 	NoOfInvalidTrials 	Balance 	Disabled
    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db -> connect_error) {

        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }
    $stmt = $db ->prepare( "UPDATE `companies` set `IsBlocked` = '0' , `NoOfInvalidTrials` = 0 WHERE `Regid` =?");
    $stmt->bind_param("i", $myId);
    if($stmt->execute()){echo '<script>alert("Unblocked successfully")</script>';}
    $stmt->close();
    $db->close();
}