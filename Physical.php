<?php
require_once "Products.php";

class PhysicalProduct extends Product
{
    function GetTotal()
    {
        return $this->total = $this->price * $this->quantity;
    }
}
