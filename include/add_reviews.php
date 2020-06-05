<?php

$name = clearString($_POST["review_modal_name"]);
$good = clearString($_POST["review_modal_good"]);
$bad = clearString($_POST["review_modal_bad"]);
$comment = clearString($_POST["review_modal_comment"]);



if (isset($_POST['submit_review'])) {

    setlocale(LC_ALL, "ru_RU.UTF-8");

    $f_pregmat = '~' .
        '[^и][hхx][уyu][йyяij]|' .   // защита от: прихуй
        '[hхx][уyu][eеЁ][tlvлвт]|' .
        '[hхx][уyu][йyijoeоеёЁ]+[vwbв][oiоы]|' .
        '[pп][ieие][dдg][eaoеао][rpр]|' .
        '[scс][yuу][kк][aiuаи]|' .
        '[scс][yuу][4ч][кk]|' .
        '[3zsз][aа][eiе][bpб][iи]|' .
        '[^н][eе][bpб][aа][lл]|' .   // защита от: не бал*
        'fuck|xyu|' .
        '[pп][iи][zsз3][dд]|' .
        '[z3ж]h?[оo][pп][aаyуыiеe]' .
        '~si';

    // сложные слова, типа "оскорблять", писать с пробелом перед словом
    $f_pregmat2 = '~' .
        ' фак |' .
        ' лох |' .
        ' [бb6][лl]([яy]|ay)|' .
        ' [eiе][bpб][iи]|' .
        ' [eiе][bpб][aeаеёЁ][tlтл]' .
        '~si';

    if (strlen($name) < 1  || !preg_match('/^[а-яА-Яa-zA-Z]*$/u', $name)) {
        $error[] = "Имя должно быть не меньше 1 символа кириллицей или латиницей!";

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {   
        let mes1 = document.getElementById("nameHelpBlock");
        let inp1 = document.getElementById("review_modal_name");
        mes1.style.color = "red";
        mes1.hidden = false;
        inp1.classList.remove("mb-4");
        inp1.classList.add("mb-2");
        });
        </script>
        ';
    }
    else if (preg_match($f_pregmat, " $name ") || preg_match($f_pregmat2, " $name ")) {
        $error[] = "Не нужно ругаться!";

        echo '<script>
document.addEventListener("DOMContentLoaded", function() {
        let mes1 = document.getElementById("nameHelpBlock");
        let inp1 = document.getElementById("review_modal_name");
        mes1.style.color = "red";
        mes1.hidden = false;
        mes1.innerHTML = "Не нужно ругаться!";
        inp1.classList.remove("mb-4");
        inp1.classList.add("mb-2");
});
        </script>
        ';
    }

    if (strlen($good) < 1) {
        $error[] = "Укажите достоинства!";

        echo '<script>
document.addEventListener("DOMContentLoaded", function() {
        let mes2 = document.getElementById("goodHelpBlock");
        let inp2 = document.getElementById("review_modal_good");
        mes2.style.color = "red";
        mes2.hidden = false;
        inp2.classList.remove("mb-4");
        inp2.classList.add("mb-2");
});
        </script>
        ';
    }
    else if (preg_match($f_pregmat, " $good ") || preg_match($f_pregmat2, " $good ")) {
        $error[] = "Не нужно ругаться!";

        echo '<script>
document.addEventListener("DOMContentLoaded", function() {
        let mes2 = document.getElementById("goodHelpBlock");
        let inp2 = document.getElementById("review_modal_good");
        mes2.style.color = "red";
        mes2.hidden = false;
        mes2.innerHTML = "Не нужно ругаться!";
        inp2.classList.remove("mb-4");
        inp2.classList.add("mb-2");
});
        </script>
        ';
    }

    if (strlen($bad) < 1) {
        $error[] = "Укажите недостатки!";

        echo '<script>
document.addEventListener("DOMContentLoaded", function() {
        let mes3 = document.getElementById("badHelpBlock");
        let inp3 = document.getElementById("review_modal_bad");
        mes3.style.color = "red";
        mes3.hidden = false;
        inp3.classList.remove("mb-4");
        inp3.classList.add("mb-2");
});
        </script>
        ';
    }
    else if (preg_match($f_pregmat, " $bad ") || preg_match($f_pregmat2, " $bad ")) {
        $error[] = "Не нужно ругаться!";

        echo '<script>
document.addEventListener("DOMContentLoaded", function() {
        let mes3 = document.getElementById("badHelpBlock");
        let inp3 = document.getElementById("review_modal_bad");
        mes3.style.color = "red";
        mes3.hidden = false;
        mes3.innerHTML = "Не нужно ругаться!";
        inp3.classList.remove("mb-4");
        inp3.classList.add("mb-2");
        });
        </script>
        ';
    }

    if (strlen($comment) < 1) {
        $error[] = "Укажите комментарий!";

        echo '<script>
document.addEventListener("DOMContentLoaded", function() {
        let mes4 = document.getElementById("commentHelpBlock");
        let inp4 = document.getElementById("review_modal_comment");
        mes4.style.color = "red";
        mes4.hidden = false;
        inp4.classList.remove("mb-4");
        inp4.classList.add("mb-2");
});
        </script>
        ';
    }
    else if (preg_match($f_pregmat, " $comment ") || preg_match($f_pregmat2, " $comment ")) {
        $error[] = "Не нужно ругаться!";

        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
        let mes4 = document.getElementById("commentHelpBlock");
        let inp4 = document.getElementById("review_modal_comment");
        mes4.style.color = "red";
        mes4.hidden = false;
        mes4.innerHTML = "Не нужно ругаться!";
        inp4.classList.remove("mb-4");
        inp4.classList.add("mb-2");
});
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
        $id = clearString($_GET["id"]);
        header("Location: view_content.php?id=$id");
    } else {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.getElementById("write_review_btn").click();
                });
                </script>
                ';
    }
}