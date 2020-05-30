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

$sort = $_GET["sort"];

switch ($sort) {
    case 'confirmed':
        $sort = "order_confirmed='yes' DESC";
        $sort_name = 'Обработанные';
        break;

    case 'no-confirmed':
        $sort = "order_confirmed='no' DESC";
        $sort_name = 'Не обработанные';
        break;

    default:
        $sort = "order_id DESC";
        $sort_name = 'Без сортировки';
        break;
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
            <!-- <div class="container-fluid d-flex"> -->
            <div class="card mb-3 wow fadeIn">
                <div class="card-body d-sm-flex">

                    <?php

                    $all_count = mysqli_query($link, "SELECT * FROM orders");
                    $all_count_result = mysqli_num_rows($all_count);

                    $buy_count = mysqli_query($link, "SELECT * FROM orders WHERE order_confirmed='yes'");
                    $buy_count_result = mysqli_num_rows($buy_count);

                    $no_buy_count = mysqli_query($link, "SELECT * FROM orders WHERE order_confirmed='no'");
                    $no_buy_count_result = mysqli_num_rows($no_buy_count);

                    ?>
                    <h4 class="mt-3 mr-4">Всего заказов - <span class="font-weight-bold"><?php echo $all_count_result ?></span></h4>
                    <h4 class="mt-3 mr-4">Обработанных - <span class="font-weight-bold"><?php echo $buy_count_result ?></span></h4>
                    <h4 class="mt-3 mr-4">Необработанных - <span class="font-weight-bold"><?php echo $no_buy_count_result ?></span></h4>

                    <div class=" ml-auto">
                        <button class="btn btn-success dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-sort mr-2"></i>Сортировка
                        </button>

                        <?php
                        echo '
                        <div class="dropdown-menu">
                            <a href="orders.php?sort=confirmed" class="dropdown-item">Обработанные</a>
                            <a href="orders.php?sort=no-confirmed" class="dropdown-item">Необработанные</a>
                            <div class="dropdown-divider"></div>
                            <a href="orders.php" class="dropdown-item btn-danger">Без сортировки</a>
                        </div>
                        ';
                        ?>

                    </div>
                </div>
            </div>

            <section class="col mb-3 p-0">
                <div class="card wow fadeIn d-flex m-0 p-4">


                    <?php
                    // $query_reviews = mysqli_query($link, "SELECT * FROM orders");
                    $query_reviews = mysqli_query($link, "SELECT * FROM orders ORDER BY $sort");

                    if (mysqli_num_rows($query_reviews) > 0) {
                        $row_reviews = mysqli_fetch_array($query_reviews);


                        do {

                            echo '
                                    <div class="row ml-1 pt-2">
                                        <div class="col-lg-3 text-left">
                                            <p>' . $row_reviews["order_datetime"] . '</strong></p>
                                            <p class="ml-xl-0 font-weight-bold">Заказ №' . $row_reviews["order_id"] . ' - 
                                            ';
                                            if($row_reviews["order_confirmed"] == 'yes') {
                                                echo '<span class="text-success">Обработан</span>';
                                            }
                                            else {
                                                echo '<span class="text-danger">Не обработан</span>';
                                            }
                                            echo '
                                            </p>
                                        </div>
                                        <a href="view_order.php?id=' . $row_reviews["order_id"] . '" class="ml-auto mr-3 h-75">
                                            <button class="btn btn-success">
                                                Подробнее
                                            </button> 
                                        </a>                      
                                    </div>

                                    
                                    <hr class="mr-1">

                            ';
                        } while ($row_reviews = mysqli_fetch_array($query_reviews));
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