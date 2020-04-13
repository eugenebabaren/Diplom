<?php

include("include/db_connect.php");

include("include/sorting.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Интернет-магазин здорового питания</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
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

    <div class="sidebar-fixed position-fixed pl-auto">

      <div class="list-group list-group-flush">

        <?php

        $result = mysqli_query($link, "SELECT * FROM category WHERE type='drinks'");

        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_array($result);

          do {


            echo '
              <a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'>" class="list-group-item waves-effect">
                <i class="fas fa-plus mr-3"></i>Напитки
              </a>
          ';
          } while ($row = mysqli_fetch_array($result));
        }

        ?>
        <!-- <a href="#" class="list-group-item waves-effect">
          <i class="fas fa-plus mr-3"></i>Хлебцы из полбы
        </a>
        <a href="#" class="list-group-item waves-effect">
          <i class="fas fa-plus mr-3"></i>Хлебцы из полбы
        </a>
        <a href="#" class="list-group-item waves-effect">
          <i class="fas fa-plus mr-3"></i>Хлебцы из полбы
        </a>
        <a href="#" class="list-group-item waves-effect  active">
          <i class="fas fa-plus mr-3"></i>Хлебцы из полбы
        </a>
        <a href="#" class="list-group-item waves-effect">
          <i class="fas fa-plus mr-3"></i>Хлебцы из полбы
        </a>
        <a href="#" class="list-group-item waves-effect">
          <i class="fas fa-plus mr-3"></i>Хлебцы из полбы
        </a> -->
      </div>
    </div>

  </header>




  <!-- <main class="mt-2 pt-5 max-lg-5"> -->
  <div class="finder">
    <div class="container-fluid mt-5">
      <div class="card mb-3 wow fadeIn">
        <div class="card-body d-sm-flex ">

          <!-- FILTRATION -->
          <button id="btn_filtration" class="btn btn-primary dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Фильтрация</button>
          <div class="dropdown-menu">
            <a class="dropdown-item">
              <!-- Default unchecked -->
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkbox1">
                <label class="custom-control-label" for="checkbox1">Granarolo</label>
              </div>
            </a>
            <a class="dropdown-item" href="#">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkbox2" checked>
                <label class="custom-control-label" for="checkbox2">Alpro</label>
              </div>
            </a>
            <a class="dropdown-item" href="#">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkbox3">
                <label class="custom-control-label" for="checkbox3">sdsdf</label>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="checkbox4" checked>
                <label class="custom-control-label" for="checkbox4">Без фильтрации</label>
              </div>
            </a>
          </div>
          <!-- FILTRATION -->


          <!-- SORTING -->
          <div>
            <button class="btn btn-primary dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Сортировка</button>
            <div class="dropdown-menu">
              <a href="index.php?sort=price-asc" class="dropdown-item" href="#">Сначала дешевле</a>
              <a href="index.php?sort=price-desc" class="dropdown-item" href="#">Сначала дороже</a>
              <a href="index.php?sort=popular" class="dropdown-item" href="#">Популярные</a>
              <a href="index.php?sort=new" class="dropdown-item" href="#">По новизне</a>
              <a href="index.php?sort=from-a-to-z" class="dropdown-item" href="#">От А до Я</a>
              <a href="index.php?sort=from-z-to-a" class="dropdown-item" href="#">От Я до А</a>
              <div class="dropdown-divider"></div>
              <a href="index.php?sort=without-sorting" class="dropdown-item" href="#">Без сортировки</a>
            </div>
          </div>
          <!-- SORTING -->


          <!-- SEARCH -->
          <form method="GET" action="search.php?q=" class="form-inline d-flex ml-auto">
            <input type="search" class="form-control  " placeholder="Поиск">
            <button class="btn-primary ml-1 mr-0 btn-sm my-0" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </form>
          <!-- SEARCH -->
        </div>
      </div>
    </div>
  </div>


  <!-- </main> -->




  <!-- CARD -->

  <div class="row row-cols-1 row-cols-md-3">
    <!-- ВЫБОРКА ТОВАРОВ ИЗ БД -->
    <?php

    $result = mysqli_query($link, "SELECT * FROM products WHERE visible='1' ORDER BY $sorting");

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

          <button type="button" class="btn btn-light-blue btn-md ml-0">В корзину</button>
          <button type="button" class="btn btn-light-blue btn-md ml-0"><i class="fas fa-heart"></i></button>
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