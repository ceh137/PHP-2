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
    $user = $db->prepare("INSERT INTO `user`(`mail`, `pass`) VALUES (:mail,:pass)");
    $user->bindValue(":mail", $mail, PDO::PARAM_STR_CHAR);
    $user->bindValue(":pass", $pass, PDO::PARAM_STR_CHAR);
    $user->execute();
}
