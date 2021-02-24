<?php
require_once "Physical.php";
require_once "Digital.php";
require_once  "Weighted.php";

abstract class Product
{
    public $name; // Название продукта
    public $price; // Цена за единицу
    public $quantity; // Количество товара
    public $total; // Стоимость товара

    // Создание объекта класса
    public function __construct(String $name, float $price, $quantity)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    // Абстрактная функция Вычисление стоимости товара

    abstract function GetTotal();
}

$obj = new PhysicalProduct("Tovar1", 199.2, 4);
$objDigital = new DigitalProduct("TovarDigital1", 199, 7);
$objWeighted = new WeightedProduct("Tovar1Weighted", 500, 0.645);


echo $obj->GetTotal();
echo "<br>";
echo $objDigital->GetTotal();
echo "<br>";
echo $objWeighted->GetTotal();
