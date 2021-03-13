<?php
include_once "C_Basement.php";
class C_User extends C_Basement
{
    public function action_auth()
    {
        $this->title = "Войти";
        $this->content = $this->Template("../templates/v_auth.php", array());
    }
    public function action_reg()
    {
        $this->title = "Регистрация";
        $this->content = $this->Template("../templates/v_reg.php", array());
    }
    public function action_account()
    {
        $this->title = "Личный Кабинет";
        $this->content = $this->Template("../templates/v_acc.php", array());
    }
    public function __call($name, $params)
    {
        die("error");
    }
}
