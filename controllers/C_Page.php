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
            $lim = intval($_GET['lim']);
        } elseif (!isset($_GET['lim'])) {
            $lim = 10;
            header("Location: index.php?act=catalog&lim=10");
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
        if (isset($_GET['cart'])) {
            session_start();
            $user = $_SESSION['user'];
            addtocart($_GET['id'], intval($user));
        }
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
        $this->content = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_auth.php");
    }
    public function action_reg()
    {
        if ($this->isPOST()) {
            new_user($_POST['emailreg'], $_POST['passreg']);
            header("Location: index.php?act=auth");
        }
        $this->title = "Регистрация";
        $this->content = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_reg.php");
    }
    public function action_contacts()
    {
        $this->title = "Контакты";
        $this->content = $this->Template("../templates/v_contacts.php");
    }
    public function action_cart()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            $cart = getcart($_SESSION['user']);
        }
        if (isset($_GET['delete'])) {
            del_cart($_GET['delete'], $_SESSION['user']);
            $cart = getcart($_SESSION['user']);
        }
        $this->title = "Корзина";
        $this->content = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_cart.php", array('cart' => $cart));
    }
    public function action_account()
    {
        session_start();
        $user_full = get_user_full($_SESSION['user']);

        $this->title = "Личный кабинет";
        $this->content = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_account.php", array('user' => $user_full));
    }
    public function action_order()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            $order = getcart($_SESSION['user']);
        }

        if ($this->isPOST() && isset($_POST['address'])) {
            $info_order = array();
            $info_order['address'] = $_POST['address'];
            $info_order['user_id'] = $_SESSION['user'];
            new_order($info_order);
            header("Location: index.php");
        }

        $this->title = "Оформление заказа";
        $this->content = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_order.php", array('order' => $order));
    }
    public function action_admin()
    {
        if ($this->isPOST()) {
            update_status($_POST['id'], $_POST['status']);
        }
        $orders = get_orders();

        $this->title = "Заказы";
        $this->content = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_admin.php", array('orders' => $orders));
    }
}
