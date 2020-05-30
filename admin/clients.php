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

$id = $_GET["id"];
$action = $_GET["action"];
if (isset($action)) {

    switch ($action) {

        case 'delete':

            $delete = mysqli_query($link, "DELETE FROM reg_user WHERE id = '$id'");

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

                    $all_count = mysqli_query($link, "SELECT * FROM reg_user");
                    $all_count_result = mysqli_num_rows($all_count);

                    ?>
                    <h4 class="mt-2 mr-4">Клиентов - <span class="font-weight-bold"><?php echo $all_count_result ?></span></h4>

                </div>
            </div>
            <section class="col mb-3 p-0">
                <div class="card wow fadeIn d-flex m-0 p-4">


                    <?php
                    $query_reviews = mysqli_query($link, "SELECT * FROM reg_user ORDER BY id DESC");

                    if (mysqli_num_rows($query_reviews) > 0) {
                        $row_reviews = mysqli_fetch_array($query_reviews);


                        do {

                            echo '
                                    <div class="row pt-4">
                                

                                        <div class="col-lg-9 text-md-left pb-4 pl-4">
                                            <p class="ml-xl-0 ml-5 font-weight-bold">E-MAIL: <strong>' . $row_reviews["email"] . '</strong></p>

                                            <p class="ml-xl-0 ml-5 font-weight-bold">ФИО: <strong>' . $row_reviews["surname"] . ' ' . $row_reviews["name"] . ' ' . $row_reviews["patronymic"] . '</strong></p>

                                            <p class="ml-xl-0 ml-5 font-weight-bold">Телефон: <strong>' . $row_reviews["phone"] . '</strong></p>

                                            <p class="ml-xl-0 ml-5 font-weight-bold">Адрес: <strong>' . $row_reviews["address"] . '</strong></p>

                                            <p class="ml-xl-0 ml-5 font-weight-bold">Дата регистрации: <strong>' . $row_reviews["datetime"] . '</strong></p>
                                            
                                        </div>
                                        
                                    </div>

                                    <button class="delete btn btn-danger mb-2 ml-auto" rel="clients.php?id=' . $row_reviews["id"] . '&action=delete">
                                        Удалить
                                    </button>
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