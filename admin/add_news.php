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



if (isset($_POST['add_news_form_submit'])) {

    setlocale(LC_ALL, "ru_RU.UTF-8");

    if (strlen($_POST["title"]) < 1) {
        $error[] = "Укажите заголовок!";

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            let mes1 = document.getElementById("titleHelpBlock");
            let inp1 = document.getElementById("title");
            mes1.innerHTML = "Укажите заголовок!";
            mes1.style.color = "red";
            mes1.hidden = false;
            inp1.classList.remove("mb-4");
            inp1.classList.add("mb-2");
        });
        </script>
        ';
    }

    if (strlen($_POST["descr"]) < 1) {
        $error[] = "Укажите описание!";

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            let mes2 = document.getElementById("descrHelpBlock");
            let inp2 = document.getElementById("descr");
            mes2.innerHTML = "Укажите описание!";
            mes2.style.color = "red";
            mes2.hidden = false;
            inp2.classList.remove("mb-4");
            inp2.classList.add("mb-2");
        });
        </script>
        ';
    }


    //ДОБАВЛЕНИЕ
    if (empty($error)) {

        mysqli_query($link, "INSERT INTO news(title, text, date)
            values('" . $_POST["title"] . "',
                   '" . $_POST["descr"] . "',
                   NOW()
                    )");

        header("Location: news.php");
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

        <div class="finder ml-3 mr-2 mb-3">
            <!-- <div class="container-fluid d-flex"> -->
            <div class="card mb-3wow fadeIn text-align-center">
                <div class="col-auto ml-1 mt-2">
                    <form method="POST" class="ml-4">
                        <!-- Default form register -->

                        <p id="profile_message" class="h4 mb-4"></p>

                        <div id="form-profile">

                            <p class="h4 mb-4 font-weight-bold">Добавление новости</p>

                            <p id="message-success-edit" class="h5 mb-4 text-success" hidden>Данные успешно изменены!</p>


                            <label data-error="wrong" data-success="right" for="title">Заголовок</label>
                            <input type="text" name="title" id="title" class="form-control mb-4 w-75" placeholder="Заголовок" autocomplete="off">
                            <small id="titleHelpBlock" class="form-text mb-4" hidden>
                                At least 8 characters and 1 digit
                            </small>


                            <label data-error="wrong" data-success="right" for="descr">Описание</label>
                            <input type="text" name="descr" id="descr" class="form-control mb-4 w-75" placeholder="Описание">
                            <small id="descrHelpBlock" class="form-text mb-4" hidden>
                                At least 8 characters and 1 digit
                            </small>


                            <!-- Sign up button -->
                            <button type="submit" name="add_news_form_submit" id="add_news_form_submit" class="btn btn-success mt-3 mb-5">Добавить</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>

    </main>


    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
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