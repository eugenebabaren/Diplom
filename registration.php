<?php

include("include/db_connect.php");
include("functions/functions.php");
session_start();

include("include/auth_cookie.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

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



</head>

<body class="grey lighten-3">
    <header>

        <!-- NAVBAR -->
        <?php
        include("include/navbar.php");
        ?>

    </header>


    <main>

        <form method="POST" id="form_reg" action="" class="my-text-center text-center border border-light p-5">
            <!-- Default form register -->

            <p id="reg_message" class="h4 mb-4"></p>

            <a href="sign_in.php">
                <button id="auth_but" type="button" class="btn btn-success my-4 btn mt-6 mb-5" hidden>Вход</button>
            </a>

            <div id="form-registration">

                <p class="h4 mb-4 font-weight-bold">Регистрация</p>

                <input type="text" name="login" id="reg_login" class="form-control mb-4" placeholder="Логин">
                <small id="loginHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>

                <!-- Password -->
                <input type="password" name="pass" id="reg_pass" class="form-control mb-2" placeholder="Пароль" aria-describedby="passwordHelpBlock">
                <small id="passwordHelpBlock" class="form-text text-muted mb-4">
                    Пароль должен быть от 8 до 15 символов латиницей и цифрами!
                </small>

                <input type="text" name="surname" id="reg_surname" class="form-control mb-4" placeholder="Фамилия">
                <small id="surnameHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>

                <input type="text" name="name" id="reg_name" class="form-control mb-4" placeholder="Имя">
                <small id="nameHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>

                <input type="text" name="patronymic" id="reg_patronymic" class="form-control mb-4" placeholder="Отчество">
                <small id="patronymicHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>

                <!-- E-mail -->
                <input type="text" name="email" id="reg_email" class="form-control mb-4" placeholder="E-mail">
                <small id="emailHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>


                <input type="text" name="phone" id="reg_phone" class="form-control mb-4" aria-describedby="defaultRegisterFormPhoneHelpBlock" placeholder="Телефон">
                <small id="phoneHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>


                <input type="text" name="address" id="reg_address" class="form-control mb-4" placeholder="Адрес доставки">
                <small id="addressHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>

                <!-- Sign up button -->
                <button type="submit" name="submit" id="form_submit" class="btn btn-success my-4 btn mt-6">Регистрация</button>
            </div>


        </form>


        <?php
        include("include/handler_reg.php");
        ?>
        <!-- Default form register -->

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