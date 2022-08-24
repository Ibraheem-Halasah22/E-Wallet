<?php
function showBalanceForUser(){

    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db->connect_error) {
        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }

    $userID = $_SESSION['logInId'];
    $stmt = $db->prepare("SELECT `Balance` FROM `users` WHERE `regId` = ? ");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $res = $stmt->get_result();
    $bal = $res->fetch_object()->Balance;

    echo $bal;
}
function transferMoney(){
    $mailTo = $_POST['emailToTransTo'];
    $amount = $_POST['moneyAmOfTrans'];
    $userID = $_SESSION['logInId'];
    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db->connect_error) {
        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }


    $stmt = $db->prepare("SELECT `Balance` FROM `users` WHERE `regId` = ? ");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $res = $stmt->get_result();
    $bal = $res->fetch_object()->Balance;
    if($amount > $bal){
        echo "<script> alert('You don\'t have enough money') </script>";
        $stmt->close();
        $db->close();
        return;
    }

    $stmt = $db->prepare("SELECT `regid` FROM `users` WHERE `email` = ? ");
    $stmt->bind_param("i", $mailTo);
    $stmt->execute();
    $res = $stmt->get_result();

    if($res->num_rows == 0){
        echo "<script> alert('The one you need isn\'t available') </script>";
        $stmt->close();
        $db->close();
        return;
    }
    $ud = $res->fetch_array();
    $idTo = $ud['0'];
    $db->autocommit(FALSE);
    //INSERT INTO `transfers`
    // (`ID`, `FromID`, `ToId`, `value`, `TransferDate`) VALUES (NULL, '3', '5', '400', '2022-05-12 00:36:27.000000');
    $stmt1 = $db->prepare("INSERT INTO `transfers` ( `FromID`, `ToId`, `value`,".
        " `TransferDate`) VALUES ( ?, ?, ?, ?)");
    $theDate = new DateTime('now');
    $stringDate = $theDate->format('Y-m-d H:i:s');
    $stmt1->bind_param('iiis',$userID,$idTo, $amount, $stringDate);
    $newBalForTrans = $bal - $amount;
    $stmt2 = $db->prepare("update `users` set `Balance` = ? where `regid` = ?");
    $stmt2->bind_param("ii", $newBalForTrans, $userID);
    $stmt3 = $db->prepare("update `users` set `Balance` = `Balance` + ? where `regid` = ?");
    $stmt3->bind_param("ii", $amount, $idTo);

    if($stmt1->execute() && $stmt2->execute() && $stmt3->execute()){
        $db->commit();
        echo "<script> alert('Transfer Done');</script>";

    }else{
        $db->rollback();
        echo "<script> alert('There\'s a problem');</script>";
    }

    $stmt ->close(); $stmt1 ->close(); $stmt2 ->close(); $stmt3 ->close(); $db->close();

}

class NonPaidBillForUser{
    public $service;
    public $amount;
    public $companyName;
    public $idForBill;

    function show()
    {
        echo '<tr><form method="post" action="useindex.php">' .
            '<input type="hidden" value="'.$this->idForBill.'" '.
            'name ="billToPayFromUser"><td>'.$this->companyName.'</td><td>'.$this->amount.'</td><td>'.$this->service.'</td>'.
        '<td><button class="button2" type="submit">pay</button></td></form></tr>';
    }
}
//<tr>
//            <td>Star Refrigerator</td>
//            <td>$1200</td>
//            <td>Paid</td>
//            <td><button class="button2">pay</button></td>
//          </tr>
function showNonPaidBills(){
    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db->connect_error) {
        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }
    // Full texts
    //	BillId 	ComId 	UserId 	SName 	Value 	 	IssueDate 	PaymentDate
    //Full texts
    //	Regid 	ComName 	Email 	Pass 	Address 	IsBlocked 	NoOfInvalidTrials 	Balance 	Disabled
    $userID = $_SESSION['logInId'];
    $stmt = $db->prepare("SELECT * FROM `bills`, `users`, `companies` WHERE `UserId` = ? and `Paid` = '0' ".
        " and `UserId` = `users`.`Regid`  and `companies`.`Regid` = `ComId`");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $res = $stmt->get_result();
    if($res->num_rows == 0){
        echo "There's no non paid bills";
        return;
    }
    for ($i = 0; $i<$res->num_rows; $i++){
        $billData = $res->fetch_assoc();
        $card = new NonPaidBillForUser();
        $card->idForBill = $billData['BillId'];
        $card->service =  $billData['SName'];
        $card->companyName = $billData['ComName'];
        $card->amount = $billData['Value'];
        $card->show();


    }

}

function payBill (){
    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db->connect_error) {
        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }
    //echo "HAAAAA";
    $userID = $_SESSION['logInId'];
    $stmt = $db->prepare("SELECT `Balance` FROM `users` WHERE `regId` = ? ");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $res = $stmt->get_result();
    $bal = $res->fetch_object()->Balance;


    $billId = $_POST['billToPayFromUser'];

    $stmt = $db->prepare("SELECT `Value` FROM `bills` WHERE `BillId` = ? ");
    $stmt->bind_param("i", $billId);
    $stmt->execute();
    $res = $stmt->get_result();
    $billVal = $res->fetch_object()->Value;
    //echo "HAAAAA";
    if($billVal > $bal){
        echo "<script> alert('You don\'t have enough money') </script>";
        $stmt->close();
        $db->close();
        return;
    }
    $stmt2 = $db->prepare("update `users` set `Balance` = `Balance` -? where `regid` = ?");
    $stmt2->bind_param("ii", $billVal, $userID);
    $stmt3 = $db->prepare("update `bills` set `Paid` = 1 where `billid` = ?");
    $stmt3->bind_param("i", $billId);

    if($stmt2->execute() && $stmt3->execute()){
        $db->commit();
        echo "<script> alert('Payment Done');</script>";

    }else{
        $db->rollback();
        echo "<script> alert('There\'s a problem');</script>";
    }

    $stmt ->close();  $stmt2 ->close(); $stmt3 ->close(); $db->close();

}
class CardForPaidBillForCustomer{
    public $service;
    public $amount;
    public $companyName;

    function show(){
        echo '<tr><td>'.$this->companyName.'</td><td>'.$this->amount.'</td><td>'.$this->service.'</td></tr>';
    }
}
//<td>nablus elect</td>
//            <td>elecit</td>
//            <td>1000$</td>
function showPaidForUser(){
    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db->connect_error) {
        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }
    // Full texts
    //	BillId 	ComId 	UserId 	SName 	Value 	 	IssueDate 	PaymentDate
    //Full texts
    //	Regid 	ComName 	Email 	Pass 	Address 	IsBlocked 	NoOfInvalidTrials 	Balance 	Disabled
    $userID = $_SESSION['logInId'];
    $stmt = $db->prepare("SELECT * FROM `bills`, `users`, `companies` WHERE `UserId` = ? and `Paid` = 1 ".
        " and `UserId` = `users`.`Regid`  and `companies`.`Regid` = `ComId`");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $res = $stmt->get_result();
    if($res->num_rows == 0){
        echo "There's no  paid bills";
        return;
    }
    for ($i = 0; $i<$res->num_rows; $i++){
        $billData = $res->fetch_assoc();
        $card = new CardForPaidBillForCustomer();

        $card->service =  $billData['SName'];
        $card->companyName = $billData['ComName'];
        $card->amount = $billData['Value'];
        $card->show();


    }
}