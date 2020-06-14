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
                <div class="container my-5">


                    <!--Section: Content-->
                    <section>

                        <h6 class="font-weight-normal text-uppercase font-small grey-text mb-4 text-center">FAQ</h6>
                        <!-- Section heading -->
                        <h2 class="font-weight-bold black-text mb-4 pb-2 text-center">Часто задаваемые вопросы</h2>
                        <hr class="w-header pb-4">
                        <!-- Section description -->

                        <div class="row">
                            <div class="col-md-12 col-lg-10 mx-auto mb-5">

                                <!--Accordion wrapper-->
                                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                                    <!-- Accordion card -->
                                    <div class="card border-top border-bottom-0 border-left border-right border-light">

                                        <!-- Card header -->
                                        <div class="card-header border-bottom border-light" role="tab" id="headingOne1">
                                            <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1">
                                                <h5 class="black-text font-weight-normal mb-0">
                                                    <i class="fas fa-angle-down rotate-icon text-success mr-2"></i>
                                                    Какие документы подтверждают приобретение товара?
                                                </h5>
                                            </a>
                                        </div>

                                        <!-- Card body -->
                                        <div id="collapseOne1" class="collapse" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                                            <div class="card-body">
                                                В нашем интернет магазине основным документом является кассовый чек, который Вы получаете в момент расчета за приобретаемый товар.
                                                <br>
                                                Данный чек Вам выдадут:
                                                <br>
                                                - на точке самовывоза;
                                                <br>
                                                - при доставке товаров курьером;
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Accordion card -->

                                    <!-- Accordion card -->
                                    <div class="card border-bottom-0 border-left border-right border-light">

                                        <!-- Card header -->
                                        <div class="card-header border-bottom border-light" role="tab" id="headingTwo2">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                                <h5 class="black-text font-weight-normal mb-0">
                                                    <i class="fas fa-angle-down rotate-icon text-success mr-2"></i>
                                                    Отследить посылку
                                                </h5>
                                            </a>
                                        </div>

                                        <!-- Card body -->
                                        <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
                                            <div class="card-body">
                                                Отследить местоположение посылки вы можете по данной ссылке <a href="http://webservices.belpost.by/searchRu.aspx">http://webservices.belpost.by/searchRu.aspx</a> для этого вам нужно ввести штрих код в графе "Введите номер отправления". 
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Accordion card -->

                                    <!-- Accordion card -->
                                    <div class="card border-bottom-0 border-left border-right border-light">

                                        <!-- Card header -->
                                        <div class="card-header border-bottom border-light" role="tab" id="headingThree3">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                                                <h5 class="black-text font-weight-normal mb-0">
                                                    <i class="fas fa-angle-down rotate-icon text-success mr-2"></i>
                                                    Как сделать заказ?
                                                </h5>
                                            </a>
                                        </div>

                                        <!-- Card body -->
                                        <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3" data-parent="#accordionEx">
                                            <div class="card-body">
                                                Для того, чтобы сделать заказ, пожалуйста, выберите интересующие вас товары из электронного каталога и добавьте их в корзину. Там укажите нужное количество, введите свою контактную информацию и подтвердите заказ.
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Accordion card -->

                                    <!-- Accordion card -->
                                    <div class="card border-bottom-0 border-left border-right border-light">

                                        <!-- Card header -->
                                        <div class="card-header border-bottom border-light" role="tab" id="headingThree5">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree5" aria-expanded="false" aria-controls="collapseThree5">
                                                <h5 class="black-text font-weight-normal mb-0">
                                                    <i class="fas fa-angle-down rotate-icon text-success mr-2"></i>
                                                    Как отменить заказ?
                                                </h5>
                                            </a>
                                        </div>

                                        <!-- Card body -->
                                        <div id="collapseThree5" class="collapse" role="tabpanel" aria-labelledby="headingThree5" data-parent="#accordionEx">
                                            <div class="card-body">
                                                Отменить заказ на сайте может только авторизированный пользователь и только, если заказ находится в статусе "Не обработан". Для того, чтобы отменить заказ, зайдите в свой профиль, перейдите в "Мои заказы". Далее выберите необходимый заказ, нажмите на кнопку "Подробнее" и отмените его.
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Accordion card -->

                                    <!-- Accordion card -->
                                    <div class="card border-left border-right border-light">

                                        <!-- Card header -->
                                        <div class="card-header border-bottom border-light" role="tab" id="headingThree4">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree4" aria-expanded="false" aria-controls="collapseThree4">
                                                <h5 class="black-text font-weight-normal mb-0">
                                                    <i class="fas fa-angle-down rotate-icon text-success mr-2"></i>
                                                    Я живу не в Витебске. Как мне получить мой заказ?
                                                </h5>
                                            </a>
                                        </div>

                                        <!-- Card body -->
                                        <div id="collapseThree4" class="collapse" role="tabpanel" aria-labelledby="headingThree4" data-parent="#accordionEx">
                                            <div class="card-body">
                                                Заказы мы отправляем по Белпочте.

                                                После Вашей заявки оформляется заказ и отправляется по почте на указанный Вами адрес (в субботу и воскресение товары не отправляются). Почта прибывает в течение 2-3 дней. После отправки посылки вам на телефон придет смс оповещение в котором будет указанна сумма и штрихкод для отслеживания местоположение посылки. 

                                                В данном случае стоимость покупки будет следующая:

                                                Стоимость товаров + услуги почты (расчитать стоимость почты вы можете по ссылке <a href="http://tarifikator.belpost.by/forms/internal/parcel.php">http://tarifikator.belpost.by/forms/internal/parcel.php</a>)
                                                Из чего состоит цена пересылки описано выше в разделе "Как узнать стоимость пересылки"?
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Accordion card -->

                                </div>
                                <!-- Accordion wrapper -->

                            </div>
                        </div>

                    </section>


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