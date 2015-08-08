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

if ( ! defined( 'ABSPATH' ) ) exit;

// [remindme]
function remindme_func(){
	$actorurl = plugins_url('functions/actor.php', __FILE__);
	?>
	<form action=<?php echo '"' . $actorurl . '"' ?> >
		<input type="text" name="toname" placeholder="Name" />
		<input type="email" name="tomail" placeholder="Email" />
		<input type="text" name="from" value="YOUREMAIL" hidden>
		<input type="text" name="list" value="LISTIID" hidden>
		<input type="text" name="id" value=<?php echo get_the_ID(); ?> hidden>
		<input type="submit" value="Save to mail">
	</form>
	<?php
}
add_shortcode( 'remindme', 'remindme_func' );

// Add styles and script

add_action( 'wp_enqueue_scripts', 'add_stylesheet_script' );
function add_stylesheet_script() {
	wp_enqueue_style( 'prefix-style', plugins_url('styles.css', __FILE__) );
	wp_enqueue_style( 'prefix-style', plugins_url('scripts.js', __FILE__) );
}


?>