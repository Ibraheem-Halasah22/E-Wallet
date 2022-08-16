<?php
class BillCard{
public $service = "";
public $userName;
public $price;

public function show(){

    echo "<tr><td>".$this->service."</td><td>".$this->price."</td><td>".$this->userName."</td></tr>";
}

}