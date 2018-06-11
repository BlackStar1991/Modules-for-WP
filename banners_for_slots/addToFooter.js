 $(document).ready(function () {

        var abort_load = function () {
            $('{Your_Class_#1}').load('<?= get_bloginfo("template_url"); ?>/wp-single.php');
        };
        var success_load = function () {
            $('{Your_Class_#2}').load('<?= get_bloginfo("template_url"); ?>/wp-single.php');
        };

        setTimeout(abort_load, 2500);   // Время через которое появиться 1-й 
        setTimeout(success_load, 4000); // Время через которое появиться 2-й 


        $('body').on('click', '[data-href]', function (e) {  /// Добавить данный запрос если, ещё нету.
            window.open($(this).data('href'));
            e.preventDefault();
        });
    });