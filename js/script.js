$(document).ready(function () {

    $('.treeview-animated').mdbTreeview();


    //кнопка вверх страницы
    $(function () {

        $(window).scroll(function () {

            if ($(this).scrollTop() != 0) {

                $('#toTop').fadeIn();

            } else {

                $('#toTop').fadeOut();

            }

        });

        $('#toTop').click(function () {

            $('body,html').animate({
                scrollTop: 0
            }, 800);

        });

    });



    $("#reg_phone").mask("+375 (99) 999-99-99");


    //появление иконки выхода после входа
    if (localStorage.test == 2) {

        let sign_in_icon_new = document.getElementById("sign_in_navbar_title_new");
        let sign_in_icon_old = document.getElementById("sign_in_navbar_title_old");
        sign_in_icon_new.hidden = false;
        sign_in_icon_old.hidden = true;
        sign_in_icon_new.classList.add("fas", "fa-sign-out-alt");
        let sign_in_link = document.getElementById("sign_in_link");
        sign_in_link.href = "exit.php";

    }
    if (localStorage.reg_remove == 2) {

        let reg_remove = document.getElementById("reg_remove");
        reg_remove.remove();

    }

    //закрытие модального окна "забыли пароль?"
    $("#modalLoginForm").on('hide.bs.modal', function () {
        let error_forgotPassHelpBlock = document.getElementById("error_forgotPassHelpBlock");
        document.getElementById("remind_pass_but").click();
        error_forgotPassHelpBlock.hidden = true;
        
    });

    

});