<?php

require 'SendGrid.Class.php';

$from = $_POST['from'];
$tomail = $_POST['tomail'];
$toname = $_POST['toname'];
$sendylist = $_POST['list'];
$id = $_POST['id'];

$visitor = new SendgridMail($from, $tomail, $toname, $sendylist);
$visitor->loadPost($id);
$visitor->sendNow();
$visitor->sendySubscribe();

?>