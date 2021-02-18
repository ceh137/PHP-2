<?php

include "Product.class.php";
class Smartphone extends Product
{
    private $simcard;

    function __construct($title, $description, $price, $simcard)
    {
        parent::__construct($title, $description, $price);
        $this->simcard = $simcard;
    }
}
