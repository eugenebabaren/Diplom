<?php

$profile_current_pass = clearString($_POST["profile_current_pass"]);
$profile_new_pass = clearString($_POST["profile_new_pass"]);
$profile_surname = $_POST["profile_surname"];
$profile_name = $_POST["profile_name"];
$profile_patronymic = $_POST["profile_patronymic"];
$profile_email = clearString($_POST["profile_email"]);
$profile_phone = clearString($_POST["profile_phone"]);
$profile_address = clearString($_POST["profile_address"]);



if (isset($_POST['profile_form_submit'])) {

    setlocale(LC_ALL, "ru_RU.UTF-8");

    if ($_SESSION['auth_pass'] != md5($profile_current_pass)) {
        $error[] = "Неверный текущий пароль!";

        echo '<script>
        let mes1 = document.getElementById("loginHelpBlock");
        let inp1 = document.getElementById("profile_current_pass");
        mes1.innerHTML = "Неверный текущий пароль!";
        mes1.classList.remove("text-muted");
        mes1.style.color = "red";
        mes1.hidden = false;
        inp1.classList.remove("mb-4");
        inp1.classList.add("mb-2");
        </script>
        ';
    }



    if (strlen($profile_new_pass) < 1) {
    } else if (strlen($profile_new_pass) < 8 || strlen($profile_new_pass) > 15  || preg_match('/[а-яёА-ЯЁ,;*-]/', $profile_new_pass)) {
        $error[] = "Новый пароль должен быть от 8 до 15 символов латиницей!";

        echo '<script>
            let mes2 = document.getElementById("passwordHelpBlock");
            let inp2 = document.getElementById("profile_new_pass");
            mes2.innerHTML = "Новый пароль должен быть от 8 до 15 символов латиницей!";
            mes2.classList.remove("text-muted");
            mes2.style.color = "red";
            mes2.hidden = false;
            inp2.classList.remove("mb-4");
            inp2.classList.add("mb-2");
            </script>
            ';
    } else {
        $profile_new_pass = md5($profile_new_pass);
        $new_pass_query = "pass='" . $profile_new_pass . "',";
    }



    if (strlen($profile_surname) < 1 || !preg_match('/^[а-яА-Яa-zA-Z]*$/u', $profile_surname)) {
        $error[] = "Фамилия должна быть не меньше 1 символа кириллицей или латиницей!";

        echo '<script>
        let mes3 = document.getElementById("surnameHelpBlock");
        let inp3 = document.getElementById("profile_surname");
        mes3.innerHTML = "Фамилия должна быть не меньше 1 символа кириллицей или латиницей!";
        mes3.style.color = "red";
        mes3.hidden = false;
        inp3.classList.remove("mb-4");
        inp3.classList.add("mb-2");
        </script>
        ';
    }


    if (strlen($profile_name) < 1 || !preg_match('/^[а-яА-Яa-zA-Z]*$/u', $profile_name)) {
        $error[] = "Имя должно быть не меньше 1 символа кириллицей или латиницей!";

        echo '<script>
        let mes4 = document.getElementById("nameHelpBlock");
        let inp4 = document.getElementById("profile_name");
        mes4.innerHTML = "Имя должно быть не меньше 1 символа кириллицей или латиницей!";
        mes4.style.color = "red";
        mes4.hidden = false;
        inp4.classList.remove("mb-4");
        inp4.classList.add("mb-2");
        </script>
        ';
    }


    if (strlen($profile_patronymic) < 1 || !preg_match('/^[а-яА-Яa-zA-Z]*$/u', $profile_patronymic)) {
        $error[] = "Отчество должно быть не меньшене меньше 1 символа кириллицей или латиницей!";

        echo '<script>
        let mes5 = document.getElementById("patronymicHelpBlock");
        let inp5 = document.getElementById("profile_patronymic");
        mes5.innerHTML = "Отчество должно быть не меньше 1 символа кириллицей или латиницей!";
        mes5.style.color = "red";
        mes5.hidden = false;
        inp5.classList.remove("mb-4");
        inp5.classList.add("mb-2");
        </script>
        ';
    }


    if (!filter_var($profile_email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Неправильно указан E-mail!";

        echo '<script>
        let mes6 = document.getElementById("emailHelpBlock");
        let inp6 = document.getElementById("profile_email");
        mes6.innerHTML = "Неправильно указан E-mail!";
        mes6.style.color = "red";
        mes6.hidden = false;
        inp6.classList.remove("mb-4");
        inp6.classList.add("mb-2");
        </script>
        ';
    } else if ($_SESSION['auth_email'] == $profile_email) {
    } else {
        $result = mysqli_query($link, "SELECT email FROM reg_user WHERE email = '$profile_email'");
        if (mysqli_num_rows($result) > 0) {
            $error[] = "E-mail занят!";

            echo '<script>
            let mes6 = document.getElementById("emailHelpBlock");
            let inp6 = document.getElementById("profile_email");
            mes6.innerHTML = "E-mail занят!";
            mes6.style.color = "red";
            mes6.hidden = false;
            inp6.classList.remove("mb-4");
            inp6.classList.add("mb-2");
            </script>
            ';
        }
    }


    // +  маска телефона в js
    if (strlen($profile_phone) < 1) {
        $error[] = "Укажите номер телефона!";

        echo '<script>
        let mes7 = document.getElementById("phoneHelpBlock");
        let inp7 = document.getElementById("profile_phone");
        mes7.innerHTML = "Укажите номер телефона!";
        mes7.style.color = "red";
        mes7.hidden = false;
        inp7.classList.remove("mb-4");
        inp7.classList.add("mb-2");
        </script>
        ';
    }


    if (strlen($profile_address) < 1) {
        $error[] = "Укажите адрес!";

        echo '<script>
        let mes8 = document.getElementById("addressHelpBlock");
        let inp8 = document.getElementById("profile_address");
        mes8.innerHTML = "Укажите адрес!";
        mes8.style.color = "red";
        mes8.hidden = false;
        inp8.classList.remove("mb-4");
        inp8.classList.add("mb-2");
        </script>
        ';
    }



    //ДОБАВЛЕНИЕ
    if (empty($error)) {

        $dataquery = $new_pass_query . "surname='" . $profile_surname . "', name='" . $profile_name . "', patronymic='" . $profile_patronymic . "', email='" . $profile_email . "', phone='" . $profile_phone . "', address='" . $profile_address . "'";

        $update = mysqli_query($link, "UPDATE reg_user SET $dataquery WHERE login = '{$_SESSION['auth_login']}'");


        if ($profile_new_pass) {
            $_SESSION['auth_pass'] = $profile_new_pass;
        }

        $_SESSION["auth_surname"] = $profile_surname;
        $_SESSION["auth_name"] = $profile_name;
        $_SESSION["auth_patronymic"] = $profile_patronymic;
        $_SESSION["auth_email"] = $profile_email;
        $_SESSION["auth_phone"] = $profile_phone;
        $_SESSION["auth_address"] = $profile_address;

        echo '<script>
        location.replace("profile.php");
        localStorage.reload = 2;
        </script>
        ';

    } else {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById("profile_surname").value = "";
            document.getElementById("profile_name").value = "";
            document.getElementById("profile_patronymic").value = "";
            document.getElementById("profile_email").value = "";
            document.getElementById("profile_phone").value = "";
            document.getElementById("profile_address").value = "";

        });
        </script>
        ';
    }
}
