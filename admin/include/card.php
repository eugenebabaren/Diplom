<div class="ml-0 mr-2 mb-0">
  <div class="row row-cols-1 row-cols-md-3 d-flex">
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



    $result = mysqli_query($link, "SELECT * FROM products ORDER BY products_id DESC");

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);

      do {


        echo '
      <div class="col mb-4 pr-2">

      <div class="card">

        <div class="view overlay">
          <img id="card-image" class="card-img-top" src="../images/', $row["image"], '" alt="Card image cap">
          <a href="view_content.php?id=' . $row["products_id"] . '">
            <div class="mask rgba-white-slight"></div>
          </a>
          <div class="dropdown-divider"></div>
        </div>


        <div class="card-body">


          <h4 class="card-title"><b>', $row["brand"], '</b></h4>';

        if ($row["availability"] == "1") {
          echo '
            
              <p class="card-text text-success">
                В наличии
              </p>
            
            ';
        } else {
          echo '
            
              <p class="card-text text-danger">
                Временно нет
              </p>
            
            ';
        }

        echo '
          <p class="card-text">
            <h6>', $row["title"], '</h6>
          </p>
          <h4 class="card-price">', $row["price"], ' руб.</h4>

          <div class="modal-footer border-0 d-flex justify-content-between pl-0 pr-0">
            <a href="edit_product.php?id=' . $row["products_id"] . '" class="btn-block ml-auto mr-auto pb-0 mb-0">
              <button type="button" class="btn btn-block btn-success">Изменить</button>
            </a>

            <a rel="tovar.php?' . $url . 'id=' . $row["products_id"] . '&action=delete" class="delete btn-block ml-auto mr-auto pt-0 mt-2">
              <button type="button" class="btn btn-block btn-danger">Удалить</button>
            </a>
          </div>

        </div>

      </div>

    </div>
      
      ';
      } while ($row = mysqli_fetch_array($result));
    } else {
      echo '

    <h4 class="m-5">ПО ВАШЕМУ ЗАПРОСУ НИЧЕГО НЕ НАЙДЕНО</h4>

    ';
    }

    ?>

  </div>
</div>

</div>
</div>