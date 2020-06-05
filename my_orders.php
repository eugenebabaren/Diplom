<?php

include("include/db_connect.php");
include("functions/functions.php");
session_start();

if ($_SESSION['auth'] == 'yes_auth') {
} else {
    header("Location: exit.php");
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

                <h3 class="ml-3 font-weight-bold mb-4 mt-2">Мои заказы</h3>

                    <?php

                    $query_reviews = mysqli_query($link, "SELECT * FROM orders WHERE order_email='{$_SESSION["auth_email"]}' ORDER BY order_id DESC");

                    if (mysqli_num_rows($query_reviews) > 0) {
                        $row_reviews = mysqli_fetch_array($query_reviews);


                        do {

                            echo '
                                    <div class="row ml-1 pt-2">
                                        <div class="col-lg-3 text-left">
                                            <p>' . $row_reviews["order_datetime"] . '</strong></p>
                                             
                                            ';
                                            if($row_reviews["order_confirmed"] == 'yes') {
                                                echo '<span class="text-success font-weight-bold">Обработан</span>';
                                            }
                                            else {
                                                echo '<span class="text-danger font-weight-bold">Не обработан</span>';
                                            }
                                            echo '
                                            </p>
                                        </div>
                                        <a href="view_my_orders.php?id=' . $row_reviews["order_id"] . '" class="ml-auto mr-3 h-75">
                                            <button class="btn btn-success">
                                                Подробнее
                                            </button> 
                                        </a>                      
                                    </div>

                                    
                                    <hr class="mr-1">

                            ';
                        } while ($row_reviews = mysqli_fetch_array($query_reviews));
                    }
                    else {
                        echo '
                        <h4 class="ml-3 mb-4 mt-2">Вы еще не сделали ни одного заказа</h4>
                        ';
                    }
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