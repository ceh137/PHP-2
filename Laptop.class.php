<?php
include "Product.class.php";
class Laptop extends Product
{
    private $keyboard;

    function __construct($title, $description, $price, $keyboard)
    {
        parent::__construct($title, $description, $price);
        $this->keyboard = $keyboard;
    }
}
