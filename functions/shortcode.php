<?php
// [wprm_remindme]
function wprm_remindme_func(){
	global $wprm_config;
	$title = get_the_title(get_the_ID());
	$subject = "Read later: " . $title;
	$wprm_url = get_permalink(get_the_ID());
	$wprm_url .= '?wprm_print=true';
	$actorurl = '?wprm_done=true';

	//Form spam control and debug declaration
	if(!session_id()) {
		session_start();
	}
	$wprm_form_token = md5(uniqid('auth', true));
	$_SESSION['wprm_form_token'] = $wprm_form_token;
	if ($_GET['debug'] == true) {
		$actorurl .= '&debug=true';
	}

	$wprm_return = 	'<form id="wprm_form" method="POST" action="' . $actorurl . '">
	<!-- <input type="text" name="toname" placeholder="Name" /> -->
	<input id="wprmemail" type="email" name="tomail" placeholder="Email" />
	<input type="text" name="wprm_remindme" value="true" hidden />
	<input type="text" name="from" value="' . $wprm_config['from'] . '" hidden>
	<input type="text" name="list" value="'. $wprm_config['listid'] .  '" hidden>
	<input type="text" name="forward" value="' . $wprm_config['thankyou'] .  '" hidden>
	<input type="text" name="subject" value="' . $subject .  '" hidden>
	<input type="text" name="url" value="' . $wprm_url .  '" hidden>
	<input type="text" name="title" value="' . $title .  '" hidden>
	<input type="text" name="wprm_form_token" value="' . $wprm_form_token .  '" hidden>
	<input class="btn" id="wprm_submit" type="submit" name="submit" value="Send PDF">
	</form>';

if ( isset($_POST['wprm_remindme'])) {
	$wprm_return = '<a name="wprm_done"></a><br><br><h3>Your reminder has been sent!</h3>';
}


return $wprm_return;

}
add_shortcode( 'wprm_remindme', 'wprm_remindme_func' );
?>