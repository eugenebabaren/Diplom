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
        <section class="col text-center mt-2 pt-5">
            <div class="card wow fadeIn text-center d-flex mb-3 mt-5">


                <div class="row justify-content-center ml-5 mb-3">

                    <div class="col-lg-6 text-center text-md-center">


                        <h1 class="h1-responsive text-center text-md-left product-name font-weight-bold text-uppercase mb-1 ml-xl-0 mt-5 mb-4">Оплата и доставка</h1>


                        <div class="mr-3 text-left">

                        <p class="font-weight-bold mb-2">Возможные способы доставки:</p>
                        <p class="mb-2">1. Самовывоз в г. Витебске - улица Гагарина, 41  - БЕСПЛАТНО;</p>
                        <p class="mb-2">2. Доставка курьером по г. Витебску - 5 руб. по будням и 7 руб. по выходным дням. При заказе от 50 руб - БЕСПЛАТНО;</p>
                        <p class="mb-2">3. Отправка заказов почтой по РБ - от 4,5 руб;</p>
                        <p class="mb-4">4. Отправка заказов экспресс-почтой по РБ - 7,60 руб.</p>
                        
                        <p class="font-weight-bold mb-2">Способы оплаты (оплата производится после получения товара):</p>
                        <p class="mb-2">1. Наличными;</p>
                        <p class="mb-2">2. Банковской картой;</p>
                        <p class="mb-4">3. ЕРИП.</p>

                        <p class="font-weight-bold mb-2">Прочие условия:</p>
                        <p class="mb-2">- при наличии товара в магазине доставка возможна в этот же день до 21.00;</p>
                        <p class="mb-4">- при заказе после 17.00 доставка может осуществляться на следующий день с 10.00 до 21.00.</p>
                        
                        <p class="mb-4"><span class="font-weight-bold">Важно:</span> оформляя заказ оговаривайте заранее с менеджером все интересующие вас вопросы: курьер – это человек, который доставляет товар, он может не знать ответов на ваши вопросы.</p>
              </div>
    
            </div>
          </div>
          <hr class="mb-0">


            </div>
        </section>
        <!--Section: Content-->

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