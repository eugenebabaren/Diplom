<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include("include/db_connect.php");
    include("functions/functions.php");

    $id = clearString($_POST["id"]);

    $result = mysqli_query($link, "SELECT * FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cart_id_products = '$id'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $new_count = $row["cart_count"] + 1;
        $update = mysqli_query($link, "UPDATE cart SET cart_count='$new_count' WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cart_id_products = '$id'");
    } else {
        $result = mysqli_query($link, "SELECT * FROM products WHERE products_id = '$id'");
        $row = mysqli_fetch_array($result);

        mysqli_query($link, "INSERT INTO cart(cart_id_products, cart_price, cart_datetime, cart_ip)
        values(
            '" . $row['products_id'] . "',
            '" . $row['price'] . "',
            NOW(),
            '" . $_SERVER['REMOTE_ADDR'] . "')
        ");
    }
}
