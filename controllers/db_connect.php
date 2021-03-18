<?php
$dsn = DB_DRIVER . ':dbname=' . DB_NAME . ';host =' . DB_HOST . ';port=8889';
try {
    $db = new PDO($dsn, DB_USER, DB_PASS);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
