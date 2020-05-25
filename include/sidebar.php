<div class="my-block-finder d-flex pt-1">
  <div class="height-sidebar cart-progress-line card mb-3 wow fadeIn pr-5">
    <div class="row ml-3 mt-4">

      <div class="treeview-animated pr-5">

        <h4 class="pt-2 pl-3 pr-5">Категории</h4>
        <hr>
        <ul class="treeview-animated-list mb-3">

          <li class="treeview-animated-items">
            <a class="closed">
              <h6>
                <i class="fas fa-angle-right"></i>
                <span><i class="ic-w mx-1"></i></i>Напитки</span>
              </h6>
            </a>
            <ul class="nested">
              <a class="cat-nested-btn" href="view_cat.php?type=Напитки">
                <button type="submit" class="cat-nested-btn btn btn-success btn-sm mt-2">
                  Все напитки
                </button>
              </a>

              <?php

              $result = mysqli_query($link, "SELECT * FROM products WHERE product_type='Напитки' GROUP BY brand");

              if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);

                do {


                  echo '
                  <a href="view_cat.php?cat=' . strtolower($row["brand"]) . '&type=' . $row["product_type"] . '">
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

          <li class="treeview-animated-items">
            <a class="closed">
              <h6>
                <i class="fas fa-angle-right"></i>
                <span><i class="ic-w mx-1"></i>Хлопья</span>
              </h6>
            </a>
            <ul class="nested">
              <a class="cat-nested-btn" href="view_cat.php?type=Хлопья">
                <button type="submit" class="cat-nested-btn btn btn-success btn-sm mt-2">
                  Все хлопья
                </button>
              </a>


              <?php

              $result = mysqli_query($link, "SELECT * FROM products WHERE product_type='Хлопья' GROUP BY brand");

              if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);

                do {


                  echo '
                  <a href="view_cat.php?cat=' . strtolower($row["brand"]) . '&type=' . $row["product_type"] . '">
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

          
        </ul>
      </div>
    </div>
  </div>