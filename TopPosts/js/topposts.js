window.onload = function () {
    Show_select_top();

    function Show_select_top() {
        var nam = $('#id_quantity_of_top_post').val();
        $(".body_of_top_post").children("div").removeClass('top_post_div_select');
        // $(".body_of_top_post").children("div").children("button").removeProp('disabled');
        for (var i = 0; i < nam; i++) {
            $(".body_of_top_post").children("div").eq(i).addClass('top_post_div_select');
            // $(".body_of_top_post").children("div").eq(i).children("button").removeProp('disabled');
            //    убрать отключенную кнопку
        }


    }

    $('#id_quantity_of_top_post').blur(function () {
        Show_select_top();
    });
    $(".button_marker").submit(function () {
        return false;
    });
    $('.button_marker').click(function () {
        if ($(this).val() == 'Добавить маркер') {
            $(this).val('Удалить маркер')
            if ($(this).prev('input').attr('name') == 'button_marker[]') {
                $(this).prev('input').val(1);
            }
        } else {
            $(this).val('Добавить маркер')
            if ($(this).prev('input').attr('name') == 'button_marker[]') {
                $(this).prev('input').val(0);
            }
        }
    });

    $(".body_of_top_post").sortable({
        revert: true,
        stop: function (event, ui) {

            $(this).val('Добавить маркер');
            if ($(this).prev('input').attr('name') == 'button_marker[]') {
                $(this).prev('input').val(0);
            } Show_select_top()
        }
    });




};