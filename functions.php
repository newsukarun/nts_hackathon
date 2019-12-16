<?php
/**
 * Rest Api End-point.
 */
require_once __DIR__ . '/inc/class-employee-info.php';
require_once __DIR__ . '/inc/class-sms-sender.php';
require_once __DIR__ . '/inc/rest-api/sms/sms-verify.php';

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	show_admin_bar( false );
}

function ntsfood_frontend_scripts() {

	wp_enqueue_script( 'nts-fe', get_stylesheet_directory_uri() . '/assets/js/frontend.js', [ 'jquery' ], false, true );
	wp_localize_script( 'nts-fe', 'ntsfood_endpoints',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'foodcoupon_endpoint' => home_url('wp-json/sms/v1/verify/'),
		)
	);

}
add_action( 'wp_enqueue_scripts', 'ntsfood_frontend_scripts' );

if ( ! function_exists( 'ntsfood_get_coupon_msg' ) ) {
	/**
	 * Message body for food coupons.
	 *
	 * @param \NTSFOOD\Employee $employee_details Employee details.
	 *
	 * @return string
	 */
	function ntsfood_get_coupon_msg( \NTSFOOD\Employee $employee_details ) {
		$meal_course = get_field( 'meal_courses', 'user_' . $employee_details->get_id() );

		return 'Hi ' . $employee_details->first_name . ', Your food coupon code on ' . date_i18n( 'd-m-Y' ) . 'is ' . $meal_course . wp_generate_password( 4, false, false );
	}
}

if ( ! function_exists( 'ntsfood_get_coupon_msg' ) ) {
	/**
	 * Message body for food coupons.
	 *
	 * @param \NTSFOOD\Employee $employee_details Employee details.
	 *
	 * @return string
	 */
	function ntsfood_get_coupon_msg( \NTSFOOD\Employee $employee_details ) {
		$meal_course = get_field( 'meal_courses', 'user_' . $employee_details->get_id() );

		return 'Hi ' . $employee_details->first_name . ', Your food coupon code on ' . date_i18n( 'd-m-Y' ) . 'is ' . $meal_course . wp_generate_password( 4, false, false );
	}
}

