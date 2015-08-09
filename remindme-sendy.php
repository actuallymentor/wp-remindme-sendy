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

// Turns WordPress debugging on
define('WP_DEBUG', true);

// Tells WordPress to log everything to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);

// Doesn't force the PHP 'display_errors' variable to be on
define('WP_DEBUG_DISPLAY', false);

// Hides errors from being displayed on-screen
@ini_set('display_errors', 0);

// defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once (__DIR__ . '/functions/Sendgrid.Class.php');
require_once (__DIR__ . '/functions/actor.php');

// [remindme]
function wprm_remindme_func(){
	$actorurl = plugins_url('/remindme-sendy.php', __FILE__);
	?>
	<form action=<?php echo '"' . $actorurl . '"' ?> >
		<input type="text" name="wprm_toname" placeholder="Name" />
		<input type="email" name="wprm_tomail" placeholder="Email" />
		<input type="text" name="wprm_from" value="YOUREMAIL" hidden>
		<input type="text" name="wprm_list" value="LISTIID" hidden>
		<input type="text" name="wprm_forward" value="thanks.html" hidden>
		<input type="text" name="wprm_id" value=<?php echo get_the_ID(); ?> hidden>
		<input type="submit" name="wprm_submit" value="Save to mail">
	</form>
	<?php
}
add_shortcode( 'wprm_remindme', 'wprm_remindme_func' );

// Add styles and script

add_action( 'wp_enqueue_scripts', 'wprm_add_stylesheet_script' );
function wprm_add_stylesheet_script() {
	wp_enqueue_style( 'prefix-style', plugins_url('styles.css', __FILE__) );
	wp_enqueue_style( 'prefix-style', plugins_url('scripts.js', __FILE__) );
}


?>