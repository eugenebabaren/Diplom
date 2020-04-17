<?php

include("include/db_connect.php");
include("functions/functions.php");

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
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</head>

<body class="grey lighten-3">
  <header>


    <!-- NAVBAR -->

    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid">
        <a href="index.php" class="navbar-brand mr-4"><img src="images/logo (7).svg" width="120vw" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item mr-2">
              <a href="#" class="nav-link waves-effect">КАТАЛОГ</a>
            </li>
            <li class="nav-item mr-2">
              <a href="#" class="nav-link waves-effect">О НАС</a>
            </li>
            <li class="nav-item mr-2">
              <a href="#" class="nav-link waves-effect">ОПЛАТА И ДОСТАВКА</a>
            </li>
            <li class="nav-item mr-2">
              <a href="#" class="nav-link waves-effect">КОНТАКТЫ</a>
            </li>
            <li class="nav-item mr-2">
              <a href="#" class="nav-link waves-effect">НОВОСТИ</a>
            </li>
            <li class="nav-item mr-2">
              <a href="#" class="nav-link waves-effect">ВОПРОСЫ И ОТВЕТЫ</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link waves-effect">ОБРАТНАЯ СВЯЗЬ</a>
            </li>
          </ul>
          <ul>
            <ul class="navbar-nav nav-flex-icons mt-3">
              <li class="nav-item mr-1">
                <a href="#" class="nav-link border border-light rounded waves-effect">
                  <i class="fas fa-heart"></i>
                </a>
              </li>
              <li class="nav-item mr-1">
                <a href="#" class="nav-link border border-light rounded waves-effect">
                  <i class="fas fa-shopping-basket"></i>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link border border-light rounded waves-effect">
                  <b>ВХОД / РЕГИСТРАЦИЯ</b>
                </a>
              </li>
            </ul>
          </ul>
        </div>
      </div>
    </nav>



    <!-- SIDEBAR -->

    <div class="sidebar-fixed position-fixed pl-2">

      <div class="treeview-animated ml-2">

        <h4 class="pt-2 pl-3">Категории</h4>

        <hr>

        <ul class="treeview-animated-list mb-2">

          <li class="treeview-animated-items">
            <a class="closed">
              <h6>
                <i class="fas fa-angle-right"></i>
                <span><i class="ic-w mx-1"></i></i>Напитки</span>
              </h6>
            </a>
            <ul class="nested">
              <a class="cat-nested-btn" href="view_cat.php?type=drinks">
                <button type="submit" class="cat-nested-btn btn btn-success btn-sm mt-2">
                  Все напитки
                </button>
              </a>

              <?php

              $result = mysqli_query($link, "SELECT * FROM category WHERE type='drinks'");

              if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);

                do {


                  echo '
                  <a href="view_cat.php?cat=' . strtolower($row["brand"]) . '&type=' . $row["type"] . '">
                    <li>
                      <div class="lower-element treeview-animated-element"><i class="ic-w mr-1"></i>' . $row["brand"] . '</div>
                    </li>
                  </a>
                  ';
                } while ($row = mysqli_fetch_array($result));
              }

              ?>
            </ul>
          </li>
          <li class="treeview-animated-items">
            <a class="closed">
              <h6>
                <i class="fas fa-angle-right"></i>
                <span><i class="ic-w mx-1"></i>Хлопья</span>
              </h6>
            </a>
            <ul class="nested">
              <a class="cat-nested-btn" href="view_cat.php?type=cereals">
                <button type="submit" class="cat-nested-btn btn btn-success btn-sm mt-2">
                  Все хлопья
                </button>
              </a>

              <?php

              $result = mysqli_query($link, "SELECT * FROM category WHERE type='cereals'");

              if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);

                do {


                  echo '
                  <a href="view_cat.php?cat=' . strtolower($row["brand"]) . '&type=' . $row["type"] . '">
                  <li>
                  <div class="lower-element treeview-animated-element"><i class="ic-w mr-1"></i>' . $row["brand"] . '
                  </li>
                  </a>
                  ';
                } while ($row = mysqli_fetch_array($result));
              }

              ?>
            </ul>
          </li>

          <a id="btn_all_cat" href="index.php">
            <button type="button" class="btn btn-success mt-2">
              Все категории
            </button>
          </a>
        </ul>
      </div>
    </div>

  </header>




  <div class="finder">
    <div class="container-fluid mt-5">
      <div class="card mb-3 wow fadeIn">
        <div class="card-body d-sm-flex ">

          <!-- FILTRATION -->
          <button id="btn_filtration" class="btn btn-success dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Фильтрация</button>

          <div class="dropdown-menu">
            <div class="container-fluid d-sm-flex ml-0">

              <ul class="dropdown-ul pl-0 mb-0">
                <h4 class="ml-4 mt-2">Бренд</h4>

                <?php

                $result = mysqli_query($link, "SELECT * FROM category WHERE type='drinks'");

                if (mysqli_num_rows($result) > 0) {
                  $row = mysqli_fetch_array($result);

                  do {


                    echo '
                  <li>
                    <a class="dropdown-item">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="brand[]" value="' . $row["id"] . '" class="custom-control-input" id="checkbox' . $row["id"] . '">
                        <label class="custom-control-label" for="checkbox' . $row["id"] . '">' . $row["brand"] . '</label>
                      </div>
                    </a>
                  </li>
                  ';
                  } while ($row = mysqli_fetch_array($result));
                }

                ?>

              </ul>

              <ul class="dropdown-ul pl-4 mb-0">
                <h4 class="ml-4 mt-2">Страна</h4>
                <?php

                $result = mysqli_query($link, "SELECT * FROM products");

                if (mysqli_num_rows($result) > 0) {
                  $row = mysqli_fetch_array($result);

                  $checkbox_id = 999999;
                  do {
                    
                    echo '
                  <li>
                    <a class="dropdown-item">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="brand[]" value="' . ++$checkbox_id . '" class="custom-control-input" id="checkbox' . $checkbox_id . '">
                        <label class="custom-control-label" for="checkbox' .  $checkbox_id . '">' . $row["country"] . '</label>
                      </div>
                    </a>
                  </li>
                  ';
                  } while ($row = mysqli_fetch_array($result));
                }

                ?>
              </ul>
            </div>

            <div class="dropdown-divider"></div>

            <a href="index.php">
              <a href="index.php" class="dropdown-item" id="without-filt">Без фильтрации</a>
            </a>
          </div>
          <!-- FILTRATION -->


          <!-- SORTING -->
          <div>
            <button class="btn btn-success dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Сортировка</button>

            <?php
            echo '
              <div class="dropdown-menu">
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=price-asc" class="dropdown-item">Сначала дешевле</a>
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=price-desc" class="dropdown-item">Сначала дороже</a>
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=popular" class="dropdown-item">Популярные</a>
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=new" class="dropdown-item">По новизне</a>
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=from-a-to-z" class="dropdown-item">От А до Я</a>
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=from-z-to-a" class="dropdown-item">От Я до А</a>
                <div class="dropdown-divider"></div>
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=without-sorting" class="dropdown-item" href="#">Без сортировки</a>
              </div>
              ';
            ?>


          </div>
          <!-- SORTING -->


          <!-- SEARCH -->
          <form method="GET" action="search.php?q=" class="form-inline d-flex ml-auto">
            <input type="search" class="form-control  " placeholder="Поиск">
            <button class="btn-success ml-1 mr-0 btn-sm my-0" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </form>
          <!-- SEARCH -->
        </div>
      </div>
    </div>
  </div>






  <!-- CARD -->

  <div class="row row-cols-1 row-cols-md-4">
    <!-- ВЫБОРКА ТОВАРОВ ИЗ БД -->
    <?php

    if (!empty($cat) && !empty($type)) {

      $querycat = "AND brand='$cat' AND product_type='$type'";
    } else {
      if (!empty($type)) {
        $querycat = "AND product_type='$type'";
      } else {
        $querycat = "";
      }
    }


    $result = mysqli_query($link, "SELECT * FROM products WHERE visible='1' $querycat ORDER BY $sorting");

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

          <button type="button" class="btn btn-success btn-md ml-0">В корзину</button>
          <button type="button" class="btn btn-danger btn-md mr-0"><i class="fas fa-heart"></i></button>
        </div>

      </div>

    </div>
      
      ';
      } while ($row = mysqli_fetch_array($result));
    }


    ?>
  </div>





  <!-- jQuery -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript" src="js/script.js"></script>

</body>

</html>