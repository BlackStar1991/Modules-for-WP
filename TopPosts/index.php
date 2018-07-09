<?php
/*
Plugin Name: Top posts
Text Domain: Top posts
Description: The DiJust plugin's for 50 top posts
Author: Pavel Nechushkin
Author URI: pnechushkin@gmail.com
Version: 1.0
*/


/**
 * Работает на основе мета боксов
 * номер по порядку int с меткой namber_top
 * при отсутсвии метки не участвует в ТОП списке
 */


/**
 * @param $meta_key string
 */
function del_meta_top( $meta_key ) {
	global $wpdb;
	$deleted_rows = $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->postmeta WHERE meta_key = %s", $meta_key ) );
}

/**
 * @return array
 */
function get_ID_in_top() {
	$id        = array();
	$args_top  = array(
		'post_type'  => array( 'post', 'page' ),
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'key' => 'top_place',
			)
		),
		'meta_key'   => 'top_place',
		'orderby'    => 'meta_value_num',
		'order'      => 'ASC'
	);
	$query_top = new WP_Query( $args_top );
	if ( $query_top->have_posts() ) {
		while ( $query_top->have_posts() ) {
			$query_top->the_post();
			$id[] = get_the_ID();
		}
	}
	wp_reset_postdata();

	return $id;
}
add_action('get_ID_in_top', 'get_ID_in_top');
function list_of_top() {
	if ( $_POST ) {
		del_meta_top( 'marker_top' );
		del_meta_top( 'top_place' );
		for ( $i = 0; $i < $_POST['quantity_of_top_post']; $i ++ ) {
			$id_post_top   = $_POST['id_post_top'][ $i ];
			$button_marker = $_POST['button_marker'][ $i ];
			update_post_meta( $id_post_top, 'top_place', $i + 1 );
			if ( $button_marker == 1 ) {
				update_post_meta( $id_post_top, 'marker_top', 1 );
			}
		}
	}
	$all_id_posts = get_ID_in_top();
	$args_all     = array(
		'post_type'      => array( 'post', 'page' ),
		'post_status'    => 'publish',
		'posts_per_page' => - 1,
	);
	$query_all    = new WP_Query( $args_all );
	if ( $query_all->have_posts() ) {
		while ( $query_all->have_posts() ) {
			$query_all->the_post();
			if ( ! in_array( get_the_ID(), $all_id_posts ) ) {
				$all_id_posts[] = get_the_ID();
			}
		}
	}
	wp_reset_postdata();
	?>
    <form method="post">
        <div class="body_list_top">
            <div class="quantity_of_top_post">
                <input id="id_quantity_of_top_post" type="number" name="quantity_of_top_post" step="1" min="1" max="50"
                       value="<?php echo count( get_ID_in_top() ) ?>" required>
                <button class="save_top_list" type="submit">Сохранить</button>
            </div>
            <div class="body_of_top_post">
				<?php
				for ( $i = 0; $i < count( $all_id_posts ); $i ++ ) {
					$id           = $all_id_posts[ $i ];
					$post         = get_post( $id );
					$title        = $post->post_title;
					$text_button  = 'Добавить маркер';
					$value_button = 0;
					$marker_top   = get_post_meta( $id, 'marker_top' )[0];
					if ( $marker_top ) {
						$text_button  = 'Удалить маркер';
						$value_button = 1;
					}
					echo '<div class="top_post_div">' . $title . '
                        <input type="hidden" name="id_post_top[]" value="' . $id . '">
                        <input type="hidden" name="button_marker[]" value="' . $value_button . '">
                        <input type="button" class="button_marker" value="' . $text_button . '">
                        </div>';
				}
				?>
            </div>
        </div>
    </form>
<?php }

function top_posts_install() {


}

function top_posts_uninstall() {

}

add_action( 'admin_enqueue_scripts', function () {
	wp_register_style( 'TopPosts', plugins_url( 'css/Styles.css', __FILE__ ) );
	wp_enqueue_style( 'TopPosts' );
	wp_register_style( 'TopPostsUi', plugins_url( 'css/jquery-ui.css', __FILE__ ) );
	wp_enqueue_style( 'TopPostsUi' );
	wp_register_script( 'TopPostsJquery', plugins_url( 'js/jquery.js', __FILE__ ), false, false, true );
	wp_enqueue_script( 'TopPostsJquery' );
	wp_register_script( 'TopPost', plugins_url( 'js/topposts.js', __FILE__ ), false, false, true );
	wp_enqueue_script( 'TopPost' );
	wp_register_script( 'TopPostUi', plugins_url( 'js/jquery-ui.js', __FILE__ ), false, false, true );
	wp_enqueue_script( 'TopPostUi' );
} );

add_action( 'admin_menu', function () {
	add_menu_page( 'Список ТОП', 'ТОП посты', 8, 'list_of_top', 'list_of_top', 'dashicons-awards' );
} );
register_activation_hook( __FILE__, 'top_posts_install' );
register_deactivation_hook( __FILE__, 'top_posts_uninstall' );
register_uninstall_hook( __FILE__, 'top_posts_uninstall' );
