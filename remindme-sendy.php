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

function print_me (  ) {

	?>
	<script>
		document.addEventListener("DOMContentLoaded", function(event) { 
			console.log ( 'PDF timer triggered' ) 
			setTimeout(function(){
				console.log ( 'printing pdf' ); 
				$(location).attr('href', '//pdfcrowd.com/url_to_pdf/?height=-1');
			},3000); });
	</script>
	<?php 

}

if  ( $_GET['wprm_print'] && $wprm_config['downloadpdf'] ) {
	add_action( 'wp_footer', 'print_me' );
}

?>