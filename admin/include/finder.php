<div class="finder ml-3 mr-2 mb-0 justify-content-between">
  <!-- <div class="container-fluid d-flex"> -->
  <div class="card mb-3 wow fadeIn">
    <div class="card-body d-sm-flex">

      <?php

      $all_count = mysqli_query($link, "SELECT * FROM products");
      $all_count_result = mysqli_num_rows($all_count);

      ?>
      <h4 class="mt-3 mr-4">Всего товаров - <span class="font-weight-bold"><?php echo $all_count_result ?></span></h4>


      <button class="btn btn-success mb-2 ml-0" data-toggle="modal" data-target="#modalFiltForm">
        <i class="fas fa-filter"></i>
      </button>

      <form action="search_filter.php" method="GET">
        <div class="modal fade" id="modalFiltForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 font-weight-bold ml-3">Фильтрация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="container-fluid d-flex ml-0 mr-0 pr-0 pl-2 pt-3 pb-3">

                <ul class="dropdown-ul pl-0 ml-0 mb-0 mr-0 pr-0 lead">
                  <h3 class="ml-4 mt-2 pb-2 font-weight-bold">Бренд</h3>

                  <?php

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
                        <input ' . $checked_brand . ' type="checkbox" name="brand[]" value="' . $row["id"] . '" class="custom-control-input" id="checkbox' . ++$checkbox_id_brand. '">
                        <label class="custom-control-label" for="checkbox' . $checkbox_id_brand . '">' . wordwrap($row["brand"], 18, "<br>") . '</label>
                      </div>
                    </a>
                  </li>
                  ';
                    } while ($row = mysqli_fetch_array($result));
                  }

                  ?>

                </ul>

                <ul class="dropdown-ul pl-0 ml-0 mb-0 mr-0 pr-0 lead">
                  <h3 class="ml-4 mt-2 pb-2 font-weight-bold">Категория</h3>
                  <?php

                  $result = mysqli_query($link, "SELECT * FROM category");

                  if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);

                    $checkbox_id = 999999;
                    do {

                      $checked_type = "";

                      if ($_GET["type"]) {
                        if (in_array($row["id"], $_GET["type"])) {
                          $checked_type = "checked";
                        }
                      }

                      echo '
                  <li>
                    <a class="dropdown-item">
                      <div class="custom-control custom-checkbox">
                        <input ' . $checked_type . ' type="checkbox" name="type[]" value="' . $row["id"] . '" class="custom-control-input" id="checkbox' . ++$checkbox_id . '">
                        <label class="custom-control-label" for="checkbox' .  $checkbox_id . '">' . wordwrap($row["category"], 18, "<br>") . '</label>
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

                <a href="tovar.php">
                  <button type="button" class="btn btn-danger">Очистить</button>
                </a>
              </div>

            </div>
          </div>
        </div>
      </form>


      <a href="add_product.php" class="ml-auto">
        <button type="submit" class="btn btn-success">
          <i class="fas fa-plus mr-2"></i>Добавить товар
        </button>
      </a>
    </div>
  </div>