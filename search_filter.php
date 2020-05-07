<?php

include("include/db_connect.php");
include("functions/functions.php");
session_start();
include("include/auth_cookie.php");

$cat = clearString($_GET["cat"]);
$type = clearString($_GET["type"]);

include("include/sorting.php");

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


    <!-- SIDEBAR -->
    <?php
    include("include/sidebar_cat.php");
    ?>

  </header>


  <!-- FINDER -->
  <?php
  include("include/finder.php");
  ?>


  <!-- CARD -->
  <div class="row row-cols-1 row-cols-md-3">
    <!-- ВЫБОРКА ТОВАРОВ ИЗ БД -->
    <?php

    if($_GET["brand"]) {
        $check_brand = implode(",", $_GET["brand"]);
    }

    if(!empty($check_brand)) {
        $query_brand = "AND brand_id IN ($check_brand)";
    }


    if($_GET["country"]) {
        $check_country = implode("','", $_GET["country"]);
    }

    if(!empty($check_country)) {
        $query_country = "AND country IN ('$check_country')";
    }

    $result = mysqli_query($link, "SELECT * FROM products WHERE visible='1' $query_country $query_brand ORDER BY products_id DESC");

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);

      do {


        echo '
      <div class="col mb-4">

      <div class="card">

        <div class="view overlay">
          <img id="card-image" class="card-img-top" src="images/', $row["image"], '" alt="Card image cap">
          <a href="#">
            <div class="mask rgba-white-slight"></div>
          </a>
          <div class="dropdown-divider"></div>
        </div>


        <div class="card-body">


          <h4 class="card-title"><b>', $row["brand"], '</b></h4>

          <p class="card-text">
            <h6>', $row["title"], '</h6>
          </p>
          <h4 class="card-price">', $row["price"], ' руб.</h4>

          <button type="button" class="btn btn-success btn-md ml-0"><i class="fas fa-shopping-basket ml-0 mr-2"></i>В корзину</button>
          <button type="button" class="btn btn-danger btn-md mr-0"><i class="fas fa-heart"></i></button>
        </div>

      </div>

    </div>
      
      ';
      } while ($row = mysqli_fetch_array($result));
    }

    ?>
  </div>

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