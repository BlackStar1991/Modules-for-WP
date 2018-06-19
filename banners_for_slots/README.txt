Для того, чтобы вставить рекламные баннера без внешних ссылок и с отложенной загрузкой на страницы своего сайтов, выполните следующие операции:

1. Убедитесь в том, что на вашем сайте присутствует файл wp-links.php (в корневой директории), который отвечает за ваши реферальные ссылки.
	Пример <?php $king = 'R1O0cn71Kq';  $vulk = 'X5L0CWEYzM';   $netg = 'Y5WnCzyqA9';    $reel = 'yXoDul1qQV';?>, если фаил отсуцтвует, то создайте его. Указав необходимые реферальные коды

2. Залейте в директорию шаблона (темы) вашего сайта файл с названием wp-single.php со следующим содержанием:


<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: " . date("r"));

if (file_exists($_SERVER['DOCUMENT_ROOT'].'/wp-links.php') == true) {
    include ($_SERVER['DOCUMENT_ROOT'].'/wp-links.php');
}
else{
	$king = ''; $vulk = '';	$netg = ''; $reel = '';
}
$path = "https://skitless.com/upld/2018/";
$banner = array(
'<a href="#" class="bl_r bl_r1"  data-href="http://kg.searchmirrors.com/?refcode='.$king.'"></a>',
'<a href="#" class="bl_r bl_r2"  data-href="http://vlk.searchmirrors.com?refcode='.$vulk.'"></a>',
'<a href="#" class="bl_r bl_r3"  data-href="http://ng.searchmirrors.com/?refcode='.$netg.'"></a>',
'<a href="#" class="bl_r bl_r4"  data-href="http://reelem.searchmirrors.com/?refcode='.$reel.'"></a>'
);

echo $banner[rand(0,3)];
?>

Таблицу с вашими общими стилями темы (обычно styles.css) дополняем стилями 


.bl_r{
    display: block;
    width: 100%;
    max-width: 720px; // ширина ваших банеров
    height: 90px; // высота ваших банеров
    background-size: contain;
    background-repeat: no-repeat;
   
}
.bl_r1{
    background-image: url("https://skitless.com/upld/2018/20181.gif"); // king
}
.bl_r2{
    background-image: url("https://skitless.com/upld/2018/20182.gif"); // vulk
}
.bl_r3{
    background-image: url("https://skitless.com/upld/2018/20183.gif"); // netg
}
.bl_r4{
    background-image: url("https://skitless.com/upld/2018/20184.gif"); // reel
}

//////////
!Будьте внимательны чтобы в url адрес не содержал слова по типу (baner, banner, advertising, adv ...) иначе будут блокироватся addBlock -ами

3. Откройте для редактирования файл wp-content/themes/{ВАША_ТЕМА}/single.php (или файл с другим названием, который отвечает за отображение страницы игры (Записи). В нужных местах вставьте 2 (или то количество которое необходимо) DIV с уникальными классами. Не называйте классы общепринятыми обозначениями рекламных блоков - типа PROMO, ADV, BANNER - лучше набором символов, иначе баннера будут зарезаться AdBlock Plus.

Пример:
<div class="{Your_Class_#1}"></div>
<div class="{Your_Class_#2}"></div>

4. Откройте для редактирования файл wp-content/themes/{ВАША_ТЕМА}/footer.php. Ближе к </body> вставьте следующий скрипт:
<script>
window.onload = function (){

        var abort_load = function () {
            $('{Your_Class_#1}').load('<?= get_bloginfo("template_url"); ?>/wp-single.php');
        };
        var success_load = function () {
            $('{Your_Class_#2}').load('<?= get_bloginfo("template_url"); ?>/wp-single.php');
        };

        setTimeout(abort_load, 2500);   
        setTimeout(success_load, 4000); 


        $('body').on('click', '[data-href]', function (e) { 
            window.open($(this).data('href'));
            e.preventDefault();
        });
   }
</script>


!Скрипты требуют подключения библиотеки jQuery в head сайта. Убедитесь в правильности названия ваших переменных '{Your_Class_#1}' '{Your_Class_#2}', (пример $('.cobalt').load ....)
Отредактируйте скрипт соответственно ваших названий классов. Также вы можете выставить таймауты отображения первого и второго баннера (в миллисекундах).

5. Откройте страницы вашего сайта, дождитесь таймаута и убедитесь, что баннера отображаются. Несколько раз обновите страницу, чтобы убедиться в корректности работы смены баннеров. Нажмите на баннер и убедитесь, что редирект работает корректно.


