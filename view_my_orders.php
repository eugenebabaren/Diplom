<?php

include("include/db_connect.php");
include("functions/functions.php");
session_start();

if ($_SESSION['auth'] == 'yes_auth') {
} else {
    header("Location: exit.php");
}

$id = $_GET["id"];
$action = $_GET["action"];

if(isset($action)) {
    switch ($action) {

        case 'delete':
            $delete = mysqli_query($link, "DELETE FROM orders WHERE order_id='$id'");
            header("Location: my_orders.php");
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
    <title>Здоровое питание</title>
    <!-- MDB icon -->
    <link rel="icon" href="images/fruit.svg" type="image/x-icon">
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

        <div class="col-12 finder mb-0 justify-content-between">
            <!-- <div class="container-fluid d-flex"> -->


            <section class="col mb-3 p-0">
                <div class="card wow fadeIn d-flex m-0 p-4">


                    <?php

                    $query_reviews = mysqli_query($link, "SELECT * FROM orders WHERE order_id='$id'");

                    $row_reviews = mysqli_fetch_array($query_reviews);

                    do {

                        echo '
                                <div class="row ml-1 pt-2">
                                    <div class="col-lg-6 text-left mt-4">
                                        <p><span class="font-weight-bold">Заказ сделан: </span>' . $row_reviews["order_datetime"] . '</p>
                                        ';
                                            if($row_reviews["order_confirmed"] == 'yes') {
                                                echo '<span class="text-success font-weight-bold">Обработан</span>';
                                            }
                                            else {
                                                echo '<span class="text-danger font-weight-bold">Не обработан</span>';
                                            }
                                            echo '
                                    </div>';

                                    if($row_reviews["order_confirmed"] == 'no') {
                                        echo '
                                        <a rel="view_my_orders.php?id=' . $id . '&action=delete" class="delete mr-3 h-75 ml-auto">
                                            <button class="btn btn-danger">
                                                Отменить заказ
                                            </button> 
                                        </a>
                                        </div>
                                        ';
                                    }
                                   

                    } while ($row_reviews = mysqli_fetch_array($query_reviews));
                



                $query_product = mysqli_query($link, "SELECT * FROM buy_products, products WHERE buy_products.buy_id_order = '$id' AND products.products_id = buy_products.buy_id_product");

                $row_result = mysqli_fetch_array($query_product);

                    do {

                        
                        $price = $price + $row_result["price"] * $row_result["buy_count_product"];

                        

                        if (!empty($row_result["title"])) {
                            echo '
                                    
                                <div class="col-lg-12 text-left">  
                                    <hr class="mr-2">     
                                    <p class="mb-2">Наименование товара: ' . $row_result["title"] . '</p>
                                    <p class="mb-2">Цена: ' . $row_result["price"] . ' руб.</p>
                                    <p class="mb-0">Количество: ' . $row_result["buy_count_product"] . '</p>                     
                                </div>
                            
                            
                            ';
                        } else {
                            echo '
                                        
                                    <div class="col-lg-12 text-left">  
                                        <hr class="mr-2">     
                                        <p class="mb-2">Такого товара больше не существует</p>                  
                                    </div>
                                
                                
                                ';
                        }
                    } while ($row_result = mysqli_fetch_array($query_product));

                    $query_reviews = mysqli_query($link, "SELECT * FROM orders WHERE order_id='$id'");

                    $row_reviews = mysqli_fetch_array($query_reviews);
                    echo '
                        <div class="col-lg-12 text-left"> 
                            <hr class="mr-2">
                            <p class="mb-2"><span class="font-weight-bold">ФИО: </span>' . $row_reviews["order_FIO"] . '</p> 
                            <p class="mb-2"><span class="font-weight-bold">Адрес: </span>' . $row_reviews["order_address"] . '</p> 
                            <p class="mb-2"><span class="font-weight-bold">E-mail: </span>' . $row_reviews["order_email"] . '</p> 
                            <p class="mb-2"><span class="font-weight-bold">Телефон: </span>' . $row_reviews["order_phone"] . '</p>'; 

                            if($row_reviews["order_note"] != "") {
                                echo '<p class="mb-2"><span class="font-weight-bold">Примечание: </span>' . $row_reviews["order_note"] . '</p>';
                            }

                            echo ' 
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