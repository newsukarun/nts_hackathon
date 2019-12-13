<?php
/**
 * Rest Api End-point.
 */
if ( file_exists( __DIR__ . '/inc/rest-api/sms/sms-verify.php' ) ) {
	require_once __DIR__ . '/inc/rest-api/sms/sms-verify.php';
}

$basic   = new Nexmo\Client\Credentials\Basic( '9be48f1a', 'R5Jj2YEmCJOvxwEs' );
$client  = new Nexmo\Client( $basic );
$message = $client->message()->send(
	[
		'to'   => '919618583087',
		'from' => 'Nexmo',
		'text' => 'Hello from Nexmo',
	]
);