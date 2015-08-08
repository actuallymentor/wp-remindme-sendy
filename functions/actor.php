<?php

require 'SendGrid.Class.php';

$from = $_POST['from'];
$tomail = $_POST['tomail'];
$sendylist = $_POST['list'];
$id = $_POST['id'];

$visitor = new SendgridMail($from, $tomail, $sendylist);
$visitor->loadPost($id);
$visitor->sendNow();
$visitor->sendySubscribe();

?>