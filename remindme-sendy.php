<?php
/**
 * Plugin Name: Send me this article
 * Plugin URI: https://github.com/actuallymentor/wp-remindme-sendy
 * Description: Send a visitor the post they are reading, and subscribe them to sendy.
 * Version: 0.0.1
 * Author: Mentor Palokaj
 * Author URI: https://www.skillcollector.com
 * License: Tweet me for thanks at @ActuallyMentor
 */

// defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wprm_config = include( __DIR__ . '/wprm_vars.php');

include( __DIR__ . '/functions/shortcode.php');

if ( is_admin() ){
	include( __DIR__ . '/functions/admin.php');
}

///////////////////////////
//// General css and js, might not use
///////////////////////////

add_action( 'wp_enqueue_scripts', 'wprm_add_stylesheet_script' );
function wprm_add_stylesheet_script() {
	wp_enqueue_style( 'prefix-style', plugins_url('styles.css', __FILE__) );
	wp_enqueue_style( 'prefix-style', plugins_url('scripts.js', __FILE__) );
}


?>