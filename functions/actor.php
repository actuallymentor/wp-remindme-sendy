<?php

// defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

array_push($debug_info, "Actor: Loading POST");
$wprm_from = $_POST['from'];
$wprm_tomail = $_POST['tomail'];
$wprm_toname = $_POST['toname'];
$wprm_sendylist = $_POST['list'];
$wprm_id = $_POST['id'];
$wprm_forward = $_POST['forward'];

array_push($debug_info, "Actor: Checking if vars are set");
if ( isset( $wprm_from, $wprm_tomail, $wprm_sendylist, $wprm_id, $wprm_forward) ) {
	array_push($debug_info, "Actor: Vars set, making instance");
	$wprm_visitor = new wprm_SendgridMail($wprm_from, $wprm_tomail, $wprm_toname, $wprm_sendylist);
	array_push($debug_info, "Actor: instance made");
	$wprm_visitor->loadPost($id);
	array_push($debug_info, "Actor: Data loaded");
	$wprm_visitor->sendNow();
	array_push($debug_info, "Actor: Send executed");
	$wprm_visitor->sendySubscribe();
	array_push($debug_info, "Actor: subscribe executed");

	header("Location: $forward");

}

?>