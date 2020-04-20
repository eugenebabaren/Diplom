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