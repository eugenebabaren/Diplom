<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("include/db_connect.php");


    $delete = mysqli_query($link, "DELETE FROM brand WHERE id = '{$_POST["id"]}'");
    echo "delete";
}