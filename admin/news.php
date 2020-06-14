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

$action = $_GET["action"];
if (isset($action)) {

    $id = (int) $_GET["id"];

    switch ($action) {

        case 'delete':

            $delete = mysqli_query($link, "DELETE FROM news WHERE id = '$id'");

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

                    $all_count = mysqli_query($link, "SELECT * FROM news");
                    $all_count_result = mysqli_num_rows($all_count);

                    ?>
                    <h4 class="mt-3 mr-4">Всего новостей - <span class="font-weight-bold"><?php echo $all_count_result ?></span></h4>


                    <a href="add_news.php" class="ml-auto">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus mr-2"></i>Добавить новость
                        </button>
                    </a>
                </div>
            </div>
            <section class="col mb-3 p-0">
                <div class="card wow fadeIn d-flex m-0 p-4">


                    <?php
                    $query_reviews = mysqli_query($link, "SELECT * FROM news ORDER BY id DESC");

                    if (mysqli_num_rows($query_reviews) > 0) {
                        $row_reviews = mysqli_fetch_array($query_reviews);


                        do {

                            echo '
                                    <div class="row pt-4">

                                        <div class="col-lg-12 text-md-left pb-4 pl-4">
                                            <h4 class="ml-xl-0 ml-5 font-weight-bold">' . $row_reviews["title"] . '</h4>

                                            <p class="ml-xl-0 ml-5">' . $row_reviews["date"] . '</p>

                                            <p class="col-lg-4 ml-xl-0 pl-0"><img class="img-fluid" src="../images/', $row_reviews["image"], '" alt="Card image cap"></p>

                                            <h6 class="ml-xl-0 ml-5">' . mb_strimwidth($row_reviews["text"], 0, 300, "...", "UTF-8") . '</h6>
                                            
                                        </div>
                                        
                                    </div>

                                    <div class="row ml-2 pt-4 mr-1">
                                        <a href="edit_news.php?id=' . $row_reviews["id"] . '" class="ml-auto">
                                            <button class="btn btn-success mb-2">
                                                Изменить
                                            </button>
                                        </a>

                                        <a class="">
                                            <button class="delete btn btn-danger ml-auto" rel="news.php?id=' . $row_reviews["id"] . '&action=delete">
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