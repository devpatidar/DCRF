<?php
/**
 * Custom login form functions
 */


/**
 * Login form on reload
 */
// Shortcode for login [dcrf_login_form title=login]
add_shortcode( 'dcrf_user_settings', 'dcrf_user_settings_shortcode' );

function dcrf_user_settings_shortcode( $atts ) {

	$atts = shortcode_atts( array(
		'title'     => get_the_title(),
	), $atts, 'dcrf_login_form' );

    // User Profile Visible
	if (isset($_POST['dcrf_profile_visible_btn']) && isset($_POST['profile_visible'])) {

		$current_user_data  = dcrf_get_current_user_data();
		$crrnt_user_id      = $current_user_data->ID;

		$profile_visible     = (isset($_POST['profile_visible'])) ? $_POST['profile_visible'] : '';

        // Update User meta
		update_user_meta($crrnt_user_id, 'profile_visible', $profile_visible);

		dcrf_add_wp_errors('udpi_sucess_update', '<div class="alert alert-success"><div class="alert_icon"><i class="icon-check"></i></div><div class="alert_wrapper"> Settings Saved</div><a href="#" class="close"><i class="icon-cancel"></i></a></div>');
	}
	?>
	<div class="row">
		<div class="col-md-6">
			<?php echo dcrf_get_error_messages('udpi_sucess_update'); ?>
			<div class="dcrf_change_password_wrap">
				<h5 class="title"> Visibility </h5>
				<div class="row">
					<form method="POST" action="">
						<div class="col-sm-12">
							<label> Make profile visible </label>
						</div>
						<div class="col-sm-12">
							<?php $profile_visible = dcrf_current_user_meta('profile_visible'); ?>
							<div class="btn-group" data-toggle="buttons">
								<label class="btn btn-primary <?php echo (empty($profile_visible)) ?'active':''; ?> <?php echo ($profile_visible =='yes') ?'active':''; ?>">
									<input type="radio" name="profile_visible" autocomplete="off" <?php echo ($profile_visible =='yes') ?'checked':'';?> value="yes"> Visible
								</label>
								<label class="btn btn-primary <?php echo ($profile_visible =='no') ?'active':'';?>">
									<input type="radio" name="profile_visible" <?php echo ($profile_visible =='no') ?'checked':'';?> autocomplete="off" value="no"> Hide
								</label>
							</div>
						</div>

						<div class="col-md-12 pb-4 pt-4">
							<input type="submit" name="dcrf_profile_visible_btn" class="btn btn-primary" value="Save Settings">
						</div>
					</form>

				</div>
			</div>
		</div>
		<div class="col-md-6">
			<?php echo do_shortcode('[dcrf_change_password]'); ?>
		</div>
	</div>

	<?php
}    