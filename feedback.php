<?php

include("include/db_connect.php");
include("functions/functions.php");
session_start();
include("include/auth_cookie.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Здоровое питание</title>
    <!-- MDB icon -->
    <link rel="icon" href="images/fruit.svg" type="image/x-icon">
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

        <form method="POST" id="form_feedback" action="" class="my-text-center text-center border border-light p-5">

            <div id="form-feedback">

                <p class="h4 mb-4 font-weight-bold mt-4">Обратная связь</p>

                <p id="success_feedback_message" class="h4 mb-4 text-success" hidden>Ваше сообщение успешно отправлено!</p>

                <input type="text" name="feedback_name" id="feedback_name" class="form-control mb-4" placeholder="Имя">
                <small id="feedback_nameHelpBlock" class="form-text mb-4" hidden>
                    Имя должно быть не меньше 1 символа кириллицей или латиницей!
                </small>

                <input type="text" name="feedback_email" id="feedback_email" class="form-control mb-4" placeholder="E-mail">
                <small id="feedback_emailHelpBlock" class="form-text mb-4" hidden>
                    Неправильно указан E-mail!
                </small>

                <input type="text" name="feedback_subject" id="feedback_subject" class="form-control mb-4" placeholder="Тема">
                <small id="feedback_subjectHelpBlock" class="form-text mb-4" hidden>
                    Укажите тему!
                </small>

                <div class="form-group">
                    <textarea class="form-control mb-4" name="feedback_text" id="feedback_text" rows="7" placeholder="Текст сообщения"></textarea>
                </div>
                <small id="feedback_textHelpBlock" class="form-text mb-4" hidden>
                    Укажите текст сообщения!
                </small>

                <!-- Sign up button -->
                <button type="submit" name="feedback_submit" class="btn btn-success my-4 btn mt-6">Отправить</button>
            </div>

        </form>

        <?php

        $name = clearString($_POST["feedback_name"]);
        $email = clearString($_POST["feedback_email"]);
        $subject = clearString($_POST["feedback_subject"]);
        $text = clearString($_POST["feedback_text"]);



        if (isset($_POST['feedback_submit'])) {

            setlocale(LC_ALL, "ru_RU.UTF-8");

            if (strlen($name) < 1  || !preg_match('/^[а-яА-Яa-zA-Z]*$/u', $name)) {
                $error[] = "Имя должно быть не меньше 1 символа кириллицей или латиницей!";

                echo '<script>
        let mes1 = document.getElementById("feedback_nameHelpBlock");
        let inp1 = document.getElementById("feedback_name");
        mes1.style.color = "red";
        mes1.hidden = false;
        inp1.classList.remove("mb-4");
        inp1.classList.add("mb-2");
        </script>
        ';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error[] = "Неправильно указан E-mail!";

                echo '<script>
            let mes2 = document.getElementById("feedback_emailHelpBlock");
            let inp2 = document.getElementById("feedback_email");
            mes2.style.color = "red";
            mes2.hidden = false;
            inp2.classList.remove("mb-4");
            inp2.classList.add("mb-2");
        </script>
        ';
            }

            if (strlen($subject) < 1) {
                $error[] = "Укажите тему!";

                echo '<script>
            let mes3 = document.getElementById("feedback_subjectHelpBlock");
            let inp3 = document.getElementById("feedback_subject");
            mes3.style.color = "red";
            mes3.hidden = false;
            inp3.classList.remove("mb-4");
            inp3.classList.add("mb-2");
        </script>
        ';
            }

            if (strlen($text) < 1) {
                $error[] = "Укажите текст сообщения!";

                echo '<script>
            let mes4 = document.getElementById("feedback_textHelpBlock");
            let inp4 = document.getElementById("feedback_text");
            mes4.style.color = "red";
            mes4.hidden = false;
            inp4.classList.remove("mb-4");
            inp4.classList.add("mb-2");
        </script>
        ';
            }



            if (empty($error)) {

                mb_language("ru");
                mail('zpitanie040@gmail.com', $subject, "От: " . $name . "\r\n" . $text, 'From:' . $email, 'Content-Type: text/html; charset=utf-8');

                echo '<script>
            let mes_success = document.getElementById("success_feedback_message");
            mes_success.hidden = false;

        </script>
        ';
            }
        } ?>

    </main>

    <?php
    include("include/footer.php");
    ?>


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

</body>

</html>