<div class="ml-0 mr-2 mb-0">
  <div class="row row-cols-1 row-cols-md-3 d-flex">
    <!-- ВЫБОРКА ТОВАРОВ ИЗ БД -->
    <?php

    if (!empty($cat) && !empty($type)) {

      $querycat = "AND products.brand='$cat' AND product_type='$type'";
    } else {
      if (!empty($type)) {
        $querycat = "AND product_type='$type'";
      } else {
        $querycat = "";
      }
    }



    $result = mysqli_query($link, "SELECT * FROM products,brand WHERE brand.id = products.brand ORDER BY products_id DESC");

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);

      do {


        echo '
      <div class="col mb-4">

      <div class="card">
        <div class="row mb-3 mt-2">
            <a href="edit_product.php?id=' . $row["products_id"] . '" class="ml-auto pb-0 mt-2">
              <button type="button" class="btn btn-block btn-success"><i class="fas fa-pen"></i></button>
            </a>

            <a rel="tovar.php?' . $url . 'id=' . $row["products_id"] . '&action=delete" class="delete mr-auto pt-0 mt-2">
              <button type="button" class="btn btn-block btn-danger"><i class="far fa-trash-alt"></i></button>
            </a>
        </div>

        <div class="view overlay">
          <div class="row mx-auto d-block">
            <div class="col-12">
              <img id="card-image" class="w-100 img-fluid" src="../images/', $row["image"], '">
            </div>
          </div>
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