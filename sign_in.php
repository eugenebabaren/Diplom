<?php

include("include/db_connect.php");
include("functions/functions.php");

session_start();

session_destroy();

session_start();

$login = clearString($_POST["auth_login"]);
$pass = md5(clearString($_POST["auth_pass"]));

include("include/auth_cookie.php");

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
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
</head>

<body class="grey lighten-3">
    <header>

        <?php
        include("include/navbar.php");
        ?>

    </header>

    <main>

        <!-- ФОРМА ВХОД -->
        <form method="POST" id="form_login" action="" class="my-text-center text-center border border-light p-5">

            <p class="h4 mb-4 mt-4 font-weight-bold">Вход</p>

            <p id="message-auth" class="h5 mb-4" hidden>Неверный логин и (или) пароль!</p>

            <input type="text" name="auth_login" id="sign_login" class="form-control mb-4" placeholder="Введите логин или e-mail">

            <!-- Password -->
            <input type="password" name="auth_pass" id="sign_pass" class="form-control" placeholder="Введите пароль" aria-describedby="defaultLoginFormPasswordHelpBlock">

            <div class="remem_me_forgot_pass d-flex justify-content-between mt-3">
                <div>
                    <a href="" id="remind_pass_but" data-toggle="modal" data-target="#modalLoginForm">Забыли пароль?</a>
                </div>
            </div>

            <!-- Sign up button -->
            <button name="sign_submit" id="form_submit" class="btn btn-success my-4 btn mt-6" type="submit">Вход</button>

        </form>
        <!-- Default form register -->



        <!-- ФОРМА ЗАБЫЛИ ПАРОЛЬ? -->
        <form method="POST" id="form_remind_pass" action="">
            <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title w-100 font-weight-bold ml-3">Восстановление пароля</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-3">
                            <div class="md-form mb-3">
                                <i class="fas fa-envelope prefix grey-text my-1 pr-4"></i>
                                <input type="text" name="remind_pass_email" class="form-control validate my-3">
                                <label data-error="wrong" data-success="right" for="remind_pass_email">E-mail</label>
                                <small id="forgotPassHelpBlock" class="form-text mb-3">
                                    ( Введите почтовый ящик указанный при регистрации )
                                </small>
                                <small id="error_forgotPassHelpBlock" class="form-text lead" hidden>
                                    Такого e-mail не существует или вы ничего не ввели!
                                </small>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" name="remind_pass_submit" class="btn btn-success">Отправить</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>



        <?php

        include("include/remind_pass.php");
        ?>

    </main>

    <?php
    include("include/footer.php");
    ?>


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