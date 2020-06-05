<?php

include("include/db_connect.php");
include("include/functions.php");
session_start();

if ($_SESSION['auth_admin'] == 'yes_auth') {
    if (isset($_GET["logout"])) {
        session_destroy();
        header("Location: login.php");
    }
} else {
    header("Location: login.php");
}


$action = $_GET["action"];
$id = $_GET["id"];

if (isset($action)) {
    switch ($action) {
        case 'edit':
            //изменение

            $show_on_textarea = mysqli_query($link, "SELECT * FROM brand WHERE id='$id'");
                                if (mysqli_num_rows($show_on_textarea) > 0) {
                                    $result_show_on_textarea = mysqli_fetch_array($show_on_textarea);

                                    do {

                                        echo '
                                        <!-- модальное окно изменить -->
                    <form action="" method="post">
                        <div class="modal fade" id="modalReviewForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title w-100 font-weight-bold ml-3">Редактирование бренда</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body mx-3">
                                        <div class="md-form amber-textarea active-amber-textarea mt-4 mb-4">
                                            <textarea class="md-textarea form-control" rows="3" id="review_modal_good" name="modal_brand">' . $result_show_on_textarea["brand"] . '</textarea>
                                            <label for="review_modal_good">Категория</label>
                                            <small id="modal_brandHelpBlock" class="form-text" hidden>
                                                Укажите категорию!
                                            </small>
                                        </div>
                                    </div>

                                    <div class="modal-footer d-flex justify-content-center">
                                        <button id="button-send-review" type="submit" name="submit_edit" class="btn btn-warning" iid="<?php echo $id; ?>">Изменить</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                                        ';

                                    } while ($result_show_on_textarea = mysqli_fetch_array($show_on_textarea));
                                }
            
                                
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.getElementById("hidden_btn").click();
                    });
                    </script>
                    ';

            if (isset($_POST["submit_edit"])) {
                if (strlen($_POST["modal_brand"]) < 1) {
                    $error[] = "Вы не ввели бренд!";

                    echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let mes15 = document.getElementById("modal_brandHelpBlock");
                        let inp15 = document.getElementById("modal_brand");
                        mes15.innerHTML = "Вы не ввели бренд!";
                        mes15.style.color = "red";
                        mes15.hidden = false;
                        inp15.classList.remove("mb-4");
                        inp15.classList.add("mb-2");
                    });
                    </script>brand
                    ';
                }

                if (empty($error)) {

                    mysqli_query($link, "UPDATE brand SET brand='{$_POST["modal_brand"]}' WHERE id='$id'");
                    echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        location.replace("brand.php");
                    });
                    </script>
                    ';
                }
            }
            break;

        case 'delete':
            $delete = mysqli_query($link, "DELETE FROM brand WHERE id='$id'");
            break;
    }
}



if (isset($_POST["add_brand_btn"])) {
    if (strlen($_POST["brand"]) < 1) {
        $error[] = "Вы не ввели бренд!";

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            let mes12 = document.getElementById("brandHelpBlock");
            let inp12 = document.getElementById("brand");
            mes12.innerHTML = "Вы не ввели бренд!";
            mes12.style.color = "red";
            mes12.hidden = false;
            inp12.classList.remove("mb-4");
            inp12.classList.add("mb-2");
        });
        </script>
        ';
    } else {
        $result3 = mysqli_query($link, "SELECT brand FROM brand WHERE brand = '{$_POST["brand"]}'");
        if (mysqli_num_rows($result3) > 0) {
            $error[] = "Такой бренд уже есть!";

            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                let mes12 = document.getElementById("brandHelpBlock");
                let inp12 = document.getElementById("brand");
                mes12.innerHTML = "Такой бренд уже есть!";
                mes12.style.color = "red";
                mes12.hidden = false;
                inp12.classList.remove("mb-4");
                inp12.classList.add("mb-2");
            });
            </script>
            ';
        }
    }

    //ДОБАВЛЕНИЕ
    if (empty($error)) {

        mysqli_query($link, "INSERT INTO brand(brand) 
                            values('" . $_POST["brand"] . "' )");
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Админ. панель</title>
    <!-- MDB icon -->
    <link rel="icon" href="../images/fruit.svg" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
    <style>
        #cat {
            overflow-y: hidden;
            /* убрать полосы прокрутки */
        }
    </style>
</head>

<body class="grey lighten-3">
    <header>

        <!-- NAVBAR -->
        <?php
        include("include/navbar.php");
        ?>

    </header>

    <main>

        <?php
        include("include/sidebar.php");
        ?>

        <div class="finder ml-3 mr-2 mb-0 justify-content-between">

            <section class="col mb-3 p-0">
                <div class="card wow fadeIn d-flex m-0 p-4">

                    <form action="" method="post">

                        <div class="col-10 mt-4 ml-2">
                            <div class="row">
                                <input type="text" name="brand" id="brand" class="form-control mt-2 ml-3 mb-4 w-50" placeholder="Бренд">

                                <a href="" class="ml-4">
                                    <button name="add_brand_btn" type="submit" class="btn btn-success">Добавить</button>
                                </a>
                            </div>
                        </div>
                        <small id="brandHelpBlock" class="form-text ml-4" hidden>
                            At least 8 characters and 1 digit
                        </small>


                        <table class="table table-striped table-responsive-md btn-table ml-4 mt-4 w-75">

                            <thead>

                                <tr>

                                </tr>
                                <tr>
                                    <th class="font-weight-bold">Категория</th>
                                    <th class="font-weight-bold">Действие</th>
                                </tr>

                            </thead>


                            <tbody>
                                <?php

                                $brand = mysqli_query($link, "SELECT * FROM brand ORDER BY brand");
                                if (mysqli_num_rows($brand) > 0) {
                                    $result_brand = mysqli_fetch_array($brand);

                                    

                                    do {

                                        echo '
                                    <tr>
                                        
                                            
                                        <td>
                                            ' . $result_brand["brand"] . '
                                        </td>

                                                    
                                        
                                        <td class="pr-0">
                                        <a href="brand.php?id=' . $result_brand["id"] . '&action=edit">
                                            <button type="button" class="btn btn-success btn-sm m-0"><i class="fas fa-pen"></i></button>
                                        </a>
                                        <button type="button" name="hidden_btn" id="hidden_btn" hidden class="btn btn-success btn-sm m-0" data-toggle="modal" data-target="#modalReviewForm"><i class="fas fa-pen"></i></button>
                                            <input name="hidden_id_brand" hidden value="' . $result_brand["id"] . '">
                                            <button type="button" rel="brand.php?id=' . $result_brand["id"] . '&action=delete" class="delete-cat btn btn-danger btn-sm m-0"><i class="far fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    ';
                                    } while ($result_brand = mysqli_fetch_array($brand));
                                }

                                ?>
                            </tbody>

                        </table>

                    </form>



                </div>
            </section>



    </main>


    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Your custom scripts (optional) -->
    <script src="js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</body>

</html>