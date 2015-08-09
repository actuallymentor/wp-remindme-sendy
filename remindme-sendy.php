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


/////////////////////////
//// Debug
/////////////////////////

$debug_info = array("Debug initiated", "JS Debug");

function debug_to_console($data) {
	if( is_array($data) || is_object($data) ) {
		echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
	} else {
		echo("<script>console.log('PHP: ".$data."');</script>");
	}
} 


///////////////////////
//// Active parts
//////////////////////

// defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wprm_config = include( __DIR__ . '/wprm_vars.php');
array_push($debug_info, "sendgrid vars loaded");

include_once (__DIR__ . '/functions/Sendgrid.Class.php');
array_push($debug_info, "Loaded sendgrid class");

include_once (__DIR__ . '/functions/actor.php');
array_push($debug_info, "Loaded actor");

if ( $_GET['debug'] ) {
	debug_to_console($debug_info);
}

// [wprm_remindme]
function wprm_remindme_func(){
	global $wprm_config;
	$actorurl = plugins_url('/remindme-sendy.php', __FILE__);
	?>
	<form method="POST" action=<?php echo '"' . $actorurl . '"' ?> >
		<input type="text" name="toname" placeholder="Name" />
		<input type="email" name="tomail" placeholder="Email" />
		<input type="text" name="from" value=<?php echo '"' . $wprm_config['from'] .  '"'; ?> hidden>
		<input type="text" name="list" value=<?php echo '"' . $wprm_config['listid'] .  '"'; ?> hidden>
		<input type="text" name="forward" value=<?php echo '"' . $wprm_config['thankyou'] .  '"'; ?> hidden>
		<input type="text" name="id" value=<?php echo get_the_ID(); ?> hidden>
		<input type="submit" name="submit" value="Save to mail">
	</form>
	<?php
}
add_shortcode( 'wprm_remindme', 'wprm_remindme_func' );


///////////////////////////
//// General css and js, might not use
///////////////////////////

add_action( 'wp_enqueue_scripts', 'wprm_add_stylesheet_script' );
function wprm_add_stylesheet_script() {
	wp_enqueue_style( 'prefix-style', plugins_url('styles.css', __FILE__) );
	wp_enqueue_style( 'prefix-style', plugins_url('scripts.js', __FILE__) );
}


?>