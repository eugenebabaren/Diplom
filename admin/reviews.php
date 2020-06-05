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
$sort = $_GET["sort"];

switch ($sort) {
    case 'accept':
        $sort = "moderat='1' DESC";
        $sort_name = 'Проверенные';
        break;

    case 'no-accept':
        $sort = "moderat='0' DESC";
        $sort_name = 'Непроверенные';
        break;

    default:
        $sort = "reviews_id DESC";
        $sort_name = 'Без сортировки';
        break;
}


$action = $_GET["action"];
if (isset($action)) {
    switch ($action) {
        case 'accept':
            $update = mysqli_query($link, "UPDATE reviews SET moderat='1' WHERE reviews_id='$id'");
            break;

        case 'delete':
            $delete = mysqli_query($link, "DELETE FROM reviews WHERE reviews_id='$id'");
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
            <!-- <div class="container-fluid d-flex"> -->
            <div class="card mb-3 wow fadeIn">
                <div class="card-body d-sm-flex">

                    <?php

                    $all_count = mysqli_query($link, "SELECT * FROM reviews");
                    $all_count_result = mysqli_num_rows($all_count);

                    $all_count_no_accept = mysqli_query($link, "SELECT * FROM reviews WHERE moderat='0'");
                    $all_count_result_no_accept = mysqli_num_rows($all_count_no_accept);

                    ?>
                    <h4 class="mt-3 mr-4">Всего отзывов - <span class="font-weight-bold"><?php echo $all_count_result ?></span></h4>
                    <h4 class="mt-3 mr-4">Непроверенных - <span class="font-weight-bold"><?php echo $all_count_result_no_accept ?></span></h4>

                    <div class=" ml-auto">
                        <button class="btn btn-success dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-sort mr-2"></i>Сортировка
                        </button>

                        <?php
                        echo '
                        <div class="dropdown-menu">
                            <a href="reviews.php?sort=accept" class="dropdown-item">Проверенные</a>
                            <a href="reviews.php?sort=no-accept" class="dropdown-item">Непроверенные</a>
                            <div class="dropdown-divider"></div>
                            <a href="reviews.php" class="dropdown-item btn-danger">Без сортировки</a>
                        </div>
                        ';
                        ?>

                    </div>
                </div>
            </div>

            <section class="col mb-3 p-0">
                <div class="card wow fadeIn d-flex m-0 p-4">


                    <?php
                    $query_reviews = mysqli_query($link, "SELECT * FROM reviews,products WHERE products.products_id = reviews.products_id ORDER BY $sort");

                    if (mysqli_num_rows($query_reviews) > 0) {
                        $row_reviews = mysqli_fetch_array($query_reviews);


                        do {

                            $ml_auto = "";
                            $ml_null = "";

                            if ($row_reviews["moderat"] == '0') {
                                $btn_accept = '
                                <a href="reviews.php?id=' . $row_reviews["reviews_id"] . '&action=accept" class="ml-auto">
                                    <button class="btn btn-success mt-4 mb-2">
                                        Принять
                                    </button>
                                </a>';
                                $ml_null = "ml-0";
                            } else {
                                $btn_accept = '';
                                $ml_auto = "ml-auto";
                            }

                            echo '
                                    <div class="row ml-2 pt-4">
                                        <div class="col-lg-3 text-center">
                                            <span>' . $row_reviews["title"] . '</span>
                                            <img id="" src="../images/' . $row_reviews["image"] . '" class="w-100 img-fluid pr-3">
                                            
                                        </div>
                                

                                        <div class="col-lg-9 text-md-left pb-4 pl-4">
                                            <p class="ml-xl-0 ml-5"><span>' . $row_reviews["name"] . '</span><strong>, ' . $row_reviews["date"] . '</strong></p>

                                            <p class="ml-xl-0 ml-5"><i class="fas fa-plus text-success pr-2"></i><strong>' . $row_reviews["good_reviews"] . '</strong></p>
                                            <p class="ml-xl-0 ml-5"><i class="fas fa-minus text-danger pr-2"></i><strong>' . $row_reviews["bad_reviews"] . '</strong></p>

                                            <p class="ml-xl-0 ml-5"><strong>' . $row_reviews["comment"] . '</strong></p>
                                            
                                        </div>
                                        
                                    </div>

                                    <div class="row ml-2 pt-4">
                                        ' . $btn_accept . '

                                        <a class="' . $ml_auto . ' ' . $ml_null . '">

                                            <button class="delete btn btn-danger mt-4 mb-2 mr-3" rel="reviews.php?id=' . $row_reviews["reviews_id"] . '&action=delete">
                                                Удалить
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