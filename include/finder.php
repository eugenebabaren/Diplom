<div id="topSection" class="finder">
  <div class="container-fluid mt-5">
    <div class="card mb-3 wow fadeIn">
      <div class="card-body d-sm-flex ">

        <!-- FILTRATION -->
        <button id="btn_filtration" class="btn btn-success dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Фильтрация</button>

        <form action="search_filter.php" method="GET">
          <div class="dropdown-menu">
            <div class="container-fluid d-sm-flex ml-0">

              <ul class="dropdown-ul pl-0 ml-0 mb-0">
                <h4 class="ml-4 mt-2">Бренд</h4>

                <?php


                $result = mysqli_query($link, "SELECT * FROM category WHERE type='drinks'");

                if (mysqli_num_rows($result) > 0) {
                  $row = mysqli_fetch_array($result);

                  do {

                    $checked_brand = "";

                    if ($_GET["brand"]) {
                      if (in_array($row["id"], $_GET["brand"])) {
                        $checked_brand = "checked";
                      }
                    }

                    echo '
                  <li>
                    <a class="dropdown-item">
                      <div class="custom-control custom-checkbox">
                        <input ' . $checked_brand . ' type="checkbox" name="brand[]" value="' . $row["id"] . '" class="custom-control-input" id="checkbox' . $row["id"] . '">
                        <label class="custom-control-label" for="checkbox' . $row["id"] . '">' . $row["brand"] . '</label>
                      </div>
                    </a>
                  </li>
                  ';
                  } while ($row = mysqli_fetch_array($result));
                }

                ?>

              </ul>

              <ul class="dropdown-ul pl-0 mb-0">
                <h4 class="ml-4 mt-2">Страна</h4>
                <?php

                $result = mysqli_query($link, "SELECT * FROM products GROUP BY country");

                if (mysqli_num_rows($result) > 0) {
                  $row = mysqli_fetch_array($result);

                  $checkbox_id = 999999;
                  do {

                    $checked_country = "";

                    if ($_GET["country"]) {
                      if (in_array($row["country"], $_GET["country"])) {
                        $checked_country = "checked";
                      }
                    }

                    echo '
                  <li>
                    <a class="dropdown-item">
                      <div class="custom-control custom-checkbox">
                        <input ' . $checked_country . ' type="checkbox" name="country[]" value="' . $row["country"] . '" class="custom-control-input" id="checkbox' . ++$checkbox_id . '">
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

            <button type="submit" class="dropdown-item btn-success without-filt">Применить</button>
            <div class="dropdown-divider"></div>

            <a href="index.php">
              <button type="button" class="dropdown-item btn-danger without-filt">Очистить</button>
            </a>

          </div>
        </form>
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
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=without-sorting" class="dropdown-item btn-danger">Без сортировки</a>
              </div>
              ';
          ?>

        </div>
        <!-- SORTING -->


        <!-- SEARCH -->
        <form method="GET" action="search.php?q=" class="form-inline d-flex ml-auto">
          <input type="search" name="q" class="form-control" placeholder="Поиск" value="<?php echo $search; ?>">
          <button class="btn-success ml-1 mr-0 btn-sm my-0" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </form>
        <!-- SEARCH -->
      </div>
    </div>
  </div>
</div>