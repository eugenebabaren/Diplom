<?php

$name = clearString($_POST["review_modal_name"]);
$good = clearString($_POST["review_modal_good"]);
$bad = clearString($_POST["review_modal_bad"]);
$comment = clearString($_POST["review_modal_comment"]);



if (isset($_POST['submit_review'])) {

    setlocale(LC_ALL, "ru_RU.UTF-8");

    if (strlen($name) < 1  || !preg_match('/^[а-яА-Яa-zA-Z]*$/u', $name)) {
        $error[] = "Имя должно быть не меньше 1 символа кириллицей или латиницей!";

        echo '<script>
        let mes1 = document.getElementById("nameHelpBlock");
        let inp1 = document.getElementById("review_modal_name");
        mes1.style.color = "red";
        mes1.hidden = false;
        inp1.classList.remove("mb-4");
        inp1.classList.add("mb-2");
        </script>
        ';
    }

    if (strlen($good) < 1) {
        $error[] = "Укажите достоинства!";

        echo '<script>
        let mes2 = document.getElementById("goodHelpBlock");
        let inp2 = document.getElementById("review_modal_good");
        mes2.style.color = "red";
        mes2.hidden = false;
        inp2.classList.remove("mb-4");
        inp2.classList.add("mb-2");
        </script>
        ';
    }

    if (strlen($bad) < 1) {
        $error[] = "Укажите недостатки!";

        echo '<script>
        let mes3 = document.getElementById("badHelpBlock");
        let inp3 = document.getElementById("review_modal_bad");
        mes3.style.color = "red";
        mes3.hidden = false;
        inp3.classList.remove("mb-4");
        inp3.classList.add("mb-2");
        </script>
        ';
    }



    //ДОБАВЛЕНИЕ
    if (empty($error)) {

        mysqli_query($link, "INSERT INTO reviews(products_id, name, good_reviews, bad_reviews, comment, date)
         values('" . $id . "',
                '" . $name . "',
                '" . $good . "',
                '" . $bad . "',
                '" . $comment . "',
                NOW()
                );");
    } else {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.getElementById("write_review_btn").click();
                });
                </script>
                ';
    }
}
