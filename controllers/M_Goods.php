<?php
include_once "db.php";

class M_Goods
{

    public function get_goods($idstart, $lim)
    {
        include_once "db_connect.php";
        if ($lim == 0) {
            $goods = $db->prepare("SELECT * FROM `models` JOIN `car_brand` USING(brand_id) WHERE model_id>=:idstart");
            $goods->bindValue(":idstart", $idstart, PDO::PARAM_INT);
        } else {
            $goods = $db->prepare("SELECT * FROM `models` JOIN `car_brand` USING(brand_id) WHERE model_id>=:idstart LIMIT :lim");
            $goods->bindValue(":idstart", $idstart, PDO::PARAM_INT);
            $goods->bindValue(":lim", $lim, PDO::PARAM_INT);
        }
        $goods->execute();
        $prepgoods =  $goods->fetchAll(PDO::FETCH_ASSOC);
        return $prepgoods;
    }

    public function get_good($id)
    {
        include_once "db_connect.php";
        $good = $db->prepare("SELECT * FROM `models` JOIN `car_brand` USING(brand_id) WHERE model_id=:id");
        $good->bindValue(":id", $id, PDO::PARAM_INT);
        $good->execute();
        $prepgood =  $good->fetch(PDO::FETCH_ASSOC);
        return $prepgood;
    }
    public function __call($name, $params)
    {
        die("error");
    }
}
