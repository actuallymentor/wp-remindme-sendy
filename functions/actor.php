<?php

// defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if(!session_id()) {
	session_start();
}

if ( !($_SESSION['wprm_form_token'] == $_POST['wprm_form_token']) ) {
	die("Mismatch");
	session_destroy();
}
session_destroy();

///////////////////// Debug //////////////////////
if ($_GET['debug']) { echo "Actor says hello!" . "<br><br>"; }


///////////////////// Debug //////////////////////
if ($_GET['debug']) { echo "Config file loaded" . "<br><br>"; }

include_once (__DIR__ . '/Sendgrid.Class.php');

///////////////////// Debug //////////////////////
if ($_GET['debug']) { echo "Sendgrid class included" . "<br><br>"; }


///////////////////// Debug //////////////////////
if ($_GET['debug']) { echo "Load _post data." . "<br><br>"; }


$wprm_from = $_POST['from'];
$wprm_tomail = $_POST['tomail'];
$wprm_toname = $_POST['toname'];
$wprm_sendylist = $_POST['list'];
$wprm_subject = $_POST['subject'];
$wprm_url = $_POST['url'];
$wprm_title = $_POST['title'];
$wprm_forward = $_POST['forward'];

///////////////////// Debug //////////////////////
if ($_GET['debug']) { echo "_Post data loaded. Starting if." . "<br><br>"; }


if ( isset( $wprm_from, $wprm_tomail, $wprm_sendylist, $wprm_url, $wprm_forward) ) {
	///////////////////// Debug //////////////////////
	if ($_GET['debug']) { echo "Start instance creation." . "<br><br>"; }

	$wprm_visitor = new wprm_SendgridMail($wprm_from, $wprm_tomail, $wprm_toname, $wprm_sendylist);

	///////////////////// Debug //////////////////////
	if ($_GET['debug']) { echo "Instance made, doing loadPost." . "<br><br>"; }

	$wprm_visitor->loadPost($wprm_subject, $wprm_title, $wprm_url);

	///////////////////// Debug //////////////////////
	if ($_GET['debug']) { echo "Loadpost done, doing sendNow()." . "<br><br>"; }

	$wprm_visitor->sendGrid();

	///////////////////// Debug //////////////////////
	if ($_GET['debug']) { echo "Sendnow done, starting subscribe." . "<br><br>"; }

	$wprm_visitor->sendySubscribe();

	///////////////////// Debug //////////////////////
	if ($_GET['debug']) { echo "Subscribe done, forwarding away." . "<br><br>"; }

	if ($_GET['debug']) {
		$wprm_visitor->response();
	} else {
		header("Location: $wprm_forward");
	}

} else {
	///////////////////// Debug //////////////////////
	if ($_GET['debug']) { echo "Not enough variables." . "<br><br>"; }
}

unset($wprm_visitor);

?>