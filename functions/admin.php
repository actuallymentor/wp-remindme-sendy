<?php
add_action( 'admin_menu', 'wprm_menu' );

function wprm_menu() {
	add_options_page( 'WPRM Options', 'WPRM', 'manage_options', 'wprm-settings', 'wprm_options' );
	add_action( 'admin_init', 'register_wprm_settings' );
}

function register_wprm_settings() { // whitelist options
	register_setting( 'wprm_settings', 'sendgriduser' );
	register_setting( 'wprm_settings', 'sendgridpass' );
	register_setting( 'wprm_settings', 'sendyurl' );
	register_setting( 'wprm_settings', 'listid' );
	register_setting( 'wprm_settings', 'from' );
	register_setting( 'wprm_settings', 'thankyou' );
	register_setting( 'wprm_settings', 'signature' );
}

function wprm_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
	<div class="wrap">
		<h2>WPRM - WordPress Remind Me Plugin</h2>
		<p>Here is where the form would go if I actually had options.</p>
		<form method="post" action="options.php"> 
			<?php settings_fields( 'wprm_settings' ); ?>
			<?php do_settings_sections( 'wprm_settings' ); ?>
			<p>Sendgrid username:</p>
			<input type="text" name="sendgriduser" value="<?php echo esc_attr( get_option('sendgriduser') ); ?>" />
			<p>Sendgrid password:</p>
			<input type="password" name="sendgridpass" value="<?php echo esc_attr( get_option('sendgridpass') ); ?>" />
			<p>Sendy installation URL (no trailing slash):</p>
			<input type="text" name="sendyurl" value="<?php echo esc_attr( get_option('sendyurl') ); ?>" />
			<p>Sendy list ID:</p>
			<input type="text" name="listid" value="<?php echo esc_attr( get_option('listid') ); ?>" />
			<p>From email address:</p>
			<input type="text" name="from" value="<?php echo esc_attr( get_option('from') ); ?>" />
			<p>Thank you URL:</p>
			<input type="text" name="thankyou" value="<?php echo esc_attr( get_option('thankyou') ); ?>" />
			<p>Email signature (in HTML):</p>
			<input type="text" name="signature" value="<?php echo esc_attr( get_option('signature') ); ?>" />
			<?php submit_button(); ?>
		</form>
	</div>
</div>

<?php
}
?>
