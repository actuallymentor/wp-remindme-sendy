<?php
/**
 * Plugin Name: Send me this article
 * Plugin URI: https://github.com/actuallymentor/wp-remindme-sendy
 * Description: Send a visitor the post they are reading, and subscribe them to sendy.
 * Version: 0.0.1
 * Author: Mentor Palokaj
 * Author URI: https://www.skillcollector.com
 * License: Tweet me for thanks at @ActuallyMentor
 */

// defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$wprm_config = include( __DIR__ . '/wprm_vars.php');

include( __DIR__ . '/functions/shortcode.php');

include( __DIR__ . '/functions/actor.php');

if ( is_admin() ){

	/////////////////////////
	//// options page
	/////////////////////////
	include( __DIR__ . '/functions/admin.php');
}

////////////////
//// Admin and print css
////////////////

include( __DIR__ . '/functions/css.php');

if  ( $_GET['wprm_print'] && $wprm_config['downloadpdf'] ) {
	?>
	<script>
		$(document).ready(function(){
			setInterval(function(){
				window.location='//pdfcrowd.com/url_to_pdf/?height=-1';
			},3000); });
	</script>
	<?php 
}

?>