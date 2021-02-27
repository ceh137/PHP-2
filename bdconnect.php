<?php 
 const SERVER = 'localhost:8889';
 const DB = 'geekbrains';
 const LOGIN  = 'root';
 const PASS = 'root';
 $connect  = mysqli_connect(SERVER, LOGIN, PASS, DB)
 or die("Ошибка " . mysqli_error($connect));
