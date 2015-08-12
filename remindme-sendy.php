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

// [wprm_remindme]
function wprm_remindme_func(){
	global $wprm_config;
	$actorurl = plugins_url('/functions/actor.php', __FILE__);

	$title = get_the_title(get_the_ID());
	$subject = "Read later: " . $title;
	$wprm_url = get_permalink(get_the_ID());

	//Form spam control and debug declaration
	if(!session_id()) {
        session_start();
    }
	$wprm_form_token = md5(uniqid('auth', true));
	$_SESSION['wprm_form_token'] = $wprm_form_token;
	if ($_GET['debug'] == true) {
		$wprm_debug .= '?debug=true';
	}
	?>
	<form method="POST" action=<?php echo '"' . $actorurl . $wprm_debug . '"'; ?> >
		<input type="text" name="toname" placeholder="Name" />
		<input type="email" name="tomail" placeholder="Email" />
		<input type="text" name="from" value=<?php echo '"' . $wprm_config['from'] .  '"'; ?> hidden>
		<input type="text" name="list" value=<?php echo '"' . $wprm_config['listid'] .  '"'; ?> hidden>
		<input type="text" name="forward" value=<?php echo '"' . $wprm_config['thankyou'] .  '"'; ?> hidden>
		<input type="text" name="subject" value=<?php echo '"' . $subject .  '"'; ?> hidden>
		<input type="text" name="url" value=<?php echo '"' . $wprm_url .  '"'; ?> hidden>
		<input type="text" name="title" value=<?php echo '"' . $title .  '"'; ?> hidden>
		<input type="text" name="wprm_form_token" value=<?php echo '"' . $wprm_form_token .  '"'; ?> hidden>
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