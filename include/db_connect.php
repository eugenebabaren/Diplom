<?php

$db_host = 'localhost';
$db_user = 'admin';
$db_pass = '12345';
$db_database = 'db_shop';

$link = mysqli_connect($dbhost, $db_user, $db_pass);
mysqli_select_db($link, $db_database) or die("Нет соединения с БД".mysqli_error($link));
mysqli_set_charset($link, "UTF-8");

?>