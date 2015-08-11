<?php

// defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class wprm_SendgridMail {

	public function __construct($from, $tomail, $toname, $sendylist) {


		///////////////////// Debug //////////////////////
		if ($_GET['debug']) { echo "Start constructor" . "<br><br>"; }

		global $wprm_config;

		///////////////////
		// Stuff to set //
		//////////////////
		$this->url = 'https://api.sendgrid.com/';
		$this->sendy = 'https://www.skillcollector.com/sendy/subscribe';
		$user = $wprm_config['sendyuser'];
		$pass = $wprm_config['sendypass']; // Yeah, I know, they really should start using API keys

		///////////////////// Debug //////////////////////
		if ($_GET['debug']) { echo "Variables including config array loaded" . "<br><br>"; }

		$this->params = array(
			'api_user'  => $user,
			'api_key'   => $pass,
			'to'        => $tomail,
			'from'      => $from,
			);

		///////////////////// Debug //////////////////////
		if ($_GET['debug']) { echo "Sendgrid params loaded." . "<br><br>"; }

		$this->subscribe = array(
			'name'      => $toname,
			'email'     => $tomail,
			'list'      => $sendylist,
			'boolean'   => true,
			);

		///////////////////// Debug //////////////////////
		if ($_GET['debug']) { echo "Sendy subscribe array loaded." . "<br><br>"; }

	}

	public function inputData($subject, $html, $text) {
		$this->params = array(
			'subject'   => $subject,
			'html'      => $html,
			'text'      => $text,
			);
	}

	public function loadPost($subject, $title, $url) {

		$content = 'Hello ' . this->params['name'] . ', <br><br> You asked to be reminded to read the following post: <a href="' . $url . '">' . $title . '.<br><br>If you did not request this email, someone else did it in your name. You can sinply ignore this. <br> <br> Thanks for enjoying skillcollector.com! <br><br>' . $wprm_config['signature'];
		$this->params = array(
			'subject'   => $subject,
			'html'      => $content,
			'text'      => '',
			);

		///////////////////// Debug //////////////////////
		if ($_GET['debug']) { echo "Post load params loaded." . "<br><br>"; }

		$this->subscribe = array(
			'remindme'  => $title,
			);

		///////////////////// Debug //////////////////////
		if ($_GET['debug']) { echo "Subscribe title remindme loaded." . "<br><br>"; }


	}

	public function sendNow() {
		$request =  $this->url.'api/mail.send.json';

		///////////////////// Debug //////////////////////
		if ($_GET['debug']) { echo "Starting curl request." . "<br><br>"; }

		// Generate curl request
		$session = curl_init($request);
		// Tell curl to use HTTP POST
		curl_setopt ($session, CURLOPT_POST, true);
		// Tell curl that this is the body of the POST
		curl_setopt ($session, CURLOPT_POSTFIELDS, $this->params);
		// Tell curl not to return headers, but do return the response
		curl_setopt($session, CURLOPT_HEADER, false);
		// Tell PHP not to use SSLv3 (instead opting for TLS)
		curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

		///////////////////// Debug //////////////////////
		if ($_GET['debug']) { echo "Prepare execution." . "<br><br>"; }

		// obtain response
		$this->response = curl_exec($session);
		curl_close($session);

		///////////////////// Debug //////////////////////
		if ($_GET['debug']) { echo "Curl executed" . "<br><br>"; }

	}

	public function sendySubscribe() {
		$request =  $this->sendy;


		///////////////////// Debug //////////////////////
		if ($_GET['debug']) { echo "Starting curl request." . "<br><br>"; }


		// Generate curl request
		$session = curl_init($request);
		// Tell curl to use HTTP POST
		curl_setopt ($session, CURLOPT_POST, true);
		// Tell curl that this is the body of the POST
		curl_setopt ($session, CURLOPT_POSTFIELDS, $this->subscribe);
		// Tell curl not to return headers, but do return the response
		curl_setopt($session, CURLOPT_HEADER, false);
		// Tell PHP not to use SSLv3 (instead opting for TLS)
		curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

		///////////////////// Debug //////////////////////
		if ($_GET['debug']) { echo "Prepare execution." . "<br><br>"; }

		// obtain response
		$this->response = curl_exec($session);
		curl_close($session);

		///////////////////// Debug //////////////////////
		if ($_GET['debug']) { echo "Curl executed" . "<br><br>"; }
		
	}

	public function response() {
		print_r($this->response);
	}



}
?>