<?php
include_once "Controller.php";
class C_Basement extends Controller
{
    protected $title;
    protected $content;
    protected $note;

    protected function before()
    {

        $this->title = '';
        $this->content = '';
        $this->note = '';
    }

    public function __construct()
    {
        $this->title = "";
        $this->content = '';
        $this->note = '';
    }

    function render()
    {
        $vars = array('content' => $this->content, 'title' => $this->title, 'note' => $this->note);
        $page = $this->Template("/Applications/MAMP/htdocs/Homework4/templates/v_main.php", $vars);
        echo $page;
    }
    public function __call($name, $params)
    {
        die("error");
    }
}
