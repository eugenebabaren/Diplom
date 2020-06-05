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

$action = $_GET["action"];
if (isset($action)) {

  $id = (int) $_GET["id"];

  switch ($action) {

    case 'delete':

      $delete = mysqli_query($link, "DELETE FROM products WHERE products_id = '$id'");

      break;
  }
}

$cat = $_GET["cat"];
$type = $_GET["type"];

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

    <!-- FINDER -->
    <?php
    include("include/finder.php");
    ?>


    <!-- CARD -->
    <div class="ml-0 mr-2 mb-0">
      <div class="card-row row row-cols-1 row-cols-md-3 d-flex">
        <!-- ВЫБОРКА ТОВАРОВ ИЗ БД -->
        <?php

        if ($_GET["brand"]) {
          $check_brand = implode("','", $_GET["brand"]);
        }

        if (!empty($check_brand)) {
          $query_brand = "AND products.brand IN ('$check_brand')";
        }


        if ($_GET["type"]) {
          $check_type = implode("','", $_GET["type"]);
        }

        if (!empty($check_type)) {
          $query_type = "AND product_type IN ('$check_type')";
        }

        $result = mysqli_query($link, "SELECT * FROM products,brand WHERE brand.id = products.brand AND visible='1' $query_type $query_brand ORDER BY products_id DESC");

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_array($result);

          do {


            echo '
        <div class="col mb-4 pr-2">

        <div class="card">
        <div class="row mb-3 mt-2">
            <a href="edit_product.php?id=' . $row["products_id"] . '" class="ml-auto pb-0 mt-2">
              <button type="button" class="btn btn-block btn-success"><i class="fas fa-pen"></i></button>
            </a>

            <a rel="tovar.php?' . $url . 'id=' . $row["products_id"] . '&action=delete" class="delete mr-auto pt-0 mt-2">
              <button type="button" class="btn btn-block btn-danger"><i class="far fa-trash-alt"></i></button>
            </a>
        </div>
  
          <div class="view overlay">
            <img id="card-image" class="card-img-top" src="../images/', $row["image"], '" alt="Card image cap">
            <a href="view_content.php?id=' . $row["products_id"] . '">
              <div class="mask rgba-white-slight"></div>
            </a>
            <div class="dropdown-divider"></div>
          </div>
  
  
          <div class="card-body">
  
  
            <h4 class="card-title"><b>', $row["brand"], '</b></h4>';

            if ($row["availability"] == "1") {
              echo '
                
                  <p class="card-text text-success">
                    В наличии
                  </p>
                
                ';
            } else {
              echo '
                
                  <p class="card-text text-danger">
                    Временно нет
                  </p>
                
                ';
            }

            echo '
              <p class="card-text">
                <h6>', $row["title"], '</h6>
              </p>
              <h4 class="card-price">', $row["price"], ' руб.</h4>

              ';



            echo '
          </div>
  
        </div>
  
      </div>
      
      ';
          } while ($row = mysqli_fetch_array($result));
        } else {
          echo '
          
          <h3 class="m-5">Товаров с данными параметрами не найдено</h3>
          
          ';
        }

        ?>
      </div>
    </div>
    </div>
    </div>

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