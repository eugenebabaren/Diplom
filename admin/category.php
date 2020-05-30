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

if (isset($_POST["add_category_btn"])) {
    if (strlen($_POST["category"]) < 1) {
        $error[] = "Вы не ввели категорию!";

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            let mes12 = document.getElementById("categoryHelpBlock");
            let inp12 = document.getElementById("category");
            mes12.innerHTML = "Вы не ввели категорию!";
            mes12.style.color = "red";
            mes12.hidden = false;
            inp12.classList.remove("mb-4");
            inp12.classList.add("mb-2");
        });
        </script>
        ';
    } else {
        $result3 = mysqli_query($link, "SELECT category FROM category WHERE category = '{$_POST["category"]}'");
        if (mysqli_num_rows($result3) > 0) {
            $error[] = "Такая категория уже есть!";

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                let mes12 = document.getElementById("categoryHelpBlock");
                let inp12 = document.getElementById("category");
                mes12.innerHTML = "Такая категория уже есть!";
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

        mysqli_query($link, "INSERT INTO category(category) 
                            values('" . $_POST["category"] . "' )");
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
                        <label data-error="wrong" data-success="right" for="cat" class="">Категория</label>
                        <div class="row">

                            <select name="category" id="cat" class="form-control mt-2 mb-4 ml-3 w-50">
                                <?php

                                $category = mysqli_query($link, "SELECT * FROM category");
                                if (mysqli_num_rows($category) > 0) {
                                    $result_category = mysqli_fetch_array($category);

                                    do {

                                        echo '
                                        <option value="' . $result_category["id"] . '">' . $result_category["category"] . '</option>
                                        ';
                                    } while ($result_category = mysqli_fetch_array($category));
                                }

                                ?>

                            </select>
                            <a href="" class="delete-cat ml-4">
                                <button class="btn btn-danger">Удалить</button>
                            </a>
                        </div>

                        <div class="row mt-4">
                            <input type="text" name="category" id="category" class="form-control mt-2 ml-3 mb-4 w-50" placeholder="Категория">

                            <a href="" class="ml-4">
                                <button name="add_category_btn" type="submit" class="btn btn-success">Добавить</button>
                            </a>
                        </div>
                        <small id="categoryHelpBlock" class="form-text" hidden>
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