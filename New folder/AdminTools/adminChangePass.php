<?php
function changePass(){
    //$_POST['passToChange']) && isset($_POST['confPassToChange']
    $pass1 = $_POST['passToChange'];
    $pass2 =  $_POST['confPassToChange'];
    if($pass1 != $pass2){

        echo "<script> alert('passwords must match') </script>";
        return;
    }

    $db = new mysqli('localhost', 'root', '', 'web_project');
    if ($db -> connect_error) {

        echo "<script> alert('sorry Theres A problem in our database! \n\r please come again later') </script>";
        return;
    }
    $stmt = $db ->prepare( "Update `admins` set `password` = ? where `adminid` = ? ");
    $encPass = sha1($pass2);
    $stmt->bind_param("si", $encPass, $_POST['logInId']);
    if($stmt->execute()){
        echo "<script> alert('Done') </script>";
    }
    else {
        echo "<script> alert('Ther\'s a problem') </script>";
    }
    $stmt->close();
    $db->close();
}
