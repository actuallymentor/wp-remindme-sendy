<?php
add_action('admin_head', 'wprm_admin_css');

function wprm_admin_css() {
	?>
	<style>
		.wprm_admin input {
			max-width: 100%;
			width: 300px;
		}
		.wprm_admin textarea {
			max-width: 100%;
			width: 300px;
			height: 50px;
		}
		#wpfooter {
			position: relative;
		}
	</style>
	<?php
}

if ( $_GET['wprm_print'] ) {

	add_action('wp_head', 'wprm_pdf_css');

	function wprm_pdf_css() {
		global $wprm_config;
		echo "<style>" . $wprm_config['printcss'] .  "</style>";
	}
}
?>