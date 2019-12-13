<?php
/* Template Name: QR Code */
if ( ! is_user_logged_in() ) {
	wp_redirect( home_url() );
}
require __DIR__ . '/inc/QR-CODE/vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\Response\QrCodeResponse;

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

$qrCode->setWriterByName('png');
$qrCode->setMargin(10);
$qrCode->setEncoding('UTF-8');
$qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH());
$qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 1]);

header( 'Content-Type: ' . $qrCode->getContentType() );
echo $qrCode->writeString();