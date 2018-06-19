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
    $minusDeys = 7;
    if (!empty($_POST['postID'])) {
        for ($i = 0; $i < count($_POST['postID']); $i++) {
            $postID = (int)$_POST['postID'][$i];
            $new_data = date("Y-m-d H:i:s", strtotime($_POST['new_data'][$i]));
            $post_modified_gmt = gmdate("Y-m-d H:i:s", strtotime($new_data));
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
    $start_date = date('d.m.Y', mktime(0, 0, 0, date("m"), date("d") - $minusDeys, date("Y")));
    $raznica = $minusDeys * 86400;
    // создаем экземпляр
    $my_posts = new WP_Query;
// делаем запрос
    $myposts = $my_posts->query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '50',
        'order' => 'ASC',
        'orderby' => 'post_modified_gmt',
    ));
    ?>

    <style>

        .bl_postModified {
            display: inline-block;
            width: 100%;
            font-family: Roboto, sans-serif;
        }

        .bl_postModified__title {
            font-size: 28px;
        }

        .bl_title {
            width: 100%;
            max-width: 150px;
            display: inline-block;
            border: 1px solid #000;
            font-size: 18px;
            text-align: center;
        }

        .bl_resalts {
            display: block;
            width: 100%;
            max-width: 500px;
        }

        .text_error {
            color: #f00;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        .bl_resalts__item span {
            width: 150px;
            border-bottom: 1px solid #000;
        }

        .btn_reload {
            vertical-align: top;
            float: right;
            width: 100px;
            height: 40px;
            cursor: pointer;
            background-color: #1162ab;
            border-radius: 4px;
            color: #fff;
        }

        .btn_reload:hover,
        .btn_reload:focus {
            background-color: #1381c0;
            transition: all .2s;
        }

        .bl_chooseType {
            float: right;
            width: 100px;
            border: 1px solid #000;
        }

    </style>

    <h2 class="bl_postModified__title">Плагин обновления постов и записей</h2>
    <p class="text_error">*Плагин выбирает последнии(по дате) 50 записей/постов</p>

    <form class="bl_postModified" method="post">
        <button class="btn_reload" id="btn_reload__all" type="submit">Обновить ВСЁ!</button>
        <button class="btn_reload" id="btn_reload" type="submit">Обновить 50</button>

        <select class="bl_chooseType" title="choose type">
            <option>Страници</option>
            <option>Записи</option>
        </select>


        <div class="bl_title">title</div>
        <div class="bl_title">modified</div>
        <div class="bl_title">new_data</div>
        <ul class="bl_resalts clearfix">
            <?php
            foreach ($myposts as $pst) {
                $dobavit = mt_rand(0, $raznica);
                $new_data = date("Y-m-d H:i:s", strtotime($start_date) + $dobavit);
                if (strtotime($pst->post_modified) > strtotime($start_date) ||
                    strtotime($pst->post_modified) > strtotime($new_data)) {
                    $add = $dobavit = mt_rand(0, 3600);
                    $new_data = date("Y-m-d H:i:s", strtotime($pst->post_modified) + $add);
                }
                ?>
                <li class="bl_resalts__item">
                    <span><?php echo $pst->post_title ?></span>
                    <input type="hidden" name="postID[]" value="<?php echo $pst->ID ?>">
                    <span><?php echo $pst->post_modified ?></span>
                    <span><?php echo $new_data ?></span>
                    <input type="hidden" name="new_data[]" value="<?php echo $new_data ?>">
                </li>
                <?php
            } ?>
        </ul>

    </form>

    <?php
}

add_action('admin_menu', 'PostModifiedDateMenu');
register_activation_hook(__FILE__, 'PostModifiedDateInstall');
register_deactivation_hook(__FILE__, 'PostModifiedDateUninstall');