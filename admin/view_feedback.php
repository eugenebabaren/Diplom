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

$id = clearString($_GET["id"]);
$action = $_GET["action"];

if (isset($action)) {

    $delete = mysqli_query($link, "DELETE FROM feedback WHERE id='$id'");
    header("Location: feedback.php");
}


if (isset($_POST['feedback_submit'])) {

    setlocale(LC_ALL, "ru_RU.UTF-8");

    if (strlen($_POST['answer']) < 1) {
        $error[] = "Укажите текст сообщения!";

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
                let mes4 = document.getElementById("answerHelpBlock");
                let inp4 = document.getElementById("answer");
                mes4.style.color = "red";
                mes4.hidden = false;
                inp4.classList.remove("mb-4");
                inp4.classList.add("mb-2");
            });
            </script>
            ';
    }



    if (empty($error)) {

        $query = mysqli_query($link, "SELECT * FROM feedback WHERE id = '$id'");

        $row = mysqli_fetch_array($query);

        mb_language("ru");
        mail($row["email"], $row["subject"], "Здравствуйте, " . $row["name"] . ".\r\n" . $_POST["answer"], "From:zpitanie040@gmail.com", "Content-Type: text/html; charset=utf-8");

        $update = mysqli_query($link, "UPDATE feedback SET confirmed='yes' WHERE id='$id'");

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
                let mes_success = document.getElementById("success_feedback_message");
                mes_success.hidden = false;
            });
            </script>
            ';
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


                    <?php

                    $query_reviews = mysqli_query($link, "SELECT * FROM feedback WHERE id = '$id'");

                    $row_reviews = mysqli_fetch_array($query_reviews);

                    do {

                        echo '
                                
                                        <div class="row ml-1 pt-2">
                                            <div class="col-lg-6 text-left">
                                                <p>' . $row_reviews["datetime"] . '</p>
                                                <p class="ml-xl-0 font-weight-bold">Сообщение №' . $row_reviews["id"] . ' -
                                                ';
                                                if ($row_reviews["confirmed"] == 'yes') {
                                                    echo '<span class="text-success">Отвечено</span>';
                                                } else {
                                                    echo '<span class="text-danger">Не отвечено</span>';
                                                }
                                                echo '
                                                </p>
                                                <p><span class=" font-weight-bold">Имя: </span>' . $row_reviews["name"] . '</p>
                                                <p><span class=" font-weight-bold">E-mail: </span>' . $row_reviews["email"] . '</p>
                                                <p><span class=" font-weight-bold">Тема: </span>' . $row_reviews["subject"] . '</p>
                                                <p><span class=" font-weight-bold">Сообщение: </span>' . $row_reviews["text"] . '</p>
                                            </div>
                                            <a rel="view_feedback.php?id=' . $row_reviews["id"] . '&action=delete" class="delete mr-3 h-75 ml-auto">
                                                <button class="btn btn-danger">
                                                    Удалить заказ
                                                </button> 
                                            </a>
                                        </div>';

                        if ($row_reviews["confirmed"] == 'no') {
                            echo '
                                        
                                            <hr>
                                            <div id="hide">
                                            <form method="POST">
                                                <p id="success_feedback_message" class="lead mb-4 ml-3 text-success" hidden>Сообщение успешно отправлено на ' . $row_reviews["email"] . '!</p>

                                                <label for="answer" class="col-8 mt-2">Ответ</label>
                                                <p class="col-8">
                                                    <textarea class="form-control" id="answer" name="answer" placeholder="Введите ответ" rows="7"></textarea>
                                                </p>
                                                <small id="answerHelpBlock" class="form-text mb-4 ml-3" hidden>
                                                    Укажите текст сообщения!
                                                </small>
                                                <button type="submit" name="feedback_submit" class="btn btn-success mb-2 mr-auto ml-3 h-75">
                                                    Ответить
                                                </button>
                                            </div>
                                            ';
                        }


                        echo '
                                    </form>


                            ';
                    } while ($row_reviews = mysqli_fetch_array($query_reviews));


                    


                    ?>


                </div>
            </section>

        </div>
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