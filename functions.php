<?php
/**
 * Rest Api End-point.
 */
if ( file_exists( __DIR__ . '/inc/rest-api/sms/sms-verify.php' ) ) {
	require_once __DIR__ . '/inc/rest-api/sms/sms-verify.php';
}

require_once __DIR__ . '/vendor/autoload.php';
$basic  = new \Nexmo\Client\Credentials\Basic('9be48f1a', 'R5Jj2YEmCJOvxwEs');
$client = new \Nexmo\Client($basic);
try {
	$message = $client->message()->send([
		                                    'to' => 9618583087,
		                                    'from' => 'Acme Inc',
		                                    'text' => 'A text message sent using the Nexmo SMS API'
	                                    ]);
	$response = $message->getResponseData();
	if($response['messages'][0]['status'] == 0) {
		echo "The message was sent successfully\n";
	} else {
		echo "The message failed with status: " . $response['messages'][0]['status'] . "\n";
	}
} catch (Exception $e) {
	echo "The message was not sent. Error: " . $e->getMessage() . "\n";
}