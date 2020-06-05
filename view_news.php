<?php

include("include/db_connect.php");
include("functions/functions.php");
session_start();
include("include/auth_cookie.php");

$id = $_GET["id"];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
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

                <?php
                setlocale(LC_ALL, "ru_RU.UTF-8");

                $result = mysqli_query($link, "SELECT * FROM news WHERE id='$id' ORDER BY id DESC");

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);

                    do {

                        echo '
          <div class="row justify-content-center ml-5 mb-3">
    
            <div class="col-lg-6 text-center text-md-center">
    
              
            <h1 class="h1-responsive text-center text-md-left product-name font-weight-bold text-uppercase mb-1 ml-xl-0 mt-5 mb-4"><i class="far fa-newspaper text-success"></i> ' . $row["title"] . '</h1>
              
    
              <div class="font-weight-bold mr-3 text-left">
    
                <p class="ml-xl-0 ml-4"><strong>' . $row["date"] . '</strong></p>

                <p class="ml-xl-0 ml-4"><a data-fancybox="gallery" href="images/' . $row["image"] . '"><img class="card-img-top" src="images/', $row["image"], '" alt="Card image cap"></a></p>

                <p class="ml-xl-0 ml-4"><strong>' . $row["text"] . '</strong></p>

              </div>
    
            </div>
          </div>
          <hr class="mb-0">
          
          ';
                    } while ($row = mysqli_fetch_array($result));
                }



                ?>


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
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</body>

</html>