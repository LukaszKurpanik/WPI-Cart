<?php
/**
 * This template is used to display the profile editor with [edd_profile_editor]
 */
global $current_user;

if ( is_user_logged_in() ):
	$user_id      = get_current_user_id();
	$first_name   = get_user_meta( $user_id, 'first_name', true );
	$last_name    = get_user_meta( $user_id, 'last_name', true );
	$display_name = $current_user->display_name;
	$address      = get_user_meta( $user_id, '_edd_user_address', true );

	if ( isset( $_GET['updated'] ) && $_GET['updated'] == true && ! edd_get_errors() ): ?>
	<p class="edd_success"><strong><?php _e( 'Success', 'edd'); ?>:</strong> <?php _e( 'Your profile has been edited successfully.', 'edd' ); ?></p>
	<?php endif; edd_print_errors(); ?>
	<form id="edd_profile_editor_form" class="edd_form" action="<?php echo edd_get_current_page_url(); ?>" method="post">
		<fieldset>
			<span><legend><?php _e( 'Change your Name', 'edd' ); ?></legend></span>
			<p id="edd_profile_name_wrap">
				<label for="edd_first_name"><?php _e( 'First Name', 'edd' ); ?></label>
				<input name="edd_first_name" id="edd_first_name" class="text edd-input" type="text" value="<?php echo $first_name; ?>" />
				<br />
				<label for="edd_last_name"><?php _e( 'Last Name', 'edd' ); ?></label>
				<input name="edd_last_name" id="edd_last_name" class="text edd-input" type="text" value="<?php echo $last_name; ?>" />
			</p>
			<p id="edd_profile_display_name_wrap">
				<label for="edd_display_name"><?php _e( 'Display Name', 'edd' ); ?></label>
				<select name="edd_display_name">
					<?php if ( ! empty( $current_user->first_name ) ): ?>
					<option <?php selected( $display_name, $current_user->first_name ); ?> value="<?php echo $current_user->first_name; ?>"><?php echo $current_user->first_name; ?></option>
					<?php endif; ?>
					<option <?php selected( $display_name, $current_user->user_nicename ); ?> value="<?php echo $current_user->user_nicename; ?>"><?php echo $current_user->user_nicename; ?></option>
					<?php if ( ! empty( $current_user->last_name ) ): ?>
					<option <?php selected( $display_name, $current_user->last_name ); ?> value="<?php echo $current_user->last_name; ?>"><?php echo $current_user->last_name; ?></option>
					<?php endif; ?>
					<?php if ( ! empty( $current_user->first_name ) && ! empty( $current_user->last_name ) ): ?>
					<option <?php selected( $display_name, $current_user->first_name . ' ' . $current_user->last_name ); ?> value="<?php echo $current_user->first_name . ' ' . $current_user->last_name; ?>"><?php echo $current_user->first_name . ' ' . $current_user->last_name; ?></option>
					<option <?php selected( $display_name, $current_user->last_name . ' ' . $current_user->first_name ); ?> value="<?php echo $current_user->last_name . ' ' . $current_user->first_name; ?>"><?php echo $current_user->last_name . ' ' . $current_user->first_name; ?></option>
					<?php endif; ?>
				</select>
			</p>
			<p>
				<label for="edd_email"><?php _e( 'Email Address', 'edd' ); ?></label>
				<input name="edd_email" id="edd_email" class="text edd-input required" type="email" value="<?php echo $current_user->user_email; ?>" />
			</p>
			<span><legend><?php _e( 'Change your Billing Address', 'edd' ); ?></legend></span>
			<p id="edd_profile_billing_address_wrap">
				<label for="edd_address_line1"><?php _e( 'Line 1', 'edd' ); ?></label>
				<input name="edd_address_line1" id="edd_address_line1" class="text edd-input" type="text" value="<?php echo $address['line1']; ?>" />
				<br/>
				<label for="edd_address_line2"><?php _e( 'Line 2', 'edd' ); ?></label>
				<input name="edd_address_line2" id="edd_address_line2" class="text edd-input" type="text" value="<?php echo $address['line2']; ?>" />
				<br/>
				<label for="edd_address_city"><?php _e( 'City', 'edd' ); ?></label>
				<input name="edd_address_city" id="edd_address_city" class="text edd-input" type="text" value="<?php echo $address['city']; ?>" />
				<br/>
				<label for="edd_address_state"><?php _e( 'State', 'edd' ); ?></label>
				<input name="edd_address_state" id="edd_address_state" class="text edd-input" type="text" value="<?php echo $address['state']; ?>" />
				<br/>
				<label for="edd_address_zip"><?php _e( 'Zip', 'edd' ); ?></label>
				<input name="edd_address_zip" id="edd_address_zip" class="text edd-input" type="text" value="<?php echo $address['zip']; ?>" />
				<br/>
				<label for="edd_address_country"><?php _e( 'Country', 'edd' ); ?></label>
				<input name="edd_address_country" id="edd_address_country" class="text edd-input" type="text" value="<?php echo $address['country']; ?>" />
			</p>
			<span><legend><?php _e( 'Change your Password', 'edd' ); ?></legend></span>
			<p id="edd_profile_password_wrap">
				<label for="edd_user_pass"><?php _e( 'New Password', 'edd' ); ?></label>
				<input name="edd_new_user_pass1" id="edd_new_user_pass1" class="password edd-input" type="password"/>
				<br />
				<label for="edd_user_pass"><?php _e( 'Re-enter Password', 'edd' ); ?></label>
				<input name="edd_new_user_pass2" id="edd_new_user_pass2" class="password edd-input" type="password"/>
			</p>
			<p class="edd_password_change_notice"><?php _e( 'Please note after changing your password, you must log back in.', 'edd' ); ?></p>
			<p id="edd_profile_submit_wrap">
				<input type="hidden" name="edd_profile_editor_nonce" value="<?php echo wp_create_nonce( 'edd-profile-editor-nonce' ); ?>"/>
				<input type="hidden" name="edd_action" value="edit_user_profile" />
				<input type="hidden" name="edd_redirect" value="<?php echo esc_url( edd_get_current_page_url() ); ?>" />
				<input name="edd_profile_editor_submit" id="edd_profile_editor_submit" type="submit" class="edd_submit" value="<?php _e( 'Save Changes', 'edd' ); ?>"/>
			</p>
		</fieldset>
	</form><!-- #edd_profile_editor_form -->
	<?php
else:
	echo '<p>' . __( 'You need to login to edit your profile.', 'edd' ) . '</p>';
	echo edd_login_form();
endif;
