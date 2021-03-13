<?php

include "controllers/Controller.php";
include 'controllers/C_Page.php';


//site.ru/index.php?act=auth&c=User


$action = 'action_';
$action .= (isset($_GET['act'])) ? $_GET['act'] : 'index';



$controller = new C_Page();


$controller->Request($action);
