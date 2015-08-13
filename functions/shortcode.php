<?php
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
?>