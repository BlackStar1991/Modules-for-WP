<?php
/*
Plugin Name: PostModifiedDate
Plugin URI:
Description: Обновление даты модификации
Armstrong: My Plugin.
Author: Pavel Nechushkin
Version: 1.0
Author URI:
*/


function PostModifiedDateInstall()
{

}

function PostModifiedDateUninstall()
{

}

function PostModifiedDateMenu()
{
    add_menu_page('PostModifiedDate', 'PostModifiedDate', 8, __FILE__, 'PostModifiedMenuPage');
}

function PostModifiedMenuPage()
{
    if (!empty($_POST['postID'])) {
        for ($i = 0; $i < count($_POST['postID']); $i++) {
            $postID = (int)$_POST['postID'][$i];
            $new_data = date("Y-m-d H:i:s", strtotime($_POST['new_data'][$i]));
            $post_modified_gmt = get_gmt_from_date($new_data);
            global $wpdb;
            $result = $wpdb->update(
                'wp_posts',
                array(
                    'post_modified' => "$new_data",    // string
                    'post_modified_gmt' => "$post_modified_gmt",    // string
                ),
                array('ID' => $postID),
                array(
                    '%s',    // value1
                    '%s'    // value2
                ),
                array('%d')
            );
        }
    }

    ?>
    <h2 class="bl_postModified__title">Плагин обновления постов и записей</h2>
    <p class="text_error">*Плагин выбирает последнии (по умолчанию, за датой) 50 записей/постов и обновляет их до нужного промежутка времени</p>
    <form class="bl_postModified" method="post">
        <div class="bl_controls">
            <label for="minusDeys">Отнять дней от сегодня</label>
            <input class="js-get-data" id="minusDeys" name="minusDeys" type="number" min="1" step="1" max="100"
                   value="7">
            <label for="posts_per_page">Количество записей</label>
            <input class="js-get-data" id="posts_per_page" name="posts_per_page" type="number" min="1" step="1"
                   max="100" value="50">

            <div class="bl_postModified__all">
                Всего страниц: <span id="count"></span>
            </div>
            <select id="chooseType" class="bl_chooseType js-get-data" title="choose type">
                <option value="all">Все</option>
                <option value="page">Страници</option>
                <option value="post">Записи</option>
            </select>
            <button class="btn_reload" id="btn_reload__all" type="submit">Обновить</button>
        </div>

        <div class="bl_title">Название</div>
        <div class="bl_title">Текущая дата</div>
        <div class="bl_title">Новая дата</div>
        <div id="ResaltsPostModified">
        </div>
    </form>
    <?php
}

function PostModifiedDate_style()
{
    wp_register_script('PostModifiedDateJquery', plugins_url('js/jquery.js', __FILE__), false, false, true);
    wp_enqueue_script('PostModifiedDateJquery');
    wp_register_script('PostModifiedDateScript', plugins_url('js/PostModifiedDateScript.js', __FILE__), false, false, true);
    wp_enqueue_script('PostModifiedDateScript');
    wp_register_style('PostModifiedDateCss', plugins_url('css/PostModifiedDateCss.css', __FILE__));
    wp_enqueue_style('PostModifiedDateCss');
}

add_action('admin_enqueue_scripts', 'PostModifiedDate_style');

add_action('admin_menu', 'PostModifiedDateMenu');
register_activation_hook(__FILE__, 'PostModifiedDateInstall');
register_deactivation_hook(__FILE__, 'PostModifiedDateUninstall');