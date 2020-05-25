<?php

include("include/db_connect.php");
include("functions/functions.php");
session_start();

include("include/auth_cookie.php");

if ($_SESSION['auth'] == 'yes_auth') {

} else {
    header("Location: index.php");
}

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

        <form method="POST" id="form_profile" action="" class="my-text-center text-center border border-light p-5">
            <!-- Default form register -->

            <p id="profile_message" class="h4 mb-4"></p>

            <!-- <a href="sign_in.php">
            <button id="auth_but" type="button" class="btn btn-success my-4 btn mt-6" hidden>Вход</button>
        </a> -->

            <div id="form-profile">

                <p class="h4 mb-4 font-weight-bold">Изменение профиля</p>

                <p id="message-success-edit" class="h5 mb-4 text-success" hidden>Данные успешно изменены!</p>


                <label for="profile_current_pass">Текущий пароль</label>
                <input type="password" name="profile_current_pass" id="profile_current_pass" class="form-control mb-4" placeholder="Текущий пароль">
                <small id="loginHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>

                <label data-error="wrong" data-success="right" for="profile_new_pass">Новый пароль</label>
                <input type="password" name="profile_new_pass" id="profile_new_pass" class="form-control mb-2" placeholder="Новый пароль" aria-describedby="passwordHelpBlock">
                <small id="passwordHelpBlock" class="form-text text-muted mb-4">
                    Новый пароль должен быть от 8 до 15 символов латиницей и цифрами!
                </small>

                <label data-error="wrong" data-success="right" for="profile_surname">Фамилия</label>
                <input type="text" name="profile_surname" id="profile_surname" class="form-control mb-4" placeholder="Фамилия">
                <small id="surnameHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>

                <label data-error="wrong" data-success="right" for="profile_name">Имя</label>
                <input type="text" name="profile_name" id="profile_name" class="form-control mb-4" placeholder="Имя">
                <small id="nameHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>

                <label data-error="wrong" data-success="right" for="profile_patronymic">Отчество</label>
                <input type="text" name="profile_patronymic" id="profile_patronymic" class="form-control mb-4" placeholder="Отчество">
                <small id="patronymicHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>

                <label data-error="wrong" data-success="right" for="profile_email">E-mail</label>
                <input type="text" name="profile_email" id="profile_email" class="form-control mb-4" placeholder="E-mail">
                <small id="emailHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>

                <label data-error="wrong" data-success="right" for="profile_phone">Телефон</label>
                <input type="text" name="profile_phone" id="profile_phone" class="form-control mb-4" aria-describedby="defaultRegisterFormPhoneHelpBlock" placeholder="Телефон">
                <small id="phoneHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>

                <label data-error="wrong" data-success="right" for="profile_address">Адрес доставки</label>
                <input type="text" name="profile_address" id="profile_address" class="form-control mb-4" placeholder="Адрес доставки">
                <small id="addressHelpBlock" class="form-text mb-4" hidden>
                    At least 8 characters and 1 digit
                </small>

                <!-- Sign up button -->
                <button type="submit" name="profile_form_submit" id="profile_form_submit" class="btn btn-success my-4 btn mt-6">Сохранить</button>
            </div>


        </form>


        <?php



        if (isset($_SESSION['auth_login'])) {
            echo '<script>
        document.addEventListener("DOMContentLoaded", function() {

        document.getElementById("profile_surname").value = "' . $_SESSION["auth_surname"] . '";
        document.getElementById("profile_name").value = "' . $_SESSION["auth_name"] . '";
        document.getElementById("profile_patronymic").value = "' . $_SESSION["auth_patronymic"] . '";
        document.getElementById("profile_email").value = "' . $_SESSION["auth_email"] . '";
        document.getElementById("profile_phone").value = "' . $_SESSION["auth_phone"] . '";
        document.getElementById("profile_address").value = "' . $_SESSION["auth_address"] . '";

        });


        //ПОЯВЛЕНИЕ И УДАЛЕНИЕ УСПЕШНОГО СООБЩЕНИЯ
        document.addEventListener("DOMContentLoaded", function() {
            if (localStorage.reload == 2) {
                document.getElementById("message-success-edit").hidden = false;
            }

            function removeMessSuccessEdit() {
                delete localStorage.reload;
            }
            setTimeout(removeMessSuccessEdit, 2000);
        });
        </script>
        ';
        }


        include("include/edit_profile.php");
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