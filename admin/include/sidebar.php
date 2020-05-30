<div class="d-flex pt-1">
  <div class="height-sidebar cart-progress-line card mb-3 wow fadeIn pr-5 d-flex">
    <div class="row ml-4 mt-3 mb-3">

      <ul class="list-group list-group-flush lead mr-1 pr-5">
        <a href="tovar.php" class="text-dark list-group-item list-group-item-action">
          <span class="mr-2">Товары</span>
        </a>
        <a href="orders.php" class="text-dark list-group-item list-group-item-action d-flex justify-content-between align-items-center">
          <span class="mr-2">Заказы</span>
          <?php
          $no_buy_count = mysqli_query($link, "SELECT * FROM orders WHERE order_confirmed='no'");
          $no_buy_count_result = mysqli_num_rows($no_buy_count);

          if ($no_buy_count_result > 0) {
            echo '
              <span class="badge badge-danger badge-pill pb-1">+' . $no_buy_count_result . '</span>
            ';
          }
          ?>
        </a>

        <a href="reviews.php" class="text-dark list-group-item list-group-item-action d-flex justify-content-between align-items-center">
          <span class="mr-2">Отзывы</span>
          <?php
          $plus_reviews = mysqli_query($link, "SELECT * FROM reviews WHERE moderat='0'");
          $plus_reviews_result = mysqli_num_rows($plus_reviews);

          if ($plus_reviews_result > 0) {
            echo '
              <span class="badge badge-danger badge-pill pb-1">+' . $plus_reviews_result . '</span>
            ';
          }
          ?>
        </a>
        <a href="clients.php" class="text-dark list-group-item list-group-item-action">
          <span class="mr-2">Клиенты</span>
        </a>
        <a href="news.php" class="text-dark list-group-item list-group-item-action">
          <span class="mr-2">Новости</span>
        </a>
        <a href="category.php" class="text-dark list-group-item list-group-item-action">
          <span class="mr-2">Категории</span>
        </a>
        <a href="brand.php" class="text-dark list-group-item list-group-item-action">
          <span class="mr-2">Бренды</span>
        </a>
      </ul>

    </div>
  </div>