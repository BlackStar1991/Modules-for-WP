<?php
/*
Plugin Name: Casino Table
Text Domain: Casino Table
Description: The DiJust plugin's for generation casino tables
Author: Pavel Nechushkin
Author URI: pnechushkin@gmail.com
Version: 2.0
*/


include 'functions.php';

function ShowTableFront()
{
    $table = new BuildTable();
    return $table;

}

add_action('ShowTableFront', 'ShowTableFront');
add_shortcode('ShowTableFront', 'ShowTableFront');
function casinos_editor()
{

    if ($_POST) {
        global $wpdb;
        $table = $wpdb->prefix . 'casinos';
        $casino = new UpdatCasino();
        $wpdb->query("TRUNCATE `$table`");
        for ($i = 0; $i < count($_POST['name']); $i++) {
            $name = $_POST['name'][$i];
            $hidden_name = $_POST['hidden_name'][$i];
            $sub_name = $_POST['sub_name'][$i];
            $bonus = $_POST['bonus_val'][$i];
            if (!empty($_POST['bonus_desc'][$i])) {
                $bonus .= ',' . $_POST['bonus_desc'][$i];
            }
            $wager = $_POST['wager'][$i];
            $evaluation = $_POST['evaluation'][$i];
            $bonus_type = $_POST['bonus_type'][$i];
            $manufacturers = implode(",", $_POST['manufacturers'][$hidden_name]);
            $currencies = implode(",", $_POST['currencies'][$hidden_name]);
            $casinoURL = $_POST['casinoURL'][$i];
            $casinoButtonName = $_POST['casinoButtonName'][$i];
            $verviewURL = $_POST['verviewURL'][$i];
            $verviewButtonName = $_POST['verviewButtonName'][$i];
            $reviewsURL = $_POST['reviewsURL'][$i];
            $reviewsButtonName = $_POST['reviewsButtonName'][$i];
            $rezalt = $casino->SaveCasino($name, $sub_name, $bonus, $wager, $evaluation, $bonus_type, $manufacturers, $currencies, $casinoURL, $casinoButtonName,
                $verviewURL, $verviewButtonName, $reviewsURL, $reviewsButtonName);
            if ($rezalt === false) {
                echo '<div class="error-message">Произошла ошибка!</div>';
                $wpdb->query("INSERT INTO `$table`
        (`name`, `sub_name`, `bonus`, `wager`, `evaluation`, `bonus_type`, `manufacturers`, `currencies`,`casinoURL`, `casinoButtonName`) 
        VALUES ('name','sub_name','bonus','wager','evaluation','bonus_type','manufacturers','currencies','casinoURL','casinoButtonName')");

            } else {
                if (empty($_FILES['fileImg']["type"][$i])) {
                    continue;
                } elseif ($_FILES['fileImg']["type"][$i] == 'image/jpeg') {
                    $file_type = '.jpg';
                    $file = plugin_dir_path(__FILE__) . 'img/casinos/' . $name . '.png';
                    if (file_exists($file)) {
                        unlink($file);
                    }
                } elseif ($_FILES['fileImg']["type"][$i] == 'image/png') {
                    $file_type = '.png';
                    $file = plugin_dir_path(__FILE__) . 'img/casinos/' . $name . '.jpg';
                    if (file_exists($file)) {
                        unlink($file);
                    }
                } else {
                    echo '<div class="error-message">Не тот формат файла для ' . $name . '!</div>';
                    continue;
                }
                $name_file = '/' . translit($name) . $file_type;
                $destination = plugin_dir_path(__FILE__) . 'img/casinos';
                $fileTempName = $_FILES['fileImg']['tmp_name'][$i];
                if (is_uploaded_file($fileTempName)) {
                    move_uploaded_file($fileTempName, $destination . $name_file);
                } else {
                    echo 'Файл не был загружен на сервер';
                }
            }
        }
        $ShowColumns = $_POST['ShowColumns'];
        $QueueColumn = $_POST['QueueColumn'];
        $table = $wpdb->prefix . 'casinos_setings';
        $wpdb->query("UPDATE `$table` SET `ShowColumns`='$ShowColumns',`QueueColumn`='$QueueColumn'");
    }
    echo new BuildTable('admin');

}


function PartnerIcons()
{
    if ($_POST) {
        if (!empty($_POST['DeletePartner'])) {
            for ($i = 0; $i < count($_POST['DeletePartner']); $i++) {
                $file = $_POST['DeletePartner'][$i];
                $file = plugin_dir_path(__FILE__) . 'img' . DIRECTORY_SEPARATOR . 'slot-icons' . DIRECTORY_SEPARATOR . $file;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
        if (!empty($_POST['NamePartner']) && in_array($_FILES['NewPartner']["type"], ['image/jpeg', 'image/png'])
            && is_uploaded_file($_FILES['NewPartner']['tmp_name'])) {
            $FileName = translit($_POST['NamePartner']);
            $fileType = $_FILES['NewPartner']["type"];
            if ($fileType == 'image/jpeg') {
                $fileType = '.jpg';
            }
            if ($fileType == 'image/png') {
                $fileType = '.png';
            }
            $destination = plugin_dir_path(__FILE__) . 'img' . DIRECTORY_SEPARATOR . 'slot-icons' . DIRECTORY_SEPARATOR;
            if (!move_uploaded_file($_FILES['NewPartner']['tmp_name'], $destination . $FileName . $fileType)) {
                echo '<div class="error-message">Произошла ошибка загрузки файла</div>';
            }
        }
    }
    echo new PartnerIcons();
}

function replacement_styles()
{
    $css_file = plugin_dir_path(__FILE__) . 'css/casino_table_style.css';
    if ($_POST) {
        $css_casino = trim($_POST['css_casino']);
        if (file_exists($css_file) && !empty($css_casino)) {
            file_put_contents($css_file, $css_casino);
        }
    }
    if (file_exists($css_file)) { ?>
        <form method="post">
            <div>Тут можно поменять стили для отображения таблицы казино</div>
            <div>
                <label for="css_casino"></label>
                <textarea rows="30" name="css_casino" id="css_casino"
                          style="width: 100%"><?php echo file_get_contents($css_file) ?></textarea>
            </div>
            <div>
                <button type="submit">Сохранить</button>
            </div>
        </form>
        <?php
    } else {
        echo '<div>айл стилей не обнаружен</div>';
    }
}

function casinos_admin_menu()
{
    add_menu_page('Таблици Казино', 'Таблици Казино', 8, 'casinosTable', 'casinos_editor', 'dashicons-building');
    add_submenu_page('casinosTable', 'Иконки партнеров', 'Иконки партнеров', 8, 'casinosTable/settings', 'PartnerIcons');
    add_submenu_page('casinosTable', 'Отображаемые стили', 'Отображаемые стили', 8, 'casinosTable/styles', 'replacement_styles');

}


function casinos_install()
{

    global $wpdb;
    $table_name = $wpdb->prefix . 'casinos';
    if ($wpdb->get_var("SHOW TABLES LIKE $table_name") != $table_name) {
        $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
         `name` varchar(40) NOT NULL,
         `sub_name` varchar (255) DEFAULT NULL ,
         `bonus` varchar (255) DEFAULT NULL ,
         `wager` INT (25) DEFAULT NULL ,
         `evaluation` varchar (255) DEFAULT NULL ,
         `bonus_type` varchar (255) DEFAULT NULL ,
         `manufacturers` varchar (255) DEFAULT NULL ,
         `currencies` varchar (255) DEFAULT NULL ,
         `casinoURL` varchar(255) NOT NULL,
         `casinoButtonName` varchar(255) NOT NULL,
         `verviewURL` varchar(40) DEFAULT NULL ,
         `verviewButtonName` varchar(40) DEFAULT NULL,
         `reviewsURL` varchar(40) DEFAULT NULL ,
         `reviewsButtonName` varchar(40) DEFAULT NULL,
         PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
        $wpdb->query($sql);
    }
    $wpdb->get_results("SELECT * FROM `$table_name`");
    if ($wpdb->num_rows == 0) {
        $wpdb->query("INSERT INTO `$table_name`
        (`name`, `sub_name`, `bonus`, `wager`, `evaluation`, `bonus_type`, `manufacturers`, `currencies`,`casinoURL`, `casinoButtonName`,`verviewButtonName`,`reviewsButtonName`) 
        VALUES ('Казино1','(Казино Вулкан Украина)','100%','14','10 из 10','Бонус депозит, бонус за выигрыш','manufacturers','currencies','casinoURL','ИГРАТЬ В КАЗИНО','ОБЗОР КАЗИНО','ОСТАВИТЬ ОТЗЫВ')");
    }
    $IconsImageDirectory = plugin_dir_url(__FILE__) . 'img/slot-icons/';
    $CasinosImageDirectory = plugin_dir_url(__FILE__) . 'img/casinos/';
    $ShowColumns = 'name,bonus,wager,evaluation,bonus_type,manufacturers,currencies,buttons';
    $QueueColumn = 'name,bonus,wager,evaluation,bonus_type,manufacturers,currencies,buttons';
    $table_name = $wpdb->prefix . 'casinos_setings';
    if ($wpdb->get_var("SHOW TABLES LIKE $table_name") != $table_name) {
        $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
         `id` int(11) NOT NULL AUTO_INCREMENT,
         `IconsImageDirectory` varchar(100)  NOT NULL ,
         `CasinosImageDirectory` varchar(100)  NOT NULL ,
         `ShowColumns` varchar(100)  NOT NULL ,
         `QueueColumn` varchar(100)  NOT NULL ,
         PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
        $wpdb->query($sql);
        $table_name = $wpdb->prefix . 'casinos_setings';
        $wpdb->get_results("SELECT * FROM `$table_name`");
        if ($wpdb->num_rows == 0) {
            $wpdb->query("INSERT INTO `$table_name` (`IconsImageDirectory`, `CasinosImageDirectory`,`ShowColumns`,`QueueColumn`) 
VALUES ('$IconsImageDirectory', '$CasinosImageDirectory','$ShowColumns','$QueueColumn');");
        }
    }
    add_option('ShowTableFront');
    add_option('opinions_on_page', 5);
}

function casinos_uninstall()
{
    delete_option('options_on_page');
    delete_option('ShowTableFront');
}

function casinos_delete()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'casinos';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
    $table_name_s = $wpdb->prefix . 'casinos_setings';
    $wpdb->query("DROP TABLE IF EXISTS $table_name_s");
}

function CasinoTableStylesAdmin()
{
    wp_register_style('CasinoTable', plugins_url('css/casino_table_style_admin.css', __FILE__));
    wp_enqueue_style('CasinoTable');
    wp_register_script('CasinoTableJquery', plugins_url('js/jquery.js', __FILE__), false, false, true);
    wp_enqueue_script('CasinoTableJquery');
    wp_register_script('CasinoTableAdmin', plugins_url('js/CasinoTableAdmin.js', __FILE__), false, false, true);
    wp_enqueue_script('CasinoTableAdmin');
}

function CasinoTableStylesFront()
{
    wp_register_style('CasinoTable', plugins_url('css/casino_table_style.css', __FILE__));
    wp_enqueue_style('CasinoTable');
    wp_register_script('CasinoTableJquery', plugins_url('js/jquery.js', __FILE__), false, false, true);
    wp_enqueue_script('CasinoTable');
    wp_register_script('CasinoTable', plugins_url('js/CasinoTable.js', __FILE__), false, false, true);
    wp_enqueue_script('CasinoTable');
}

add_action('admin_enqueue_scripts', 'CasinoTableStylesAdmin');
add_action('wp_enqueue_scripts', 'CasinoTableStylesFront');
add_action('admin_menu', 'casinos_admin_menu');
register_activation_hook(__FILE__, 'casinos_install');
register_deactivation_hook(__FILE__, 'casinos_uninstall');
register_uninstall_hook(__FILE__, 'casinos_delete');




