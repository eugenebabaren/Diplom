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

        var rel = $(this).attr("rel");

        $.confirm({
            title: 'Подтверждение удаления',
            content: 'Если удалить эту категорию, удалятся и все товары, связанные с ней! Продолжить?',
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

    //удаление бренда
    $('.delete-bra').click(function () {

        var rel = $(this).attr("rel");

        $.confirm({
            title: 'Подтверждение удаления',
            content: 'Если удалить этот бренд, удалятся и все товары, связанные с ним! Продолжить?',
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

    //добавление input
    var count_input = 1;
    $('#add-input').click(function () {

        count_input++;

        $('<div class="custom-file mb-3" id="addimage' + count_input + '"><div class="row"><input name="MAX_FILE_SIZE" type="hidden" value="5000000"><input name="galleryimg[]" type="file" class="custom-file-input w-75 mr-2" lang="ru" accept="image/jpg,image/jpeg,image/png"><label class="custom-file-label w-75" for="galleryimg">Выберите файл</label><a rel="' + count_input + '" class="delete-input text-danger ml-3 mt-2">Удалить</a></div></div>').fadeIn(300).appendTo('#objects');

    });


    //удаление input
    $('html').on('click', '.delete-input', function () {

        var rel = $(this).attr("rel");

        $("#addimage" + rel).fadeOut(200, function () {
            $("#addimage" + rel).remove();
        });

    });


    // удаление картинки
    $('.del-img').click(function () {
        var img_id = $(this).attr("img_id");
        var title_img = $("#del" + img_id + " > img").attr("title");

        $.ajax({
            type: "POST",
            url: "delete-gallery.php",
            data: "id=" + img_id + "&title=" + title_img,
            dataType: "html",
            cache: false,
            success: function (data) {
                if(data == "delete") {
                    $("#del" + img_id).fadeOut(300);
                }
            }
        });
    })


    $("#admin_phone").mask("+375 (99) 999-99-99");

    

});