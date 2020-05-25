<?php

include("include/db_connect.php");
include("functions/functions.php");
session_start();
include("include/auth_cookie.php");

$id = clearString($_GET["id"]);
$action = clearString($_GET["action"]);

switch ($action) {
    case 'clear':
        $clear = mysqli_query($link, "DELETE FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'");
        break;
    case 'delete':
        $delete = mysqli_query($link, "DELETE FROM cart WHERE cart_id = '$id' AND cart_ip = '{$_SERVER['REMOTE_ADDR']}'");
        break;
}

if (isset($_POST['submitdata'])) {

    setlocale(LC_ALL, "ru_RU.UTF-8");

    if ($_SESSION['auth'] == 'yes_auth') {
        if (!$_POST["order_delivery"]) {
            $error[] = "Вы не выбрали способ доставки!";

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("mes-wrong-delivery").hidden = false;
            });
            </script>
            ';
        }

        $_SESSION['order_delivery'] = $_POST['order_delivery'];
        $_SESSION['order_note'] = $_POST['order_note'];
    } else {
        if (!$_POST["order_delivery"]) {
            $error[] = "Вы не выбрали способ доставки!";

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("mes-wrong-delivery").hidden = false;
            });
            </script>
            ';
        }

        if (strlen($_POST["order_fio"]) < 1 || !preg_match('/^[а-яА-Яa-zA-Z\s]*$/u', $_POST["order_fio"])) {
            $error[] = "ФИО должны быть не меньше 1 символа кириллицей или латиницей!";

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
            let mes1 = document.getElementById("order_fioHelpBlock");
            let inp1 = document.getElementById("order_fio");
            mes1.innerHTML = "ФИО должны быть не меньше 1 символа кириллицей или латиницей!";
            mes1.hidden = false;
            mes1.style.color = "red";
            inp1.classList.remove("mb-4");
            inp1.classList.add("mb-2");
            });
            </script>
            ';
        }

        if (!filter_var($_POST["order_email"], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Неправильно указан E-mail!";

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
            let mes2 = document.getElementById("order_emailHelpBlock");
            let inp2 = document.getElementById("order_email");
            mes2.innerHTML = "Неправильно указан E-mail!";
            mes2.hidden = false;
            mes2.style.color = "red";
            inp2.classList.remove("mb-4");
            inp2.classList.add("mb-2");
            });
            </script>
            ';
        } else {
            $result = mysqli_query($link, "SELECT email FROM reg_user WHERE email = '{$_POST['order_email']}'");
            if (mysqli_num_rows($result) > 0) {
                $error[] = "Такой e-mail уже занят!";

                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    let mes2 = document.getElementById("order_emailHelpBlock");
                    let inp2 = document.getElementById("order_email");
                    mes2.innerHTML = "Такой e-mail уже занят!";
                    mes2.hidden = false;
                    mes2.style.color = "red";
                    inp2.classList.remove("mb-4");
                    inp2.classList.add("mb-2");
                    });
                </script>
                ';
            }
        }

        if (strlen($_POST["order_phone"]) == "") {
            $error[] = "Укажите номер телефона!";

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
            let mes3 = document.getElementById("order_phoneHelpBlock");
            let inp3 = document.getElementById("order_phone");
            mes3.innerHTML = "Укажите номер телефона!";
            mes3.style.color = "red";
            mes3.hidden = false;
            inp3.classList.remove("mb-4");
            inp3.classList.add("mb-2");
            });
            </script>
            ';
        }

        if (strlen($_POST["order_address"]) < 1) {
            $error[] = "Укажите адрес!";

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
            let mes4 = document.getElementById("order_addressHelpBlock");
            let inp4 = document.getElementById("order_address");
            mes4.innerHTML = "Укажите адрес!";
            mes4.hidden = false;
            mes4.style.color = "red";
            inp4.classList.remove("mb-4");
            inp4.classList.add("mb-2");
            });
            </script>
            ';
        }

        $_SESSION['order_delivery'] = $_POST['order_delivery'];
        $_SESSION['order_fio'] = $_POST['order_fio'];
        $_SESSION['order_email'] = $_POST['order_email'];
        $_SESSION['order_phone'] = $_POST['order_phone'];
        $_SESSION['order_address'] = $_POST['order_address'];
        $_SESSION['order_note'] = $_POST['order_note'];
    }



    if (empty($error)) {
        header("Location: cart.php?action=completion");
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
        <?php
        $action = clearString($_GET["action"]);
        switch ($action) {



            case 'oneclick':

                echo '

        <div class="cart-progress-line container-fluid pt-1">
        <div class="card mb-3 wow fadeIn">
            <div class="row m-3 mt-4">
                
                <h5 class="font-weight-bold mr-4 ml-2 mt-2 text-success ">1. Корзина товаров</h5>
                
                <h5 class="mr-4 mt-2">—</h5>
                
                <h5 class="mr-4 mt-2">2. Контактная информация</h5>
                
                <h5 class="mr-4 mt-2">—</h5>
                
                <h5 class="mt-2">3. Подтверждение</h5>
                
                <a href="cart.php?action=clear" class="ml-auto">
                    <button type="button" class="btn btn-danger mt-0">
                        <i class="far fa-trash-alt mr-2"></i>
                        Очистить корзину
                    </button>
                </a>
            </div>
        </div>
        </div>


    <section id="cart_section">

        <!--Grid row-->
        <div class="row ml-auto mr-0">

            <!--Grid column-->
            <div class="col-lg-8">

                <!-- Card -->
        ';


                $result = mysqli_query($link, "SELECT * FROM cart,products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND products.products_id = cart.cart_id_products");

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);

                    do {

                        $int = $row["cart_price"] * $row["cart_count"];
                        $all_price = $all_price + $int;

                        $img_path = './images/' . $row["image"];
                        $max_width = 300;
                        $max_height = 300;
                        list($width, $height) = getimagesize($img_path);
                        $ratioh = $max_height / $height;
                        $ratiow = $max_width / $width;
                        $ratio = min($ratioh, $ratiow);

                        $width = intval($ratio * $width);
                        $height = intval($ratio * $ratiow);

                        echo '
                            <div class="card wish-list mb-3">
                            
                                <button type="button" class="close ml-auto mr-3 mt-3 mb-0" aria-label="Close">
                                <a href="cart.php?id=' . $row["cart_id"] . '&action=delete" class="text-danger">
                                    <span aria-hidden="true">X</span>
                                </a>
                                </button>
                            
                            <div class="card-body mt-0">

                            <div class="row mb-4">
                                <div class="col-md-5 col-lg-3 col-xl-3">
                                    <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                                        <img class="img-fluid w-100" src="' . $img_path . '" alt="Sample">
                                        <a href="view_content.php?id=' . $row["products_id"] . '">
                                            <div class="mask waves-effect waves-light">
                                                <img class="img-fluid w-100" src="' . $img_path . '">
                                            </div>
                                        </a>
                                    </div>
                                </div>
    
                                <div class="col-md-7 col-lg-9 col-xl-9">
                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <div class="mr-3">
                                            <a href="view_content.php?id=' . $row["products_id"] . '" class="text-dark">
                                                <h5>' . $row["title"] . '</h5>
                                            </a>
                                            </div>
                                            
                                        </div>
    
                                        <div class="d-flex justify-content-between align-items-center">
                                            
                                        <div class="mr-5 mt-3">
                                                <div class="def-number-input number-input safari_only mb-0 w-100">
                                                    <button iid="' . $row["cart_id"] . '" onclick="this.parentNode.querySelector(\'input[type=number]\').stepDown()" class="minus"></button>
                                                    <input id="plus-minus-input-id' . $row["cart_id"] . '" iid="' . $row["cart_id"] . '" class="quantity count-input" min="1" name="quantity" value="' . $row["cart_count"] . '" type="number">
                                                    <button iid="' . $row["cart_id"] . '" onclick="this.parentNode.querySelector(\'input[type=number]\').stepUp()" class="plus"></button>
                                                </div>
                                            </div>
                                            <p id="tovar' . $row["cart_id"] . '" class="mb-0 mr-5 mt-3 lead"><span class="font-weight-bold mr-2" price="' . $row["cart_price"] . '">' . $int . ' руб.</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
    
                        </div>
                        </div>
                        
                            ';
                    } while ($row = mysqli_fetch_array($result));

                    echo '
                    </div>


                <div class="pl-0 col-lg-4">
                <div class="card mb-3">
                    <div class="card-body">

                        <h4 class="font-weight-bold text-center">Итого</h4>

                        <ul class="list-group list-group-flush">';

                    $result2 = mysqli_query($link, "SELECT * FROM cart,products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND products.products_id = cart.cart_id_products");
                    $row2 = mysqli_fetch_array($result2);
                    do {


                        echo '
                            <div class="row d-flex justify-content-between ml-1">
                                    <li class="list-group-item d-flex justify-content-between align-items-left border-0 px-0 pb-0 w-50">
                                    ' . $row2["title"] . '
                                    </li>
                                    <span id="tovar2' . $row2["cart_id"] . '" class="pt-3"><span class="ml-5 mt-3 mr-3" price="' . $row2["cart_price"] . '">' . $row2["cart_price"] * $row2["cart_count"] . ' руб.</span></span>
                            </div>
                                
                                ';
                    } while ($row2 = mysqli_fetch_array($result2));


                    echo '
                            <li class="ml-1 list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                Доставка
                                <span>Бесплатно</span>
                            </li>
                            <hr class="w-100 m-1">
                            <li class="ml-1 list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <strong class="font-weight-bold">Итого:</strong>
                                <span class="itog_price"><strong>' . $all_price . ' руб.</strong></span>
                            </li>
                        </ul>

                        <a href="cart.php?action=confirm" class="mr-0">
                            <button type="button" class="btn btn-success btn-block waves-effect waves-light">Далее</button>
                        </a>

                    </div>
                </div>

                    ';
                } else {
                    echo '
                    <h3 class="m-5">Корзина пуста</h3>
                    ';
                }

                echo '
        </div>

        </div>

    </section>
        ';
                break;







                // 2 СТАДИЯ

            case 'confirm':
                echo '

        <div class="cart-progress-line container-fluid">
        <div class="card mb-3 wow fadeIn">
            <div class="row m-3 mt-4">
                <a href="cart.php?action=oneclick">
                    <h5 class="mr-4 ml-2 mt-2 mb-3 text-dark">1. Корзина товаров</h5>
                </a>
                <h5 class="mr-4 mt-2">—</h5>
                <h5 class="font-weight-bold mr-4 mt-2 text-success">2. Контактная информация</h5>
                <h5 class="mr-4 mt-2">—</h5>
                <h5 class=" mt-2">3. Подтверждение</h5>
            </div>
        </div>
        </div>';


                if ($_SESSION["order_delivery"] == "По почте") $chck1 = "checked";
                if ($_SESSION["order_delivery"] == "Курьером") $chck2 = "checked";
                if ($_SESSION["order_delivery"] == "Самовывоз") $chck3 = "checked";

                echo '

        <div class="container-fluid">
            <div class="card mb-3 wow fadeIn">
            <h4 id="mes-wrong-delivery" class="ml-4 mt-4 mb-0 text-danger" hidden>Вы не выбрали способ доставки!</h4>
                <h4 class="ml-4 mt-4  mb-2">Способы доставки:</h4>
                <div class="mt-2 ml-5">
                
                <form method="POST">
                    <div class="custom-control custom-radio">
                    <h5>
                    <input type="radio" class="custom-control-input" id="defaultGroupExample1" value="По почте" name="order_delivery" ' . $chck1 . '>
                    <label class="custom-control-label mb-3" for="defaultGroupExample1">По почте</label>
                    </h5>
                    </div>

                    <div class="custom-control custom-radio">
                    <h5>
                    <input type="radio" class="custom-control-input" id="defaultGroupExample2" value="Курьером" name="order_delivery" ' . $chck2 . '>
                    <label class="custom-control-label mb-3" for="defaultGroupExample2">Курьером</label>
                    </h5>
                    </div>

                    <div class="custom-control custom-radio">
                    <h5>
                    <input type="radio" class="custom-control-input" id="defaultGroupExample3" value="Самовывоз" name="order_delivery" ' . $chck3 . '>
                    <label class="custom-control-label mb-3" for="defaultGroupExample3">Самовывоз</label>
                    </h5>
                    </div>
                

                </div>
            </div>
        </div>
        
        
        
        <div class="container-fluid">
            <div class="card mb-3 wow fadeIn">
                <h4 class="ml-4 mt-4 mb-3">Информация для доставки:</h4>
                <div class="mt-2 ml-5">
                
                


                <div class="order_inputs">';

                if ($_SESSION['auth'] != 'yes_auth') {
                    echo '
            
                <input type="text" name="order_fio" id="order_fio" value="' . $_SESSION["order_fio"] . '" class="form-control mb-4" placeholder="ФИО">
                <small id="order_fioHelpBlock" class="form-text mb-3" hidden>
                    At least 8 characters and 1 digit
                </small>
                

                <input type="text" name="order_email" id="order_email" value="' . $_SESSION["order_email"] . '" class="form-control mb-4" placeholder="E-mail">
                <small id="order_emailHelpBlock" class="form-text mb-3" hidden>
                    At least 8 characters and 1 digit
                </small>

                <input type="text" name="order_phone" id="order_phone" value="' . $_SESSION["order_phone"] . '" class="form-control mb-4" aria-describedby="defaultRegisterFormPhoneHelpBlock" placeholder="Телефон">
                <small id="order_phoneHelpBlock" class="form-text mb-3" hidden>
                    At least 8 characters and 1 digit
                </small>

                <input type="text" name="order_address" id="order_address" value="' . $_SESSION["order_address"] . '" class="form-control mb-4" placeholder="Адрес доставки">
                <small id="order_addressHelpBlock" class="form-text mb-3" hidden>
                    At least 8 characters and 1 digit
                </small> 

            
            ';
                }
                echo '
            
            <div class="form-group">
                <textarea name="order_note" class="form-control" id="order_noteHelpBlock" rows="7" placeholder="Если необходимо, здесь вы можете уточнить информацию о заказе">' . $_SESSION["order_note"] . '</textarea>
                </div>
            <button type="submit" name="submitdata" class="btn btn-success btn-block waves-effect waves-light mb-4 mt-4">Далее</button>
            
                </div>
                </div>
            </div>
        </div>
        </form>
        ';
                break;









            case 'completion':
                echo '

        <div class="cart-progress-line container-fluid">
        <div class="card mb-3 wow fadeIn">
            <div class="row m-3 mt-4">
                
                <a href="cart.php?action=oneclick">
                    <h5 class="mr-4 ml-2 mt-2 mb-3 text-dark">1. Корзина товаров</h5>
                </a>
        
                <h5 class="mr-4 mt-2">—</h5>
                <a href="cart.php?action=confirm">
                    <h5 class="mr-4 mt-2 text-dark">2. Контактная информация</h5>
                </a>
                <h5 class="mr-4 mt-2">—</h5>
                <h5 class="font-weight-bold mt-2 text-success">3. Подтверждение</h5>
            </div>
        </div>
        </div>';

                if ($_SESSION['auth'] == 'yes_auth') {
                    $result = mysqli_query($link, "SELECT * FROM cart,products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND products.products_id = cart.cart_id_products");
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);

                        do {
                            $int = $int + ($row["cart_price"] * $row["cart_count"]);
                            $total_price_cart = $int;
                        } while ($row = mysqli_fetch_array($result));
                    }
                    echo '

            <div class="container-fluid">
            <div class="card mb-3 wow fadeIn">

                <ul class="list-group list-group-flush">
                    <li class="ml-4 mt-3 mb-2 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                    <h5><span class="font-weight-bold">Способ доставки: </span>' . $_SESSION['order_delivery'] . '</h5>
                    </li>
                    <li class="ml-4 mb-2 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                    <h5><span class="font-weight-bold">ФИО: </span>' . $_SESSION['auth_surname'] . ' ' . $_SESSION['auth_name'] . ' ' . $_SESSION['auth_patronymic'] . '</h5>
                    </li>
                    <li class="ml-4 mb-2 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                    <h5><span class="font-weight-bold">E-mail: </span>' . $_SESSION['auth_email'] . '</h5>
                    </li>
                    <li class="ml-4 mb-2 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                    <h5><span class="font-weight-bold">Телефон: </span>' . $_SESSION['auth_phone'] . '</h5>
                    </li>
                    <li class="ml-4 mb-2 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                    <h5><span class="font-weight-bold">Адрес доставки: </span>' . $_SESSION['auth_address'] . '</h5>
                    </li>';

                    if (strlen($_SESSION['order_note']) > 0) {
                        echo '

                    <li id="order_note_hide" class="ml-4 mb-2 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                    <h5><span class="font-weight-bold">Примечание: </span>' . $_SESSION['order_note'] . '</h5>
                    </li>';
                    }

                    echo '
                    <li class="ml-4 mb-3 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                        <h5><span class="font-weight-bold">Итого: </span>' . $total_price_cart . ' руб.</h5>
                    </li>
                </ul>
            
            </div>
        </div>';
                } else {

                    $result = mysqli_query($link, "SELECT * FROM cart,products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND products.products_id = cart.cart_id_products");
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);

                        do {
                            $int = $int + ($row["cart_price"] * $row["cart_count"]);
                            $total_price_cart = $int;
                        } while ($row = mysqli_fetch_array($result));
                    }
                    echo '

            <div class="container-fluid">
            <div class="card mb-3 wow fadeIn">

            
                <ul class="list-group list-group-flush">
                    <li class="ml-4 mt-3 mb-2 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                    <h5><span class="font-weight-bold">Способ доставки: </span>' . $_SESSION['order_delivery'] . '</h5>
                    </li>
                    <li class="ml-4 mb-2 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                    <h5><span class="font-weight-bold">ФИО: </span>' . $_SESSION['order_fio'] . '</h5>
                    </li>
                    <li class="ml-4 mb-2 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                    <h5><span class="font-weight-bold">E-mail: </span>' . $_SESSION['order_email'] . '</h5>
                    </li>
                    <li class="ml-4 mb-2 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                    <h5><span class="font-weight-bold">Телефон: </span>' . $_SESSION['order_phone'] . '</h5>
                    </li>
                    <li class="ml-4 mb-2 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                    <h5><span class="font-weight-bold">Адрес доставки: </span>' . $_SESSION['order_address'] . '</h5>
                    </li>';

                    if (strlen($_SESSION['order_note']) > 0) {
                        echo '

                    <li id="order_note_hide" class="ml-4 mb-2 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                    <h5><span class="font-weight-bold">Примечание: </span>' . $_SESSION['order_note'] . '</h5>
                    </li>';
                    }
                    echo '
                    <li class="ml-4 mb-3 list-group-item d-flex justify-content-left align-items-center border-0 px-0 pb-0">
                        <h5><span class="font-weight-bold">Итого: </span>' . $total_price_cart . ' руб.</h5>
                    </li>
                </ul>
            
            </div>
        </div>';
                }

                break;









            default:
                echo '

            <div class="cart-progress-line container-fluid pt-1">
        <div class="card mb-3 wow fadeIn">
            <div class="row m-3 mt-4">
                
                <h5 class="font-weight-bold mr-4 ml-2 mt-2 text-success ">1. Корзина товаров</h5>
                
                <h5 class="mr-4 mt-2">—</h5>
                
                <h5 class="mr-4 mt-2">2. Контактная информация</h5>
                
                <h5 class="mr-4 mt-2">—</h5>
                
                <h5 class="mt-2">3. Подтверждение</h5>
                
                <a href="cart.php?action=clear" class="ml-auto">
                    <button type="button" class="btn btn-danger mt-0">
                        <i class="far fa-trash-alt mr-2"></i>
                        Очистить корзину
                    </button>
                </a>
            </div>
        </div>
        </div>


    <section id="cart_section">

        <!--Grid row-->
        <div class="row ml-auto mr-0">

            <!--Grid column-->
            <div class="col-lg-8">

                <!-- Card -->
        ';


                $result = mysqli_query($link, "SELECT * FROM cart,products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND products.products_id = cart.cart_id_products");

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);

                    do {

                        $int = $row["cart_price"] * $row["cart_count"];
                        $all_price = $all_price + $int;

                        $img_path = './images/' . $row["image"];
                        $max_width = 300;
                        $max_height = 300;
                        list($width, $height) = getimagesize($img_path);
                        $ratioh = $max_height / $height;
                        $ratiow = $max_width / $width;
                        $ratio = min($ratioh, $ratiow);

                        $width = intval($ratio * $width);
                        $height = intval($ratio * $ratiow);

                        echo '
                            <div class="card wish-list mb-3">
                            
                                <button type="button" class="close ml-auto mr-3 mt-3 mb-0" aria-label="Close">
                                <a href="cart.php?id=' . $row["cart_id"] . '&action=delete" class="text-danger">
                                    <span aria-hidden="true">X</span>
                                </a>
                                </button>
                            
                            <div class="card-body mt-0">

                            <div class="row mb-4">
                                <div class="col-md-5 col-lg-3 col-xl-3">
                                    <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                                        <img class="img-fluid w-100" src="' . $img_path . '" alt="Sample">
                                        <a href="view_content.php?id=' . $row["products_id"] . '">
                                            <div class="mask waves-effect waves-light">
                                                <img class="img-fluid w-100" src="' . $img_path . '">
                                            </div>
                                        </a>
                                    </div>
                                </div>
    
                                <div class="col-md-7 col-lg-9 col-xl-9">
                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <div class="mr-3">
                                            <a href="view_content.php?id=' . $row["products_id"] . '" class="text-dark">
                                                <h5>' . $row["title"] . '</h5>
                                            </a>
                                            </div>
                                            
                                        </div>
    
                                        <div class="d-flex justify-content-between align-items-center">
                                            
                                        <div class="mr-5 mt-3">
                                                <div class="def-number-input number-input safari_only mb-0 w-100">
                                                    <button iid="' . $row["cart_id"] . '" onclick="this.parentNode.querySelector(\'input[type=number]\').stepDown()" class="minus"></button>
                                                    <input id="plus-minus-input-id' . $row["cart_id"] . '" iid="' . $row["cart_id"] . '" class="quantity count-input" min="1" name="quantity" value="' . $row["cart_count"] . '" type="number">
                                                    <button iid="' . $row["cart_id"] . '" onclick="this.parentNode.querySelector(\'input[type=number]\').stepUp()" class="plus"></button>
                                                </div>
                                            </div>
                                            <p id="tovar' . $row["cart_id"] . '" class="mb-0 mr-5 mt-3 lead"><span class="font-weight-bold mr-2" price="' . $row["cart_price"] . '">' . $int . ' руб.</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
    
                        </div>
                        </div>
                        
                            ';
                    } while ($row = mysqli_fetch_array($result));

                    echo '
                    </div>


                <div class="pl-0 col-lg-4">
                <div class="card mb-3">
                    <div class="card-body">

                        <h4 class="font-weight-bold text-center">Итого</h4>

                        <ul class="list-group list-group-flush">';

                    $result2 = mysqli_query($link, "SELECT * FROM cart,products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND products.products_id = cart.cart_id_products");
                    $row2 = mysqli_fetch_array($result2);
                    do {


                        echo '
                            <div class="row d-flex justify-content-between ml-1">
                                    <li class="list-group-item d-flex justify-content-between align-items-left border-0 px-0 pb-0 w-50">
                                    ' . $row2["title"] . '
                                    </li>
                                    <span id="tovar2' . $row2["cart_id"] . '" class="pt-3"><span class="ml-5 mt-3 mr-3" price="' . $row2["cart_price"] . '">' . $row2["cart_price"] * $row2["cart_count"] . ' руб.</span></span>
                            </div>
                                
                                ';
                    } while ($row2 = mysqli_fetch_array($result2));


                    echo '
                            <li class="ml-1 list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                                Доставка
                                <span>Бесплатно</span>
                            </li>
                            <hr class="w-100 m-1">
                            <li class="ml-1 list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <strong class="font-weight-bold">Итого:</strong>
                                <span class="itog_price"><strong>' . $all_price . ' руб.</strong></span>
                            </li>
                        </ul>

                        <a href="cart.php?action=confirm" class="mr-0">
                            <button type="button" class="btn btn-success btn-block waves-effect waves-light">Далее</button>
                        </a>

                    </div>
                </div>

                    ';
                } else {
                    echo '
                    <h3 class="m-5">Корзина пуста</h3>
                    ';
                }

                echo '
        </div>

        </div>

    </section>
            
        ';
                break;
        }
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