<?php

class BillCardForCompany
{
    public $paid;
    public $service;
    public $amount;
    public $userName;

    function show(){
        echo "<tr><td>".$this->userName."</td><td>$".$this->service."</td><td>".$this->amount."</td><td>".$this->paid."</td></tr>";
    }
}