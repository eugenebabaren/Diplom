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
            <section class="card wow fadeIn d-flex mt-5 ml-3 mr-3">
                <div class="row ml-5 mr-5 mt-5 mb-3">
                    <div class="col-md-6 col-md-6 mb-5 pt-2 pr-5">
                        <h4 class="font-weight-bold mb-2">
                            <i class="fas fa-user amber-text pr-2"></i> Для кого наш магазин?
                        </h4>
                        <p class="text-muted pt-3">
                            Мы продаем товары для всех людей, которые заботятся о своем здоровье! Однако, у нас есть принципы, которых мы придерживаемся и это принципы нестрогого вегетарианства.
                            <br>
                             Мы НЕ продаем:
                            <br>
                            - рыбу, мясо, яйца;
                            <br>
                            - алкоголь и табак;
                            <br>
                            - товары с синтетическими сульфатами, парабенами, красителями;
                            <br>
                            - товары с усилителями вкуса и запаха;
                            <br>
                            - товары, содержащие ПАВ синтетического проихождения, отдушки.
                        </p>
                    </div>
                    <div class="col-md-6 col-md-6 mb-5 pl-4 pt-2">
                        <h4 class="font-weight-bold mb-2">
                            <i class="fas fa-list-alt red-text pr-2"></i> Как мы подбираем товары?
                        </h4>
                        <p class="text-muted pt-3">
                            Мы заметили, что в Беларуси очень сложно найти товары, которые действительно являются экологическими, безопасными для здоровья человека и не несущими вреда природе. Именно поэтому, мы решили создать интернет-магазин здорового питания.
                            <br>
                            Мы заметили ещё одну вещь: многие производители, которые утверждают, что у них товары экологические, на самом деле правы лишь частично. Мы стали более подробно изучать состав каждого товара и заметили, что те производители, которые пишут с натуральными компонентами, или без отдушек, консервантов и т.п. вместо одних опасных веществ используют другие.
                            <br>
                            Мы большие скептики по поводу качества предлагаемых «полезных» товаров, поэтому мы отбрасываем всю шелуху и оставляем только на 100% полезное.
                        </p>
                    </div>
                    <div class="col-md-6 col-md-6 mb-5 pr-5">
                        <h4 class="font-weight-bold mb-2">
                            <i class="fas fa-angle-double-right blue-text pr-2"></i> К чему мы идем?
                        </h4>
                        <p class="text-muted pt-3 mb-md-0">
                            Мы постоянно работаем над тем, чтобы цены были доступнее, а качество товаров выше. Наша команда всегда в поиске самых качественных товаров из лучших источников. Цель нашего проекта - сделать здоровье и красоту доступными для каждого! 
                            <br>
                            Мы хотим создать гипермаркет натуральных, экологических товаров, где каждый покупатель мог бы уверенно и без опаски покупать экотовары.
                        </p>
                    </div>
                    <div class="col-md-6 col-md-6 mb-5 pl-4">
                        <h4 class="font-weight-bold mb-2">
                            <i class="fas fa-chart-bar green-text pr-2"></i> Наша статистика
                        </h4>
                        <p class="text-muted pt-3 mb-md-0">
                            Только за неделю в магазине осуществляется от 350 продаж. Для тех, кто еще не бывал у нас в магазине в г.Витебск, ул.Гагарина 41, 2 этаж, обязательно посетите. Мы расширяем ассортимент, проводим дегустации, следим за качеством обслуживания и делаем магазин ещё красивее и уютнее.
                            <br>
                            Мы сами постоянно пользуюемся своим товаром, мы вместе пробуем и обсуждаем новинки. И готовы делиться с вами нашими находками!
                            <br>
                            Наш сайт в сутки посещает более 10000 человек.
                            <br>
                            Наш охват ВСЯ БЕЛАРУСЬ. Сложно найти регион в который мы не доставляли товар почтовой посылкой.
                        </p>
                    </div>
                </div>
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