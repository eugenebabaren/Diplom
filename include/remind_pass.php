<?php

if (isset($_POST['remind_pass_submit'])) {

    $email = $_POST['remind_pass_email'];

    if ($email != "") {

        $result = mysqli_query($link, "SELECT email FROM reg_user WHERE email = '$email'");
        if (mysqli_num_rows($result) > 0) {

            echo '<script>
               

            delete localStorage.remind_pass;

        
            </script>
            ';

            $new_pass = generateRandomPass(rand(8, 14));

            $pass = md5($new_pass);

            $update_pass = mysqli_query($link, "UPDATE reg_user SET pass='$pass' WHERE email = '$email'");

            mb_language("ru");
            mail($email, 'Новый пароль для сайта "Здоровое питания."', 'Ваш новый пароль:' . $new_pass, 'From: zpitanie040@gmail.com', 'Content-Type: text/html; charset=utf-8');

            
        } else if (mysqli_num_rows($result) < 1) {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    let error_forgotPassHelpBlock = document.getElementById("error_forgotPassHelpBlock");
                    document.getElementById("remind_pass_but").click();
                    error_forgotPassHelpBlock.hidden = false;
                    error_forgotPassHelpBlock.style.color = "red";
                });
                </script>
                ';
        }


    } else {
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                
                    let error_forgotPassHelpBlock = document.getElementById("error_forgotPassHelpBlock");
                    document.getElementById("remind_pass_but").click();
                    error_forgotPassHelpBlock.hidden = false;
                    error_forgotPassHelpBlock.style.color = "red";

                });
                </script>
                ';
    }
}
