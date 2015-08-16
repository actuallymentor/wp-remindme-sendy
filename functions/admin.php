<?php
add_action( 'admin_menu', 'wprm_menu' );

function wprm_menu() {
	add_options_page( 'WPRM Options', 'WPRM', 'manage_options', 'wprm-settings', 'wprm_options' );
	add_action( 'admin_init', 'register_wprm_settings' );
}

function register_wprm_settings() { // whitelist options
	register_setting( 'wprm_settings', 'wprm_sendgriduser' );
	register_setting( 'wprm_settings', 'wprm_sendgridpass' );
	register_setting( 'wprm_settings', 'wprm_sendyurl' );
	register_setting( 'wprm_settings', 'wprm_listid' );
	register_setting( 'wprm_settings', 'wprm_from' );
	register_setting( 'wprm_settings', 'wprm_thankyou' );
	register_setting( 'wprm_settings', 'wprm_signature' );
	register_setting( 'wprm_settings', 'wprm_printcss' );
}

function wprm_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
	<div class="wrap">
		<h2>WPRM - WordPress Remind Me Plugin</h2>
		<p>Here is where the form would go if I actually had options.</p>
		<form class="wprm_admin" id="wprm_form" method="post" action="options.php"> 
			<?php settings_fields( 'wprm_settings' ); ?>
			<?php do_settings_sections( 'wprm_settings' ); ?>
			<p>Sendgrid username:</p>
			<input type="text" name="wprm_sendgriduser" value="<?php echo esc_attr( get_option('wprm_sendgriduser') ); ?>" />
			<p>Sendgrid password:</p>
			<input type="password" name="wprm_sendgridpass" value="<?php echo esc_attr( get_option('wprm_sendgridpass') ); ?>" />
			<p>Sendy installation URL (no trailing slash):</p>
			<input type="text" name="wprm_sendyurl" value="<?php echo esc_attr( get_option('wprm_sendyurl') ); ?>" />
			<p>Sendy list ID:</p>
			<input type="text" name="wprm_listid" value="<?php echo esc_attr( get_option('wprm_listid') ); ?>" />
			<p>From email address:</p>
			<input type="email" name="wprm_from" value="<?php echo esc_attr( get_option('wprm_from') ); ?>" />
			<p>Thank you URL:</p>
			<input type="url" name="wprm_thankyou" value="<?php echo esc_attr( get_option('wprm_thankyou') ); ?>" />
			<p>Email signature (in HTML):</p>
			<textarea form="wprm_form" name="wprm_signature"><?php echo esc_attr( get_option('wprm_signature') ); ?></textarea>
			<p>Print friendly CSS:</p>
			<textarea form="wprm_form" name="wprm_printcss"><?php echo esc_attr( get_option('wprm_printcss') ); ?></textarea>
			<?php submit_button(); ?>
		</form>
	</div>
</div>

<?php
}
?>
