$(document).ready(function () {

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


    //подтверждение удаления
    $('.delete').click(function () {

        var rel = $(this).attr("rel");

        $.confirm({
            title: 'Подтверждение удаления',
            content: 'После удаления восстановление будет невозможно! Продолжить?',
            buttons: {
                'Да': {
                    btnClass: 'btn-green',
                    action: function () {
                        location.href = rel;
                    }
                },
                'Нет': {
                    btnClass: 'btn-red',
                    action: function () {

                    }
                },
            }
        });

    });

    //удаление категории
    $('.delete-cat').click(function () {

        var selectid = $('#cat option:selected').val();

        $.ajax({
            type: "POST",
            url: "delete-category.php",
            data: "id=" + selectid,
            dataType: "html",
            cache: false,
            success: function (data) {
                if(data == "delete") {
                    $('#cat option:selected').remove();
                }
            }
        });

    });

    //удаление бренда
    $('.delete-bra').click(function () {

        var selectid = $('#bra option:selected').val();

        $.ajax({
            type: "POST",
            url: "delete-brand.php",
            data: "id=" + selectid,
            dataType: "html",
            cache: false,
            success: function (data) {
                if(data == "delete") {
                    $('#bra option:selected').remove();
                }
            }
        });

    });


    $("#admin_phone").mask("+375 (99) 999-99-99");

});