<?php

// defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wprm_from = $_POST['from'];
$wprm_tomail = $_POST['tomail'];
$wprm_toname = $_POST['toname'];
$wprm_sendylist = $_POST['list'];
$wprm_id = $_POST['id'];
$wprm_forward = $_POST['forward'];

if ( !isset( $from, $tomail, $sendylist, $id, $forward) ) {
	die();
}


$wprm_visitor = new wprm_SendgridMail($from, $tomail, $toname, $sendylist);
$wprm_visitor->loadPost($id);
$wprm_visitor->sendNow();
$wprm_visitor->sendySubscribe();

header("Location: $forward");

?>