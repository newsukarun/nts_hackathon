<?php
if ( ! is_user_logged_in() ) {
	do_shortcode( '[wp_login_form]' );

	return;
}