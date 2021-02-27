<?php
require "Twig/Autoloader.php";
require "bdconnect.php";



Twig_Autoloader::register();
$title = "Каталог фото";
try {
    $loader = new Twig_Loader_Filesystem("templates");
    $twig = new Twig_Environment($loader);
    $template = $twig->loadTemplate("index.tmpl");
    $sql = "select * from Photos";
    $result = mysqli_query($connect, $sql);
    $photos = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $path = $row['path'];
        $photos[] = $path;
    }

    echo $content = $template->render(array('photos' => $photos, 'title' => $title));
} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}
