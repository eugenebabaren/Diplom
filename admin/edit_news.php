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

$id = $_GET["id"];



if (isset($_POST['add_news_form_submit'])) {

    setlocale(LC_ALL, "ru_RU.UTF-8");

    if (strlen($_POST["title"]) < 1) {
        $error[] = "Укажите заголовок!";

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            let mes1 = document.getElementById("titleHelpBlock");
            let inp1 = document.getElementById("title");
            mes1.innerHTML = "Укажите заголовок!";
            mes1.style.color = "red";
            mes1.hidden = false;
            inp1.classList.remove("mb-4");
            inp1.classList.add("mb-2");
        });
        </script>
        ';
    }

    if (strlen($_POST["descr"]) < 1) {
        $error[] = "Укажите описание!";

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            let mes2 = document.getElementById("descrHelpBlock");
            let inp2 = document.getElementById("descr");
            mes2.innerHTML = "Укажите описание!";
            mes2.style.color = "red";
            mes2.hidden = false;
            inp2.classList.remove("mb-4");
            inp2.classList.add("mb-2");
        });
        </script>
        ';
    }


    if (empty($_POST["upload_image"])) {

        if ($_FILES["upload_image"]["error"] > 0) {
            switch ($_FILES["upload_image"]["error"]) {
                case 1:
                    $error[] = "Размер принятого файла превысил максимально допустимый размер";

                    echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let mes6 = document.getElementById("imageHelpBlock");
                        let inp6 = document.getElementById("image");
                        mes6.innerHTML = "Размер принятого файла превысил максимально допустимый размер";
                        mes6.style.color = "red";
                        mes6.hidden = false;
                        inp6.classList.remove("mb-4");
                        inp6.classList.add("mb-2");
                    });
                    </script>
                    ';
                    $message = "Размер принятого файла превысил максимально допустимый размер";
                    break;

                case 2:
                    $error[] = "Размер загружаемого файла превысил значение 5 МБ";

                    echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let mes6 = document.getElementById("imageHelpBlock");
                        let inp6 = document.getElementById("image");
                        mes6.innerHTML = "Размер загружаемого файла превысил значение 5 МБ";
                        mes6.style.color = "red";
                        mes6.hidden = false;
                        inp6.classList.remove("mb-4");
                        inp6.classList.add("mb-2");
                    });
                    </script>
                    ';
                    $message = "Размер загружаемого файла превысил значение 5 МБ";
                    break;
                case 3:
                    $error[] = "Загружаемый файл был получен только частично";

                    echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let mes6 = document.getElementById("imageHelpBlock");
                        let inp6 = document.getElementById("image");
                        mes6.innerHTML = "Загружаемый файл был получен только частично";
                        mes6.style.color = "red";
                        mes6.hidden = false;
                        inp6.classList.remove("mb-4");
                        inp6.classList.add("mb-2");
                    });
                    </script>
                    ';
                    $message = "Загружаемый файл был получен только частично";
                    break;
                case 4:
                    $old_image = mysqli_query($link, "SELECT * FROM news WHERE id='$id'");
                            if (mysqli_num_rows($old_image) > 0) {
                                $result_old_image = mysqli_fetch_array($old_image);

                                do {
                                    $newfilename = $result_old_image["image"];

                                } while ($result_old_image = mysqli_fetch_array($old_image));
                            }
                    
                    break;
                case 6:
                    $error[] = "Отсутствует временная папка";

                    echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let mes6 = document.getElementById("imageHelpBlock");
                        let inp6 = document.getElementById("image");
                        mes6.innerHTML = "Отсутствует временная папка";
                        mes6.style.color = "red";
                        mes6.hidden = false;
                        inp6.classList.remove("mb-4");
                        inp6.classList.add("mb-2");
                    });
                    </script>
                    ';
                    $message = "Отсутствует временная папка";
                    break;
                case 7:
                    $error[] = "Не удалось записать файл на диск";

                    echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let mes6 = document.getElementById("imageHelpBlock");
                        let inp6 = document.getElementById("image");
                        mes6.innerHTML = "Не удалось записать файл на диск";
                        mes6.style.color = "red";
                        mes6.hidden = false;
                        inp6.classList.remove("mb-4");
                        inp6.classList.add("mb-2");
                    });
                    </script>
                    ';
                    $message = "Не удалось записать файл на диск";
                    break;
                case 8:
                    $error[] = "PHP-расширение остановило загрузку файла";

                    echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let mes6 = document.getElementById("imageHelpBlock");
                        let inp6 = document.getElementById("image");
                        mes6.innerHTML = "PHP-расширение остановило загрузку файла";
                        mes6.style.color = "red";
                        mes6.hidden = false;
                        inp6.classList.remove("mb-4");
                        inp6.classList.add("mb-2");
                    });
                    </script>
                    ';
                    $message = "PHP-расширение остановило загрузку файла";
                    break;

                default:
                    $error[] = "Неизвестная ошибка";

                    echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let mes6 = document.getElementById("imageHelpBlock");
                        let inp6 = document.getElementById("image");
                        mes6.innerHTML = "Неизвестная ошибка";
                        mes6.style.color = "red";
                        mes6.hidden = false;
                        inp6.classList.remove("mb-4");
                        inp6.classList.add("mb-2");
                    });
                    </script>
                    ';
                    $message = "Неизвестная ошибка";
                    break;
            }
        } else {
            if ($_FILES["upload_image"]["type"] == "image/jpeg" || $_FILES["upload_image"]["type"] == "image/jpg" || $_FILES["upload_image"]["type"] == "image/png") {

                $imgext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES["upload_image"]["name"]));

                $uploaddir = "../images/";
                $newfilename = $id . rand(10, 100) . "" . rand(10, 100) . "" . rand(10, 100) . "." . $imgext;
                $uploadfile = $uploaddir . $newfilename;

                if (move_uploaded_file($_FILES["upload_image"]["tmp_name"], $uploadfile)) {
                    $update = mysqli_query($link, "UPDATE news SET image='$newfilename' WHERE id='$id'");
                }
            } else {
                $error[] = "Допустимые расширения: jpeg, jpg, png";

                echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    let mes6 = document.getElementById("imageHelpBlock");
                    let inp6 = document.getElementById("image");
                    mes6.innerHTML = "Допустимые расширения: jpeg, jpg, png";
                    mes6.style.color = "red";
                    mes6.hidden = false;
                    inp6.classList.remove("mb-4");
                    inp6.classList.add("mb-2");
                });
                </script>
                ';
                $message = "Допустимые расширения: jpeg, jpg, png";
            }
        }
        unset($_POST["upload_image"]);
    } else {
        $error[] = "Вы не выбрали файл";

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            let mes6 = document.getElementById("imageHelpBlock");
            let inp6 = document.getElementById("image");
            mes6.innerHTML = "Вы не выбрали файл";
            mes6.style.color = "red";
            mes6.hidden = false;
            inp6.classList.remove("mb-4");
            inp6.classList.add("mb-2");
        });
        </script>
        ';
    }


    //ДОБАВЛЕНИЕ
    if (empty($error)) {

        $edit_query = "title='{$_POST["title"]}',image='{$newfilename}',text='{$_POST["descr"]}'";

        $update = mysqli_query($link, "UPDATE news SET $edit_query WHERE id='$id'");

        header("Location: news.php");
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

        <div class="finder ml-3 mr-2 mb-3">
            <!-- <div class="container-fluid d-flex"> -->
            <div class="card mb-3wow fadeIn text-align-center">
                <div class="col-auto ml-1 mt-2">
                    <form method="POST" enctype="multipart/form-data" class="ml-4">
                        <!-- Default form register -->

                        <p id="profile_message" class="h4 mb-4"></p>

                        <div id="form-profile">

                            <p class="h4 mb-4 font-weight-bold">Изменение новости</p>

                            <p id="message-success-edit" class="h5 mb-4 text-success" hidden>Данные успешно изменены!</p>

                            <?php
                            $result = mysqli_query($link, "SELECT * FROM news WHERE id='$id'");

                            $row = mysqli_fetch_array($result);

                            echo '

                            <label data-error="wrong" data-success="right" for="title">Заголовок</label>
                            <input type="text" name="title" id="title" class="form-control mb-4 w-75" placeholder="Заголовок" autocomplete="off" value="' . $row["title"] . '">
                            <small id="titleHelpBlock" class="form-text mb-4" hidden>
                                At least 8 characters and 1 digit
                            </small>


                            <label class="mb-1">Изображение</label>
                            <div class="row">
                                <span class="output" id="output"><img id="outIMG" src="../images/' . $row["image"] . '" class="w-25 img-fluid m-3"></span>
                            </div>
                            <div class="custom-file mb-4" id="image">
                                <input name="MAX_FILE_SIZE" type="hidden" value="5000000">
                                <input id="upload_image" name="upload_image" type="file" class="custom-file-input w-75" lang="ru" accept="image/jpg,image/jpeg,image/png">
                                <label class="custom-file-label w-75" for="upload_image">Выберите файл</label>
                            </div>
                            <small id="imageHelpBlock" class="form-text mb-4" hidden>
                                At least 8 characters and 1 digit
                            </small>


                            <label data-error="wrong" data-success="right" for="descr">Описание</label>
                            <textarea type="text" name="descr" id="descr" class="form-control mb-2 w-75" placeholder="Описание" rows="10">' . $row["text"] . '</textarea>
                            <small id="descrHelpBlock" class="form-text mb-4" hidden>
                                At least 8 characters and 1 digit
                            </small>
                            ';

                            ?>

                            <!-- Sign up button -->
                            <button type="submit" name="add_news_form_submit" id="add_news_form_submit" class="btn btn-success mt-3 mb-5">Изменить</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>

    </main>


    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Your custom scripts (optional) -->
    <script src="js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script>
        //изменение картинки
        $(document).ready(function() {

            function handleFileSelect(evt) {
                $("span.output").empty();

                var file = evt.target.files; // FileList object
                var f = file[0];
                // Only process image files.
                if (!f.type.match('image.*')) {
                    alert("Image only please....");
                }
                var reader = new FileReader();
                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                    return function(e) {
                        // Render thumbnail.
                        var span = document.createElement('span');
                        span.innerHTML = ['<img class="w-25 img-fluid m-3" title="', escape(theFile.name), '" src="', e.target.result, '" />'].join('');
                        document.getElementById('output').insertBefore(span, null);
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
                document.getElementById('outIMG').hidden = true;
            }
            document.getElementById('upload_image').addEventListener('change', handleFileSelect, false);

        });
    </script>

</body>

</html>