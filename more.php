<?php

if (isset($_GET['more'])) {
    $id = $_GET['id'];
    $id += 10;
}
header("Location: main.php?id=$id");
