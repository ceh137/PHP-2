<?php
abstract class Controller
{
    abstract function render();

    public function Request($action)
    {
        $this->before();
        $this->$action();
        $this->render();
    }

    protected function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }
    protected function isPOST()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function Template($fileName, $vars = array())
    {
        foreach ($vars as $k => $v) {
            $$k = $v;
        }
        ob_start();
        include "$fileName";
        return ob_get_clean();
    }
    public function __call($name, $params)
    {
        die("error");
    }
}
