<?php

include("include/db_connect.php");
include("include/functions.php");
session_start();

if ($_SESSION['auth_admin'] == 'yes_auth') {
    if (isset($_GET["logout"])) {
        session_destroy();
        header("Location: login.php");
    }
} else {
    header("Location: login.php");
}

$id = clearString($_GET["id"]);
$action = $_GET["action"];

if(isset($action)) {
    switch ($action) {
        case 'accept':
            $update = mysqli_query($link, "UPDATE orders SET order_confirmed='yes' WHERE order_id='$id'");
            break;

        case 'delete':
            $delete = mysqli_query($link, "DELETE FROM orders WHERE order_id='$id'");
            header("Location: orders.php");
            break;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Админ. панель</title>
    <!-- MDB icon -->
    <link rel="icon" href="../images/fruit.svg" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
</head>

<body class="grey lighten-3">
    <header>

        <!-- NAVBAR -->
        <?php
        include("include/navbar.php");
        ?>

    </header>

    <main>

        <?php
        include("include/sidebar.php");
        ?>

        <div class="finder ml-3 mr-2 mb-0 justify-content-between">
            

            <section class="col mb-3 p-0">
                <div class="card wow fadeIn d-flex m-0 p-4">


                    <?php
                    
                    $query_reviews = mysqli_query($link, "SELECT * FROM orders WHERE order_id = '$id'");

                        $row_reviews = mysqli_fetch_array($query_reviews);

                        do {

                            echo '
                                    <div class="row ml-1 pt-2">
                                        <div class="col-lg-6 text-left">
                                            <p>' . $row_reviews["order_datetime"] . '</p>
                                            <p class="ml-xl-0 font-weight-bold">Заказ №' . $row_reviews["order_id"] . ' - 
                                            ';
                                            if($row_reviews["order_confirmed"] == 'yes') {
                                                echo '<span class="text-success">Обработан</span>';

                                                $ml_auto = ' ml-auto';
                                            }
                                            else {
                                                echo '<span class="text-danger">Не обработан</span>';

                                                $btn_confirm = '
                                                <a href="view_order.php?id=' . $row_reviews["order_id"] . '&action=accept" class="ml-auto h-75">
                                                    <button class="btn btn-success">
                                                        Подтвердить заказ
                                                    </button> 
                                                </a> ';

                                                
                                            }
                                            echo '
                                            </p>
                                            
                                        </div>
                                        '.$btn_confirm.'
                                        <a rel="view_order.php?id=' . $row_reviews["order_id"] . '&action=delete" class="delete mr-3 h-75 '.$ml_auto.'">
                                            <button class="btn btn-danger">
                                                Удалить заказ
                                            </button> 
                                        </a>

                            ';
                        } while ($row_reviews = mysqli_fetch_array($query_reviews));
                    



                    $query_product = mysqli_query($link, "SELECT * FROM buy_products, products WHERE buy_products.buy_id_order = '$id' AND products.products_id = buy_products.buy_id_product");

                        $row_result = mysqli_fetch_array($query_product);

                        do {

                            
                            $price = $price + $row_result["price"] * $row_result["buy_count_product"];

                            

                            echo '
                                    
                                    <div class="col-lg-12 text-left">  
                                        <hr class="mr-2">     
                                        <p class="mb-2">Наименование товара: ' . $row_result["title"] . '</p>
                                        <p class="mb-2">Цена: ' . $row_result["price"] . ' руб.</p>
                                        <p class="mb-0">Количество: ' . $row_result["buy_count_product"] . '</p>                     
                                    </div>
                                
                                
                            ';
                        } while ($row_result = mysqli_fetch_array($query_product));

                        $query_reviews = mysqli_query($link, "SELECT * FROM orders WHERE order_id = '$id'");

                        $row_reviews = mysqli_fetch_array($query_reviews);
                        echo '
                            <div class="col-lg-12 text-left"> 
                                <hr class="mr-2">
                                <p class="mb-2"><span class="font-weight-bold">ФИО: </span>' . $row_reviews["order_FIO"] . '</p> 
                                <p class="mb-2"><span class="font-weight-bold">Адрес: </span>' . $row_reviews["order_address"] . '</p> 
                                <p class="mb-2"><span class="font-weight-bold">E-mail: </span>' . $row_reviews["order_email"] . '</p> 
                                <p class="mb-2"><span class="font-weight-bold">Телефон: </span>' . $row_reviews["order_phone"] . '</p> 
                                <p class="mb-2"><span class="font-weight-bold">Примечание: </span>' . $row_reviews["order_note"] . '</p> 
                                <p class="mb-2"><span class="font-weight-bold">Способ доставки: </span>' . $row_reviews["order_delivery"] . '</p>
                                <p class="mb-0"><span class="font-weight-bold">Итоговая цена: </span>' . $price . ' руб.</p>                    
                            </div>
                        </div> ';
                        
                    
                    ?>

                
                </div>
            </section>

        </div>
    </main>


    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Your custom scripts (optional) -->
    <script src="js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</body>

</html>