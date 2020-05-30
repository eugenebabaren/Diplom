<?php

session_start();

include("include/db_connect.php");
include("include/functions.php");

if (isset($_POST["admin_sign_submit"])) {

    $login = clearString($_POST["login"]);
    $pass = clearString($_POST["pass"]);

    if ($login && $pass) {
        $pass = md5($pass);

        if ($login == "admin" && $pass == "25d55ad283aa400af464c76d713c07ad") {

            $_SESSION['auth_admin'] = 'yes_auth';

            header("Location: tovar.php");
        } else {
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {

                let mes_auth_wrong = document.getElementById("message-auth");
                mes_auth_wrong.hidden = false;

            });
        </script>
        ';
        }
    } else {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {

                let mes_auth_wrong = document.getElementById("message-auth");
                mes_auth_wrong.hidden = false;

            });
        </script>
        ';
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
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
</head>

<body class="grey lighten-3">
    <header>

    </header>



    <!-- ФОРМА ВХОД -->
    <form method="POST" id="form_login" action="" class="my-text-center text-center p-5 pt-0 mt-0">

        <p class="h4 mb-4 mt-4 font-weight-bold">Вход</p>

        <p id="message-auth" class="h5 mb-4" hidden>Неверный логин и (или) пароль!</p>

        <input type="text" name="login" id="sign_login" class="form-control mb-4" placeholder="Введите логин">

        <!-- Password -->
        <input type="password" name="pass" id="sign_pass" class="form-control" placeholder="Введите пароль" aria-describedby="defaultLoginFormPasswordHelpBlock">

        <!-- Sign up button -->
        <button name="admin_sign_submit" class="btn btn-success my-4 btn mt-6" type="submit">Вход</button>

    </form>
    <!-- Default form register -->




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