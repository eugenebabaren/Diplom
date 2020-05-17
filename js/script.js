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


    // обновление количества товаров на иконке корзины
    loadcart();



    $("#reg_phone").mask("+375 (99) 999-99-99");
    $("#profile_phone").mask("+375 (99) 999-99-99");
    $("#order_phone").mask("+375 (99) 999-99-99");


    //появление иконки выхода после входа
    if (localStorage.test == 2) {

        let sign_in_icon_new = document.getElementById("sign_in_navbar_title_new");
        let sign_in_icon_old = document.getElementById("sign_in_navbar_title_old");
        sign_in_icon_new.hidden = false;
        sign_in_icon_old.hidden = true;
        sign_in_icon_new.classList.add("fas", "fa-sign-out-alt");
        let sign_in_link = document.getElementById("sign_in_link");
        sign_in_link.href = "exit.php";
        let profile_icon = document.getElementById("profile_icon");
        profile_icon.hidden = false;

    }
    //УДАЛЕНИЕ КНОПКИ РЕГИСТРАЦИИ
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




    //корзина
    $('.add_to_busket,.add-cart').click(function () {
        var tid = $(this).attr("tid");

        $.ajax({
            type: "POST",
            url: "addtocart.php",
            data: "id=" + tid,
            dataType: "html",
            cache: false,
            success: function (data) {
                loadcart();
            }
        });
    })

    // обновление количества товаров на иконке корзины
    function loadcart() {
        $.ajax({
            type: "POST",
            url: "include/loadcart.php",
            dataType: "html",
            cache: false,
            success: function (data) {
                if (data == 0) {
                    $("#fa-shopping-basket > span").html("0");
                } else {
                    $("#fa-shopping-basket > span").html(data);
                }
            }
        });
    }

    // корзина минус
    $('.minus').click(function () {
        var iid = $(this).attr("iid");

        $.ajax({
            type: "POST",
            url: "count-minus.php",
            data: "id=" + iid,
            dataType: "html",
            cache: false,
            success: function (data) {
                $('#plus-minus-input-id' + iid).val(data);
                loadcart();

                var priceproduct = $('#tovar' + iid + ' > span').attr("price");
                result_total = Number(priceproduct) * Number(data);

                $('#tovar' + iid + ' > span').html(result_total + " руб.");
                $('#tovar2' + iid + ' > span').html(result_total + " руб.");

                itog_price();
            }
        });
    })

    // корзина плюс
    $('.plus').click(function () {
        var iid = $(this).attr("iid");

        $.ajax({
            type: "POST",
            url: "count-plus.php",
            data: "id=" + iid,
            dataType: "html",
            cache: false,
            success: function (data) {
                $('#plus-minus-input-id' + iid).val(data);
                loadcart();

                var priceproduct = $('#tovar' + iid + ' > span').attr("price");
                result_total = Number(priceproduct) * Number(data);

                $('#tovar' + iid + ' > span').html(result_total + " руб.");
                $('#tovar2' + iid + ' > span').html(result_total + " руб.");

                itog_price();
            }
        });
    })

    // корзина ввод в поле и enter
    $('.count-input').keypress(function (e) {

        if (e.keyCode == 13) {
            var iid = $(this).attr("iid");
            var incount = $("#plus-minus-input-id" + iid).val();

            $.ajax({
                type: "POST",
                url: "count-input.php",
                data: "id=" + iid + "&count=" + incount,
                dataType: "html",
                cache: false,
                success: function (data) {
                    $('#plus-minus-input-id' + iid).val(data);
                    loadcart();

                    var priceproduct = $('#tovar' + iid + ' > span').attr("price");
                    result_total = Number(priceproduct) * Number(data);

                    $('#tovar' + iid + ' > span').html(result_total + " руб.");
                    $('#tovar2' + iid + ' > span').html(result_total + " руб.");

                    itog_price();
                }
            });
        }
    })

    // итоговая цена
    function itog_price() {
        $.ajax({
            type: "POST",
            url: "itog_price.php",
            dataType: "html",
            cache: false,
            success: function (data) {
                $('.itog_price > strong').html(data);
            }
        });
    }

        //закрытие модального окна "забыли пароль?"
        $("#modalReviewForm").on('hide.bs.modal', function () {
            document.getElementById("nameHelpBlock").hidden = true;
            document.getElementById("goodHelpBlock").hidden = true;
            document.getElementById("badHelpBlock").hidden = true;
        });

    // $('#button-send-review').click(function () {
    //     var name = $("#review_modal_name").val();
    //     var good = $("#review_modal_good").val();
    //     var bad = $("#review_modal_bad").val();
    //     var comment = $("#review_modal_comment").val();
    //     var iid = $("#button-send-review").attr("iid");

    //     if(name != "") {
    //         name_review = '1';

    //     }

    //     $.ajax({
    //         type: "POST",
    //         url: "count-plus.php",
    //         data: "id=" + iid,
    //         dataType: "html",
    //         cache: false,
    //         success: function (data) {
    //             $('#plus-minus-input-id' + iid).val(data);
    //             loadcart();

    //             var priceproduct = $('#tovar' + iid + ' > span').attr("price");
    //             result_total = Number(priceproduct) * Number(data);

    //             $('#tovar' + iid + ' > span').html(result_total + " руб.");
    //             $('#tovar2' + iid + ' > span').html(result_total + " руб.");

    //             itog_price();
    //         }
    //     });
    // })
});