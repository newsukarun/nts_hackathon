<?php
/* Template Name: QR Code */
if ( ! is_user_logged_in() ) {
	wp_redirect( home_url() );
}
require __DIR__ . '/inc/QR-CODE/vendor/autoload.php';

use Endroid\QrCode\QrCode;

$qrCode = new QrCode(
	json_encode(
		[
			'user_name'    => wp_get_current_user()->display_name,
			'user_email'   => wp_get_current_user()->user_email,
			'user_is'      => get_current_user_id(),
			'date'         => current_datetime(),
			'employee_id'  => get_field( 'employee_id', 'user_' . get_current_user_id() ),
			'user_package' => get_field( 'meal_courses', 'user_' . get_current_user_id() ),
			'user_package' => get_field( 'phone_number', 'user_' . get_current_user_id() ),
		]
	)
);
header( 'Content-Type: ' . $qrCode->getContentType() );
echo $qrCode->writeString();