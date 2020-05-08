<?php

if (isset($_POST['sign_submit'])) {

    $result = mysqli_query($link, "SELECT * FROM reg_user WHERE (login = '$login' OR email = '$login') AND pass = '$pass'");
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);

        $_SESSION['auth_login'] = $row['login'];
        $_SESSION['auth_pass'] = $row['pass'];
        $_SESSION['auth_surname'] = $row['surname'];
        $_SESSION['auth_name'] = $row['name'];
        $_SESSION['auth_patronymic'] = $row['patronymic'];
        $_SESSION['auth_email'] = $row['email'];
        $_SESSION['auth_phone'] = $row['phone'];
        $_SESSION['auth_address'] = $row['address'];
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {

                localStorage.test = 2;
                location.replace("index.php");
                
                let sign_in_icon_old = document.getElementById("sign_in_navbar_title_old");
                sign_in_icon_old.hidden = true;

                let sign_in_icon_new = document.getElementById("sign_in_navbar_title_new");
                sign_in_icon_new.classList.add("fas", "fa-sign-out-alt");
                sign_in_icon_new.hidden = false;

                let profile_icon = document.getElementById("profile_icon");
                profile_icon.hidden = false;

                localStorage.reg_remove = 2;
                let reg_remove = document.getElementById("reg_remove");
                reg_remove.remove();

            });
        </script>
        ';
    } else {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {

                let mes_auth_wrong = document.getElementById("message-auth");
                mes_auth_wrong.hidden = false;

            });
        </script>
        ';
    }
}
