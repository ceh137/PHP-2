<?php

class Product
{
    private $title;
    private $description;
    private $price;

    public function __construct($title, $description, $price)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
    }


    function GetTitle()
    {
        return $this->title;
    }

    function GetDesc()
    {
        return $this->description;
    }

    function GetPrice()
    {
        return $this->price;
    }
}
