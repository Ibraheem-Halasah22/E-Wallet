<?php

class BlockedCompanyCard

{
    public $companyName;
    public $userId;


    function show(){
        echo'<form method="post" action="adminlogedin.php">'.
            '<input type="hidden" name = "blockcompid" value="'.$this->userId.'">'.
            '<input type="hidden" name = "typeofunblock" value="company">'.
            '<tr> <td><h4>'.$this->companyName .'<br> </h4></td><td><button'.
            ' class="glow-on-hover">activate</button></td></tr></form>';
    }
}
