<?php
require_once "Products.php";

class WeightedProduct extends Product
{
    function GetTotal()
    {
        return $this->total = $this->price * $this->quantity;
    }
}
