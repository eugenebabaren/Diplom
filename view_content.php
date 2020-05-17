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


  <!--Section: Content-->
  <section class="col text-center mt-2 pt-5">
    <div class="card wow fadeIn d-flex mt-5 mb-3">

      <?php
      $result = mysqli_query($link, "SELECT * FROM products WHERE products_id='$id' AND visible='1'");

      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        do {

          echo '
          <div class="row m-4">
            <div class="col-lg-6 mt-2">
              <img src="images/' . $row["image"] . '" alt="First slide" class="img-fluid">
            </div>
    
            <div class="col-lg-6 text-center text-md-left">
    
              <h1 class="h1-responsive text-left text-md-left product-name font-weight-bold mb-1 ml-xl-0 mt-5 mb-4">' . $row["title"] . '</h1>
    
              <div class="font-weight-bold mr-3 text-left">
    
                <p class="ml-xl-0 ml-4"><strong>' . $row["description"] . '</strong></p>

                <p class="ml-xl-0 ml-4"><span>Бренд</span><strong>..............................................................................................' . $row["brand"] . '</strong></p>

                <p class="ml-xl-0 ml-4">Страна производства<strong>.......................................................' . $row["country"] . '</strong></p>
    
                <p class="ml-xl-0 ml-4">Энергетическая ценность (ккал на 100 г)<strong>......' . $row["energy_value"] . '</strong></p>
                <p class="ml-xl-0 ml-4">Условия хранения<strong>...............................................................' . $row["storage_conditions"] . '</strong></p>
    
    
                <h2 class="h2-responsive text-left text-md-left product-name font-weight-bold mb-1 ml-xl-0 mt-4 pl-1">' . $row["price"] . ' руб.</h2>
    
                <a class="add-cart text-left" id="add-cart-view" tid="' . $row["products_id"] . '">
                  <button class="btn btn-success btn-rounded mt-4 mb-2">
                    <i class="fas fa-shopping-basket mr-2" aria-hidden="true"></i>
                    В корзину
                  </button>
                </a>

                <br>

                <a class="">
                  <button id="write_review_btn" class="btn btn-warning mb-5" data-toggle="modal" data-target="#modalReviewForm">
                    <i class="fas fa-pen mr-2" aria-hidden="true"></i>
                    Написать отзыв
                  </button>
                </a>
    
              </div>
    
            </div>
          </div>
          
          ';
        } while ($row = mysqli_fetch_array($result));
      }



      ?>



      <!-- отзывы -->
      <div class="font-weight-bold mr-3 text-left ml-5 mb-5">

        <h1 class="h1-responsive text-left text-md-left font-weight-bold mb-1 ml-xl-0 mb-4">Отзывы</h1>

        <?php


        $query_reviews = mysqli_query($link, "SELECT * FROM reviews WHERE products_id='$id' AND moderat='1' ORDER BY reviews_id DESC");

        if (mysqli_num_rows($query_reviews) > 0) {
          $row_reviews = mysqli_fetch_array($query_reviews);

          do {

            echo '
            <p class="ml-xl-0 ml-4"><span>' . $row_reviews["name"] . '</span><strong>, ' . $row_reviews["date"] . '</strong></p>

            <p class="ml-xl-0 ml-4"><i class="fas fa-plus text-success pr-2"></i><strong>' . $row_reviews["good_reviews"] . '</strong></p>
            <p class="ml-xl-0 ml-4"><i class="fas fa-minus text-danger pr-2"></i><strong>' . $row_reviews["bad_reviews"] . '</strong></p>

            <p class="ml-xl-0 ml-4"><strong>' . $row_reviews["comment"] . '</strong></p>

            <hr class="mr-4">
            ';
          } while ($row_reviews = mysqli_fetch_array($query_reviews));
        } else {
          echo '
          <h3 class="h3-responsive text-left text-md-left mb-1 ml-xl-0 mb-4">Отзывов к данному товару еще нет</h3>
          ';
        }

        ?>

        <form action="" method="post">
          <div class="modal fade" id="modalReviewForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title w-100 font-weight-bold ml-3">Отзыв будет опубликован после предварительной модерации</h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body mx-3">
                  <div class="md-form amber-textarea active-amber-textarea mt-4 mb-5">
                    <textarea class="md-textarea form-control" rows="1" id="review_modal_name" name="review_modal_name"></textarea>
                    <label for="review_modal_name">Имя</label>
                    <small id="nameHelpBlock" class="form-text" hidden>
                      Имя должно быть не меньше 1 символа кириллицей или латиницей!
                    </small>
                  </div>
                  <div class="md-form amber-textarea active-amber-textarea mt-4 mb-5">
                    <textarea class="md-textarea form-control" rows="3" id="review_modal_good" name="review_modal_good"></textarea>
                    <label for="review_modal_good">Достоинства</label>
                    <small id="goodHelpBlock" class="form-text" hidden>
                      Укажите достоинства!
                    </small>
                  </div>
                  <div class="md-form amber-textarea active-amber-textarea mt-4 mb-5">
                    <textarea class="md-textarea form-control" rows="3" id="review_modal_bad" name="review_modal_bad"></textarea>
                    <label for="review_modal_bad">Недостатки</label>
                    <small id="badHelpBlock" class="form-text" hidden>
                      Укажите недостатки!
                    </small>
                  </div>
                  <div class="md-form amber-textarea active-amber-textarea mt-4 mb-5">
                    <textarea class="md-textarea form-control" rows="3" id="review_modal_comment" name="review_modal_comment"></textarea>
                    <label for="review_modal_comment">Комментарий (если необходимо)</label>
                  </div>

                </div>

                <div class="modal-footer d-flex justify-content-center">
                  <button id="button-send-review" type="submit" name="submit_review" class="btn btn-warning" iid="<?php echo $id; ?>">Отправить</button>
                </div>

              </div>
            </div>
          </div>
        </form>

      </div>

      <?php
      include("include/add_reviews.php");
      ?>

    </div>
  </section>
  <!--Section: Content-->



  </div>
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