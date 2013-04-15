<?php
function my_function_admin_bar(){ return false; }
add_filter( 'show_admin_bar' , 'my_function_admin_bar');
if ( function_exists('register_sidebar') ) { register_sidebar(); }

function load_template_scripts() {
	wp_enqueue_script('wp_basalcart_infinitescroll', get_bloginfo('template_directory') . "/js/jquery.infinitescroll.min.js", false, null);
	wp_enqueue_script('wp_basalcart_custom_scripts', get_bloginfo('template_directory') . "/js/custom_scripts.js", false, null);
}
add_action('wp_enqueue_scripts', 'load_template_scripts');
function index_page_custom_post_query($query) {
	if(!is_admin() && $query->is_main_query()) {
		if(is_home() || is_front_page()) {
			$query->set('post_type', array('wp_basalcart_product'));
		}
	}
}
add_action('pre_get_posts', 'index_page_custom_post_query');
?>