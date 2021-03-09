<?php
include_once "C_Basement.php";
include_once "M_Goods.php";
include "models/models.php";
class C_Page extends C_Basement
{
    public function __construct()
    {
        parent::__construct();
    }


    public function action_index()
    {
        if (isset($_GET['quit'])) {
            session_start();
            unset($_SESSION['user']);
        }
        $this->title = "";
        $this->content = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_index.php");
    }
    public function action_catalog()
    {
        $goods = new M_Goods;
        if (isset($_GET['lim'])) {
            $lim = 10 + intval($_GET['lim']);
        } elseif (!isset($_GET['lim'])) {
            $lim = 10;
        }
        $prepgoods = $goods->get_goods(1, $lim);

        $this->title = "Каталог";
        $this->content = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_catalog.php", array("goods" => $prepgoods));
    }
    public function action_good()
    {
        $id = $_GET['id'];
        $good = new M_Goods;
        $prepgood = $good->get_good($id);
        $this->title = $prepgood['brand'] . ' ' . $prepgood['model'];
        $this->content = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_good.php", array("good" => $prepgood));
    }
    public function action_auth()
    {
        $this->title = "Войти";
        if ($this->isPOST()) {
            if (check_user($_POST['mail'], $_POST['pass']) == "there is no user") {
                $note = "Пользователь не найден. Зарегистрируйтесь.";
                header("location: index.php?act=auth&nouser=true");
            } elseif (check_user($_POST['mail'], $_POST['pass']) == "password is correct") {
                $user = get_user($_POST['mail'], $_POST['pass']);
                session_start();
                $_SESSION['user'] = $user;
                session_write_close();
                header("location: index.php?act=account");
                exit();
            } elseif (check_user($_POST['mail'], $_POST['pass']) == "password is not correct") {
                header("location: index.php?act=auth&fail=true");
                exit();
            }
        }
        $this->content = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_auth.php", array('note' =>  $note));
    }
    public function action_reg()
    {
        if ($this->isPOST()) {
            new_user($_POST['emailreg'], $_POST['passreg']);
        }
        $this->title = "Регистрация";
        $this->content = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_reg.php");
    }
    public function action_contacts()
    {
        $this->title = "Контакты";
        $this->content = $this->Template("../templates/v_contacts.php");
    }
    public function action_account()
    {
        session_start();
        $user_full = get_user_full($_SESSION['user']);

        $this->title = "Личный кабинет";
        $this->content = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_account.php", array('user' => $user_full));
    }
}
