<?php
require "Twig/Autoloader.php";
require "bdconnect.php";



Twig_Autoloader::register();
$title = "Фото";
try {
    $loader = new Twig_Loader_Filesystem("templates");
    $twig = new Twig_Environment($loader);
    $template = $twig->loadTemplate("showphoto.tmpl");
    $photo = $_GET['img'];

    echo $content = $template->render(array('photo' => $photo, 'title' => $title));
} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}
