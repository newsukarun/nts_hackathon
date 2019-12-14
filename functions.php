<?php
/**
 * Rest Api End-point.
 */
if ( file_exists( __DIR__ . '/inc/rest-api/sms/sms-verify.php' ) ) {
	require_once __DIR__ . '/inc/rest-api/sms/sms-verify.php';
}

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	show_admin_bar( false );
}

if ( ! function_exists( 'nts_food_coupon_sms' ) ) {

	function nts_food_coupon_sms(  ) {

		$msg = '';


	}
}