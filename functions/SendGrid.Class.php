<?php

// defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class wprm_SendgridMail {


	public function __construct($from, $tomail, $toname, $sendylist) {

		///////////////////
		// Stuff to set //
		//////////////////
		$this->url = 'https://api.sendgrid.com/';
		$this->sendy = 'https://www.skillcollector.com/sendy/subscribe';
		$this->signature = "<br><br>Enjoy reading!<br><br>Mentor Palokaj<br>https://www.skillcollector.com";
		$user = $wprm_config['sendyuser'];
		$pass = $wprm_config['sendypass']; // Yeah, I know, they really should start using API keys
		array_push($debug_info, "Constructor: Variables set");


		$this->params = array(
			'api_user'  => $user,
			'api_key'   => $pass,
			'to'        => $tomail,
			'from'      => $from,
			);

		array_push($debug_info, "Constructor: Sendparams loaded");

		$this->subscribe = array(
			'name'      => $toname,
			'email'     => $tomail,
			'list'      => $sendylist,
			'boolean'   => true,
			);

		array_push($debug_info, "Constructor: Subscribe params loaded");
	}

	public function inputData($subject, $html, $text) {
		$this->params = array(
			'subject'   => $subject,
			'html'      => $html,
			'text'      => $text,
			);
	}

	public function loadPost($postid) {

		array_push($debug_info, "loadPost: starting content load");
		$title = get_the_title($postid);
		$subject = "Read later: " . $title;
		$content_post = get_post($postid);
		$content = $content_post->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		$content .= $this->signature;

		array_push($debug_info, "loadPost: content loaded");

		$this->params = array(
			'subject'   => $subject,
			'html'      => $content,
			'text'      => $text,
			);
		array_push($debug_info, "loadPost: send params set");

		$this->subscribe = array(
			'remindme'  => $title,
			);
		array_push($debug_info, "loadPost: Subscribe params set");
	}

	public function sendNow() {

		array_push($debug_info, "sendNow: starting request");
		$request =  $this->url.'api/mail.send.json';

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

		// obtain response
		$this->response = curl_exec($session);
		curl_close($session);
		array_push($debug_info, "sendnow: Request completed");
	}

	public function sendySubscribe() {

		array_push($debug_info, "sendySubscribe: Starting request");
		$request =  $this->sendy;

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

		// obtain response
		$this->response = curl_exec($session);
		curl_close($session);
		array_push($debug_info, "sendySubscribe: Request completed");
	}

	public function response() {
		print_r($this->response);
	}



}
?>