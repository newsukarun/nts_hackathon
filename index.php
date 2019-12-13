<?php
if ( ! is_user_logged_in() ) {
	echo do_shortcode( '[wp_login_form]' );

	return;
}