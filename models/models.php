<?php
include_once "/Applications/MAMP/htdocs/Homework4/controllers/db.php";
function check_user($mail, $pass)
{
    include "/Applications/MAMP/htdocs/Homework4/controllers/db_connect.php";
    $user = $db->prepare("SELECT COUNT(*) FROM `user` WHERE mail=:mail");
    $user->bindValue(":mail", $mail, PDO::PARAM_STR_CHAR);
    $user->execute();
    $usercheck = $user->fetchColumn();


    if ($usercheck == 1) {
        //if the password is right;
        $user = $db->prepare("SELECT COUNT(*) FROM `user` WHERE mail=:mail and pass=:pass");
        $user->bindValue(":mail", $mail, PDO::PARAM_STR_CHAR);
        $user->bindValue(":pass", $pass, PDO::PARAM_STR_CHAR);
        $user->execute();
        $usercheck = $user->fetchColumn();
        if ($usercheck == 1) {
            $res = "password is correct";
            return $res;
        } else {
            $res = "password is not correct";
            return $res;
        }
    } else {
        $res = "there is no user";
        return $res;
    }
}

function get_user($mail, $pass)
{
    include "/Applications/MAMP/htdocs/Homework4/controllers/db_connect.php";
    $user = $db->prepare("SELECT * FROM `user` WHERE mail=:mail and pass=:pass");
    $user->bindValue(":mail", $mail, PDO::PARAM_STR_CHAR);
    $user->bindValue(":pass", $pass, PDO::PARAM_STR_CHAR);
    $user->execute();
    $user = $user->fetch(PDO::FETCH_ASSOC);
    return $user['user_id'];
}

function get_user_full($user_id)
{
    include "/Applications/MAMP/htdocs/Homework4/controllers/db_connect.php";
    $user_full = $db->prepare("SELECT * FROM `user` WHERE `user_id`=:user_id");
    $user_full->bindValue(":user_id", $user_id, PDO::PARAM_INT);

    $user_full->execute();
    $user_full = $user_full->fetch(PDO::FETCH_ASSOC);
    return $user_full;
}

function new_user($mail, $pass)
{
    include "/Applications/MAMP/htdocs/Homework4/controllers/db_connect.php";
    $user = $db->prepare("INSERT INTO `user`(`mail`, `pass`) VALUES (:mail, :pass)");
    $user->bindValue(":mail", $mail, PDO::PARAM_STR_CHAR);
    $user->bindValue(":pass", $pass, PDO::PARAM_STR_CHAR);
    $user->execute();
}

function getcart($user)
{
    include "/Applications/MAMP/htdocs/Homework4/controllers/db_connect.php";
    $cart = $db->prepare("SELECT * FROM `cart` JOIN `models` USING(`model_id`) WHERE `user_id`=:user");
    $cart->execute(array(':user' => $user));
    $cart = $cart->fetchAll(PDO::FETCH_ASSOC);
    return $cart;
}
function addtocart($goodid, $user)
{
    $goodid = intval($goodid);
    $user = intval($user);
    include "/Applications/MAMP/htdocs/Homework4/controllers/db_connect.php";
    $newitem = $db->prepare("INSERT INTO `cart`(`model_id`,`user_id`, `quantity`) VALUES ( :good_id , :user_id , 1 )");
    $newitem->bindValue(":user_id", $user, PDO::PARAM_INT);
    $newitem->bindValue(":good_id", $goodid, PDO::PARAM_INT);
    $newitem->execute();
}
function  del_cart($goodid, $user)
{
    $goodid = intval($goodid);
    $user = intval($user);
    include "/Applications/MAMP/htdocs/Homework4/controllers/db_connect.php";
    $delitem = $db->prepare("DELETE FROM `cart` WHERE `user_id`= :user AND `model_id` = :good_id");
    $delitem->bindValue(":user", $user, PDO::PARAM_INT);
    $delitem->bindValue(":good_id", $goodid, PDO::PARAM_INT);
    $delitem->execute();
}


function new_order($info)
{
    $user_id = $info['user_id'];
    $address = $info['address'];
    $amount = 0;
    $cart = getcart($user_id);

    foreach ($cart as $item) {
        $amount += $item['price'];
    }

    $order_status_id = 1;
    include "/Applications/MAMP/htdocs/Homework4/controllers/db_connect.php";
    $order = $db->prepare("INSERT INTO `orders`(`user_id`, `address`, `amount`, `order_status_id`) VALUES ( :user , :address , :amount, :order_st_id)");
    $order->execute(array(':user' => $user_id, ':address' => $address, ':amount' => $amount, ':order_st_id' => $order_status_id));
    $order_id =  $db->query("SELECT * FROM `orders` ORDER BY `order_id` DESC LIMIT 1");
    $order_id = $order_id->fetch(PDO::FETCH_ASSOC);
    $order_id = $order_id['order_id'];
    $items = $db->prepare("INSERT INTO `order_items` (`order_id`, `item_id`) VALUES (:order_id, :item_id)");
    foreach ($cart as $item) {
        $items->execute(array('order_id' => $order_id, ':item_id' => $item['model_id']));
    }
    $delcart = $db->prepare("DELETE FROM `cart` WHERE `user_id`= :user");
    $delcart->execute(array(':user' => $user_id));
}

function get_orders()
{
    include "/Applications/MAMP/htdocs/Homework4/controllers/db_connect.php";
    $orders = $db->prepare("SELECT * FROM `orders` JOIN `user` USING(`user_id`) JOIN `order_status` USING(`order_status_id`)  ORDER BY `date-time` DESC");
    $orders->execute();
    $orders = $orders->fetchAll(PDO::FETCH_ASSOC);
    return $orders;
}

function get_items_from_order($id)
{
    include "/Applications/MAMP/htdocs/Homework4/controllers/db_connect.php";
    $items = $db->prepare("SELECT * FROM `orders` JOIN `user` USING(`user_id`) JOIN `order_status` USING(`order_status_id`) LEFT JOIN `order_items` USING(`order_id`) LEFT JOIN `models` ON `item_id` = `model_id` WHERE `order_id`=:order_id ORDER BY `date-time` DESC");
    $items->execute(array(':order_id' => $id));
    $items = $items->fetchAll(PDO::FETCH_ASSOC);
    return $items;
}
function update_status($order_id, $status)
{
    include "/Applications/MAMP/htdocs/Homework4/controllers/db_connect.php";
    $update = $db->prepare("UPDATE `orders` SET `order_status_id` = :order_status_id WHERE `order_id`=:order_id");
    $update->execute(array(':order_status_id' => $status, ':order_id' => $order_id));
}
