<div class="my-block-finder d-flex pt-1">
  <div class="height-sidebar cart-progress-line card mb-3 wow fadeIn pr-5">
    <div class="row ml-3 mt-4">

      <div class="treeview-animated pr-5">

        <h4 class="pt-2 pl-3 pr-5">Категории</h4>
        <hr>
        <ul class="treeview-animated-list mb-3">

          <?php

          $result = mysqli_query($link, "SELECT * FROM products,category WHERE category.id = products.product_type GROUP BY products.product_type");

          if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            do {


              echo '
                  <li class="treeview-animated-items">
            <a class="closed">
              <h6>
                <i class="fas fa-angle-right"></i>
                <span><i class="ic-w mx-1"></i></i>' . $row["category"] . '</span>
              </h6>
            </a>
            <ul class="nested">
              <a class="cat-nested-btn" href="view_cat.php?type=' . $row["id"] . '">
                <button type="submit" class="cat-nested-btn btn btn-success btn-sm mt-2">
                  Все ' . $row["category"] . '
                </button>
              </a>';



              $result1 = mysqli_query($link, "SELECT * FROM products,brand WHERE brand.id = products.brand AND products.product_type = '{$row["id"]}' GROUP BY products.brand");

              if (mysqli_num_rows($result1) > 0) {
                $row1 = mysqli_fetch_array($result1);

                do {


                  echo '
                  <a href="view_cat.php?cat=' . strtolower($row1["id"]) . '&type=' . $row1["product_type"] . '">
                    <li>
                      <div class="lower-element treeview-animated-element"><i class="ic-w mr-1"></i>' . $row1["brand"] . '
                    </li>
                  </a>
                  ';
                } while ($row1 = mysqli_fetch_array($result1));
              }

              echo '
            </ul>
          </li>
                  ';
            } while ($row = mysqli_fetch_array($result));
          }

          ?>
          

        </ul>
      </div>
    </div>
  </div>