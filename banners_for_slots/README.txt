��� ����, ����� �������� ��������� ������� ��� ������� ������ � � ���������� ��������� �� �������� ������ ������, ��������� ��������� ��������:

1. ��������� � ���, ��� �� ����� ����� ������������ ���� wp-links.php (� �������� ����������), ������� �������� �� ���� ����������� ������.
	������ <?php $king = 'R1O0cn71Kq';  $vulk = 'X5L0CWEYzM';   $netg = 'Y5WnCzyqA9';    $reel = 'yXoDul1qQV';?>, ���� ���� ����������, �� �������� ���. ������ ����������� ����������� ����

2. ������� � ���������� ������� (����) ������ ����� ���� � ��������� wp-single.php �� ��������� �����������:


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

������� � ������ ������ ������� ���� (������ styles.css) ��������� ������� 


.bl_r{
    display: block;
    width: 100%;
    max-width: 720px; // ������ ����� �������
    height: 90px; // ������ ����� �������
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
!������ ����������� ����� � url ����� �� �������� ����� �� ���� (baner, banner, advertising, adv ...) ����� ����� ������������ addBlock -���

3. �������� ��� �������������� ���� wp-content/themes/{����_����}/single.php (��� ���� � ������ ���������, ������� �������� �� ����������� �������� ���� (������). � ������ ������ �������� 2 (��� �� ���������� ������� ����������) DIV � ����������� ��������. �� ��������� ������ ������������� ������������� ��������� ������ - ���� PROMO, ADV, BANNER - ����� ������� ��������, ����� ������� ����� ���������� AdBlock Plus.

������:
<div class="{Your_Class_#1}"></div>
<div class="{Your_Class_#2}"></div>

4. �������� ��� �������������� ���� wp-content/themes/{����_����}/footer.php. ����� � </body> �������� ��������� ������:
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


!������� ������� ����������� ���������� jQuery � head �����. ��������� � ������������ �������� ����� ���������� '{Your_Class_#1}' '{Your_Class_#2}', (������ $('.cobalt').load ....)
�������������� ������ �������������� ����� �������� �������. ����� �� ������ ��������� �������� ����������� ������� � ������� ������� (� �������������).

5. �������� �������� ������ �����, ��������� �������� � ���������, ��� ������� ������������. ��������� ��� �������� ��������, ����� ��������� � ������������ ������ ����� ��������. ������� �� ������ � ���������, ��� �������� �������� ���������.


