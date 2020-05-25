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

});