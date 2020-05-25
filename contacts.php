<?php

include("include/db_connect.php");
include("functions/functions.php");
session_start();
include("include/auth_cookie.php");

include("include/sorting.php");

$id = clearString($_GET["id"]);
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

        <!-- NAVBAR -->
        <?php
        include("include/navbar.php");
        ?>

    </header>

    <main>

        <!--Section: Content-->
        <div class="mt-2 pt-5 mb-3">
            <section class="card wow fadeIn d-flex mt-5 p-5 ml-3 mr-3">

                <h2 class="font-weight-bold">Наши контакты</h2>

                <!--Grid row-->
                <div class="row pb-4 pt-4 mr-0 pr-0">

                    <!--Grid column-->
                    <div class="col-lg-5 col-md-12 mb-0 mb-md-0">

                        <p class="font-weight-bold mb-1">Время работы интернет-магазина:</p>
                        <p class="mb-4">Пн.–сб. с 9:00 до 21:00</p>

                        <p class="font-weight-bold mb-1">Доставка заказов:</p>
                        <p class="mb-4">Пн.–сб. с 10:00 до 23:00</p>

                        <p class="font-weight-bold mb-1">Телефоны:</p>

                        <p class="mb-2">+375 (29) 234-54-34</p>
                        <p class="mb-4">+375 (29) 190-23-99</p>

                        <p class="font-weight-bold mb-1">E-mail:</p>
                        <p class="mb-4"><a href="mailto:zpitanie040@gmail.com">zpitanie040@gmail.com</a></p>

                        <p class="font-weight-bold mb-1">Адрес точки самовывоза:</p>
                        <p class="mb-4">210017, Беларусь, Витебск, улица Гагарина, 41 </p>


                    </div>
                    <!--Grid column-->

                    <div class="col mb-0 md-0 ml-0 pl-0 mr-0 pr-2 mb-4">

                        <p class="font-weight-bold">Точка самовывоза на карте:</p>
                        <!--Google map-->
                        <div id="map-container-google-1" class="map-container mb-4 w-100 h-100">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2276.395359661369!2d30.227304715909593!3d55.21133318041204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46c5741c97dbd963%3A0x43ce9adfbbb395a4!2z0KTQuNC70LjQsNC7INCR0JPQotCjIMKr0JLQuNGC0LXQsdGB0LrQuNC5INCz0L7RgdGD0LTQsNGA0YHRgtCy0LXQvdC90YvQuSDRgtC10YXQvdC-0LvQvtCz0LjRh9C10YHQutC40Lkg0LrQvtC70LvQtdC00LbCuw!5e0!3m2!1sru!2sby!4v1589871544333!5m2!1sru!2sby" frameborder="0" style="border:0" allowfullscreen class="w-100 h-100"></iframe>
                        </div>
                        <!--Google Maps-->

                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

            </section>
        </div>

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