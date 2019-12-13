<?php
/* Template Name: QR Code */
if ( ! is_user_logged_in() ) {
	wp_redirect( home_url() );
}
require __DIR__ . '/inc/QR-CODE/vendor/autoload.php';

use Endroid\QrCode\QrCode;

$qrCode = new QrCode( json_encode( ['user_name' => 'Arun'] ) );
header( 'Content-Type: ' . $qrCode->getContentType() );
echo $qrCode->writeString();