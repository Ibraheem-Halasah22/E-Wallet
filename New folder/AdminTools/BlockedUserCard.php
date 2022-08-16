<?php

class BlockedUserCard
{
    public $userName;
    public $userId;


    function show(){
        echo'<form method="post" action="adminlogedin.php"><tr> <td><h4>'.$this->userName .
            '<input type="hidden" name = "blockuserid" value="'.$this->userId.'">'.
            '<input type="hidden" name = "typeofunblock" value="user">'.
            '<br> </h4></td><td><button'.
            ' type="submit" class="glow-on-hover">activate</button></td></tr></form>';
    }
}