<?php

$login = clearString($_POST["login"]);
$pass = clearString($_POST["pass"]);
$surname = $_POST["surname"];
$name = $_POST["name"];
$patronymic = $_POST["patronymic"];
$email = clearString($_POST["email"]);
$phone = clearString($_POST["phone"]);
$address = clearString($_POST["address"]);



if (isset($_POST['submit'])) {


    if (strlen($login) < 5 || strlen($login) > 15 || preg_match('/[а-яёА-ЯЁ,;*-]/', $login)) {
        $error[] = "Логин должен быть от 5 до 15 символов латиницей!";

        echo '<script>
                let mes1 = document.getElementById("loginHelpBlock");
                let inp1 = document.getElementById("reg_login");
                mes1.innerHTML = "Логин должен быть от 5 до 15 символов латиницей!";
                mes1.style.color = "red";
                mes1.hidden = false;
                inp1.classList.remove("mb-4");
                inp1.classList.add("mb-2");
                </script>
                ';
    } else {
        $result = mysqli_query($link, "SELECT login FROM reg_user WHERE login = '$login'");
        if (mysqli_num_rows($result) > 0) {
            $error[] = "Логин занят!";

            echo '<script>
            let mes1 = document.getElementById("loginHelpBlock");
            let inp1 = document.getElementById("reg_login");
            mes1.innerHTML = "Логин занят!";
            mes1.style.color = "red";
            mes1.hidden = false;
            inp1.classList.remove("mb-4");
            inp1.classList.add("mb-2");
            </script>
            ';
        }
    }


    if (strlen($pass) < 8 || strlen($pass) > 15  || preg_match('/[а-яёА-ЯЁ,;*-]/', $pass)) {
        $error[] = "Пароль должен быть от 8 до 15 символов латиницей!";

        echo '<script>
        let mes2 = document.getElementById("passwordHelpBlock");
        let inp2 = document.getElementById("reg_pass");
        mes2.innerHTML = "Пароль должен быть от 8 до 15 символов латиницей!";
        mes2.classList.remove("text-muted");
        mes2.style.color = "red";
        mes2.hidden = false;
        inp2.classList.remove("mb-4");
        inp2.classList.add("mb-2");
        </script>
        ';
    }


    if (strlen($surname) < 1) {
        $error[] = "Фамилия должна быть от 1 до 30 символов!";

        echo '<script>
        let mes3 = document.getElementById("surnameHelpBlock");
        let inp3 = document.getElementById("reg_surname");
        mes3.innerHTML = "Фамилия должна быть от 1 до 30 символов!";
        mes3.style.color = "red";
        mes3.hidden = false;
        inp3.classList.remove("mb-4");
        inp3.classList.add("mb-2");
        </script>
        ';
    }


    if (strlen($name) < 1) {
        $error[] = "Имя должно быть от 1 до 30 символов!";

        echo '<script>
        let mes4 = document.getElementById("nameHelpBlock");
        let inp4 = document.getElementById("reg_name");
        mes4.innerHTML = "Имя должно быть от 1 до 30 символов!";
        mes4.style.color = "red";
        mes4.hidden = false;
        inp4.classList.remove("mb-4");
        inp4.classList.add("mb-2");
        </script>
        ';
    }


    if (strlen($patronymic) < 1) {
        $error[] = "Отчество должно быть от 1 до 30 символов!";

        echo '<script>
        let mes5 = document.getElementById("patronymicHelpBlock");
        let inp5 = document.getElementById("reg_patronymic");
        mes5.innerHTML = "Отчество должно быть от 1 до 30 символов!";
        mes5.style.color = "red";
        mes5.hidden = false;
        inp5.classList.remove("mb-4");
        inp5.classList.add("mb-2");
        </script>
        ';
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Неправильно указан E-mail!";

        echo '<script>
        let mes6 = document.getElementById("emailHelpBlock");
        let inp6 = document.getElementById("reg_email");
        mes6.innerHTML = "Неправильно указан E-mail!";
        mes6.style.color = "red";
        mes6.hidden = false;
        inp6.classList.remove("mb-4");
        inp6.classList.add("mb-2");
        </script>
        ';
    } else {
        $result = mysqli_query($link, "SELECT email FROM reg_user WHERE email = '$email'");
        if (mysqli_num_rows($result) > 0) {
            $error[] = "E-mail занят!";

            echo '<script>
            let mes6 = document.getElementById("emailHelpBlock");
            let inp6 = document.getElementById("reg_email");
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
    if (strlen($phone) < 1) {
        $error[] = "Укажите номер телефона!";

        echo '<script>
        let mes7 = document.getElementById("phoneHelpBlock");
        let inp7 = document.getElementById("reg_phone");
        mes7.innerHTML = "Укажите номер телефона!";
        mes7.style.color = "red";
        mes7.hidden = false;
        inp7.classList.remove("mb-4");
        inp7.classList.add("mb-2");
        </script>
        ';
    }


    if (strlen($address) < 1) {
        $error[] = "Укажите адрес!";

        echo '<script>
        let mes8 = document.getElementById("addressHelpBlock");
        let inp8 = document.getElementById("reg_address");
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

        $pass = md5($pass);

        if (mysqli_query($link, "INSERT INTO reg_user(login, pass, surname, name, patronymic, email, phone, address)
         values('$login','$pass','$surname','$name','$patronymic','$email','$phone','$address');")) {
            $_SESSION['login'] = $_REQUEST['login'];
            $_SESSION['pass'] = $_REQUEST['pass'];
            $_SESSION['surname'] = $_REQUEST['surname'];
            $_SESSION['name'] = $_REQUEST['name'];
            $_SESSION['patronymic'] = $_REQUEST['patronymic'];
            $_SESSION['email'] = $_REQUEST['email'];
            $_SESSION['phone'] = $_REQUEST['phone'];
            $_SESSION['address'] = $_REQUEST['address'];
            echo '<script>
            let elem = document.getElementById("form-registration"); 
            elem.remove();
            let mes = document.getElementById("reg_message");
            mes.innerHTML = "Регистрация успешно завершена!";
            mes.style.marginTop = "100px";
            document.getElementById("auth_but").hidden = false;
            </script>
            ';
        }
    }
}
