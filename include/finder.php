<div class="finder ml-3 mr-2 mb-0 justify-content-between">
  <div class="card mb-3 wow fadeIn">
    <div class="row card-body d-sm-flex mr-0">

      <button class="filt-btn btn btn-success mb-2 ml-2" data-toggle="modal" data-target="#modalFiltForm">
        <i class="fas fa-filter mr-2"></i>Фильтрация
      </button>

      <form action="search_filter.php" method="GET">
        <div class="modal fade" id="modalFiltForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold">Фильтрация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="container-fluid d-flex ml-0 mr-0 pr-0 pl-2 pt-3 pb-3">

                <ul class="col-6 dropdown-ul pl-0 ml-0 mb-0 mr-0 pr-0 lead">
                  <h3 class="ml-4 mt-2 pb-2 font-weight-bold">Бренд</h3>

                  <?php

                  $type = $_GET["type"];

                  $result = mysqli_query($link, "SELECT * FROM brand");



                  if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);

                    $checkbox_id_brand = 0;

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
                        <input ' . $checked_brand . ' type="checkbox" name="brand[]" value="' . $row["id"] . '" class="custom-control-input" id="checkbox' . ++$checkbox_id_brand . '">
                        <label class="custom-control-label" for="checkbox' . $checkbox_id_brand . '">' . wordwrap($row["brand"], 18, "<br>") . '</label>
                      </div>
                    </a>
                  </li>
                  ';
                    } while ($row = mysqli_fetch_array($result));
                  }

                  ?>

                </ul>

                <ul class="col-6 dropdown-ul pl-0 ml-0 mb-0 mr-0 pr-0 lead">
                  <h3 class="ml-4 mt-2 pb-2 font-weight-bold">Страна</h3>
                  <?php

                  $result = mysqli_query($link, "SELECT * FROM products WHERE visible='1' GROUP BY country");

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


              <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Применить</button>

                <a href="index.php">
                  <button type="button" class="btn btn-danger">Очистить</button>
                </a>
              </div>

            </div>
          </div>
        </div>
      </form>



      <!-- SORTING -->

      <button class="sort-btn btn btn-success dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-sort mr-2"></i>Сортировка
      </button>

      <?php
      echo '
              <div class="dropdown-menu">
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=price-asc" class="dropdown-item">Сначала дешевле</a>
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=price-desc" class="dropdown-item">Сначала дороже</a>
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=availability" class="dropdown-item">По наличию</a>
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=new" class="dropdown-item">По новизне</a>
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=from-a-to-z" class="dropdown-item">От А до Я</a>
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=from-z-to-a" class="dropdown-item">От Я до А</a>
                <div class="dropdown-divider"></div>
                <a href="view_cat.php?cat=' . $cat . '&type=' . $type . '&sort=without-sorting" class="dropdown-item btn-danger">Без сортировки</a>
              </div>
              ';
      ?>


      <!-- SORTING -->


      <!-- SEARCH -->
      <form method="GET" action="search.php?q=" class="search-css form-inline mr-0">
          <input type="search" name="q" class="col-9 form-control" placeholder="Поиск" value="<?php echo $search; ?>">
          <button class="col-2 btn-success ml-1 mr-0 btn-sm my-0" type="submit">
            <i class="fas fa-search"></i>
          </button>
      </form>
      <!-- SEARCH -->
      <!-- </div> -->
    </div>
  </div>