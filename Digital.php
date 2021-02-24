<?php
require_once "Physical.php";

class DigitalProduct extends PhysicalProduct
{
    function GetTotal()
    {
        $PhysicalTotal = parent::GetTotal();
        $this->total = $PhysicalTotal / 2;
        return $this->total;
    }
}
