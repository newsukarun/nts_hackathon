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

$json = json_encode(
	[
		'user_name'    => wp_get_current_user()->display_name,
		'user_email'   => wp_get_current_user()->user_email,
		'user_is'      => get_current_user_id(),
		'date'         => current_datetime(),
		'employee_id'  => get_field( 'employee_id', 'user_' . get_current_user_id() ),
		'user_package' => get_field( 'meal_courses', 'user_' . get_current_user_id() ),
		'user_package' => get_field( 'phone_number', 'user_' . get_current_user_id() ),
	]
);
// Create a basic QR code
$qrCode = new QrCode( $json );
$qrCode->setSize( 300 );
// Set advanced options
$qrCode->setWriterByName( 'png' );
$qrCode->setEncoding( 'UTF-8' );
$qrCode->setErrorCorrectionLevel( ErrorCorrectionLevel::HIGH() );
$qrCode->setForegroundColor( [ 'r' => 0, 'g' => 0, 'b' => 0, 'a' => 0 ] );
$qrCode->setBackgroundColor( [ 'r' => 255, 'g' => 255, 'b' => 255, 'a' => 0 ] );
$qrCode->setLabel( 'Scan the code', 16, null, LabelAlignment::CENTER() );
$qrCode->setLogoPath( __DIR__ . '/inc/QR-CODE/img/logo.png' );
$qrCode->setLogoSize( 50, 50 );
$qrCode->setRoundBlockSize( true );
$qrCode->setValidateResult( false );
$qrCode->setWriterOptions( [ 'exclude_xml_declaration' => true ] );
// Directly output the QR code
header( 'Content-Type: ' . $qrCode->getContentType() );
echo $qrCode->writeString();
// Save it to a file
$qrCode->writeFile( __DIR__ . '/inc/QR-CODE/img/QR/' . get_current_user_id() . '_logo.png' );
// Create a response object
$response = new QrCodeResponse( $qrCode );