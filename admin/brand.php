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

if (isset($_POST["add_brand_btn"])) {
    if (strlen($_POST["brand"]) < 1) {
        $error[] = "Вы не ввели бренд!";

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            let mes12 = document.getElementById("brandHelpBlock");
            let inp12 = document.getElementById("brand");
            mes12.innerHTML = "Вы не ввели бренд!";
            mes12.style.color = "red";
            mes12.hidden = false;
            inp12.classList.remove("mb-4");
            inp12.classList.add("mb-2");
        });
        </script>
        ';
    } else {
        $result3 = mysqli_query($link, "SELECT brand FROM brand WHERE brand = '{$_POST["brand"]}'");
        if (mysqli_num_rows($result3) > 0) {
            $error[] = "Такой бренд уже есть!";

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                let mes12 = document.getElementById("brandHelpBlock");
                let inp12 = document.getElementById("brand");
                mes12.innerHTML = "Такой бренд уже есть!";
                mes12.style.color = "red";
                mes12.hidden = false;
                inp12.classList.remove("mb-4");
                inp12.classList.add("mb-2");
            });
            </script>
            ';
        }
    }

    //ДОБАВЛЕНИЕ
    if (empty($error)) {

        mysqli_query($link, "INSERT INTO brand(brand) 
                            values('" . $_POST["brand"] . "' )");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
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
        include("include/sidebar.php");
        ?>

        <div class="finder ml-3 mr-2 mb-0 justify-content-between">
            <!-- <div class="container-fluid d-flex"> -->



            <section class="col mb-3 p-0">
                <div class="card wow fadeIn d-flex m-0 p-4">

                    <form action="" method="post">
                        <label data-error="wrong" data-success="right" for="bra" class="">Бренд</label>
                        <div class="row">

                            <select name="brand" id="bra" class="form-control mt-2 mb-4 ml-3 w-50">
                                <?php

                                $brand = mysqli_query($link, "SELECT * FROM brand");
                                if (mysqli_num_rows($brand) > 0) {
                                    $result_brand = mysqli_fetch_array($brand);

                                    do {

                                        echo '
                                        <option value="' . $result_brand["id"] . '">' . $result_brand["brand"] . '</option>
                                        ';
                                    } while ($result_brand = mysqli_fetch_array($brand));
                                }

                                ?>

                            </select>
                            <a href="" class="delete-bra ml-4">
                                <button class="btn btn-danger">Удалить</button>
                            </a>
                        </div>

                        <div class="row mt-4">
                            <input type="text" name="brand" id="brand" class="form-control mt-2 ml-3 mb-4 w-50" placeholder="Бренд">

                            <a href="" class="ml-4">
                                <button name="add_brand_btn" type="submit" class="btn btn-success">Добавить</button>
                            </a>
                        </div>
                        <small id="brandHelpBlock" class="form-text" hidden>
                            At least 8 characters and 1 digit
                        </small>
                    </form>

                </div>
            </section>



    </main>


    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
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