<?php
/**
 * Plugin Name: Empty Plugin
 * Plugin URI: https://github.com/actuallymentor/empty-wordpress-plugin
 * Description: Empty plugin template.
 * Version: 0.0.0
 * Author: Mentor Palokaj
 * Author URI: https://www.skillcollector.com
 * License: MIT
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class SendgridMail() {


	public function __construct($from, $tomail, $sendylist) {

		///////////////////
		// Stuff to set //
		//////////////////
		$this->url = 'https://api.sendgrid.com/';
		$this->sendy = 'https://www.skillcollector.com/sendy/subscribe';
		$this->signature = "<br><br>Enjoy reading!<br><br>Mentor Palokaj<br>https://www.skillcollector.com";
		$user = SENDGRIDUSER;
		$pass = SENDGRIDPASS; // Yeah, I know, they really should start using API keys


		$this->params = array(
			'api_user'  => $user,
			'api_key'   => $pass,
			'to'        => $tomail,
			'from'      => $from,
			);

		$this->subscribe = array(
			'name'        => $tomail,
			'email'   => $tomail,
			'list'      => $sendylist,
			'boolean'      => true,
,			);
	}

	public function inputData($subject, $html, $text) {
		$this->params = array(
			'subject'   => $subject,
			'html'      => $html,
			'text'      => $text,
			);
	}

	public function loadPost($postid) {

		$title = get_the_title($postid);
		$subject = "Read later: " . $title;
		$content_post = get_post($postid);
		$content = $content_post->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		$content .= $this->signature;

		$this->params = array(
			'subject'   => $subject,
			'html'      => $content,
			'text'      => $text,
			);
		$this->subscribe = array(
			'remindme'  => $title,
			);
	}

	public function sendNow() {

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
	}

	public function sendySubscribe($name, $email, $list) {

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
	}

	public function response() {
		print_r($this->response);
	}



}

// Add styles and script

add_action( 'wp_enqueue_scripts', 'add_stylesheet_script' );
function add_stylesheet_script() {
	wp_enqueue_style( 'prefix-style', plugins_url('styles.css', __FILE__) );
	wp_enqueue_style( 'prefix-style', plugins_url('scripts.js', __FILE__) );
}


?>