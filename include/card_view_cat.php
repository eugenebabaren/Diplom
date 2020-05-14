<div class="ml-0 mr-2 mb-0">
  <div class="card-row row row-cols-1 row-cols-md-3 d-flex">
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



    $result = mysqli_query($link, "SELECT * FROM products WHERE visible='1' $querycat ORDER BY $sorting");

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);

      do {


        echo '
      <div class="col mb-4 pr-2">

      <div class="card">

        <div class="view overlay">
          <img id="card-image" class="card-img-top" src="images/', $row["image"], '" alt="Card image cap">
          <a href="#">
            <div class="mask rgba-white-slight"></div>
          </a>
          <div class="dropdown-divider"></div>
        </div>


        <div class="card-body">


          <h4 class="card-title"><b>', $row["brand"], '</b></h4>

          <p class="card-text">
            <h6>', $row["title"], '</h6>
          </p>
          <h4 class="card-price">', $row["price"], ' руб.</h4>

          <a class="add_to_busket" tid="' . $row["products_id"] . '">
            <button type="button" class="btn btn-success btn-md ml-0"><i class="fas fa-shopping-basket ml-0 mr-2"></i>В корзину</button>
          </a>
          <button type="button" class="btn btn-danger btn-md mr-0"><i class="fas fa-heart"></i></button>
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