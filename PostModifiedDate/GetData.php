<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 19.06.2018
 * Time: 12:34
 */
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');
$type = array('post', 'page');
$posts = 50;
$minusDeys = 7;
$my_posts = new WP_Query;
$count_posts = wp_count_posts('post')->publish;
$count_posts += wp_count_posts('page')->publish;
if (!empty($_POST['Deys'])) {
    $minusDeys = (int)$_POST['Deys'];
}
if (!empty($_POST['posts'])) {
    $posts = (int)$_POST['posts'];
}
if ($_POST['type'] == 'post') {
    $type = array('post');
    $count_posts = wp_count_posts('post')->publish;
}
if ($_POST['type'] == 'page') {
    $type = array('page');
    $count_posts = wp_count_posts('page')->publish;
}
$start_date = date('d.m.Y', mktime(0, 0, 0, date("m"), date("d") - $minusDeys, date("Y")));
$raznica = $minusDeys * 86400;
$myposts = $my_posts->query(
    array(
        'post_type' => $type,
        'post_status' => 'publish',
        'posts_per_page' => $posts,
        'order' => 'ASC',
        'orderby' => 'post_modified_gmt',
    )
);
?>
    <script>
        $('#count').html(<?php echo $count_posts?>);
    </script>
<?php
$rezalt = '<ul id="ResaltsPostModified" class="bl_resalts clearfix">';
foreach ($myposts as $pst) {
    $dobavit = mt_rand(0, $raznica);
    $new_data = date("Y-m-d H:i:s", strtotime($start_date) + $dobavit);
    if (strtotime($pst->post_modified) > strtotime($start_date) ||
        strtotime($pst->post_modified) > strtotime($new_data)) {
        $add = $dobavit = mt_rand(0, 3600);
        $new_data = date("Y-m-d H:i:s", strtotime($pst->post_modified) + $add);
    }
    $rezalt .= '
<li class="bl_resalts__item">
        <span>' . $pst->post_title . '</span>
        <input type="hidden" name="postID[]" value="' . $pst->ID . '">
        <span>' . $pst->post_modified . '</span>
        <span>' . $new_data . '</span>
        <input type="hidden" name="new_data[]" value="' . $new_data . '">
</li>';
}
$rezalt .= '</ul>';
echo $rezalt;
