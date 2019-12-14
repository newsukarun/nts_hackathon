<?php
/**
 * Handles sending SMS'
 */

namespace NTSFOOD;

class SMS_Sender {
	/**
	 * Auth token for MSG91 service.
	 *
	 * @var string
	 */
	private $auth_token = '308248AUkV8yIaQ0E5df37e92';

	//private $api_endpoint = 'http://api.msg91.com/api/sendhttp.php';
	private $api_endpoint = 'https://api.msg91.com/api/v2/sendsms?country=91';

	/**
	 * SMS_Sender constructor.
	 *
	 * @param array $args
	 */
	function __construct( $args = [] ) {

		if( ! empty( $args['employee'] ) ) {
			$this->employee = new \NTSFOOD\Employee( $args['employee'] );
		}
	}

	function send_sms() {

		if ( ! property_exists( $this, 'employee' ) || empty( $this->employee ) ) {
			return new \WP_Error( 'sms_failed', __( 'Cannot send SMS. Employee details not found.' ) );
		}

		$sms_object = [
			'message' => ntsfood_get_coupon_msg( $this->employee ),
			'to' => [
				$this->employee->get_mobile_number(),
			]
		];

		$data = [
			'country' => 91,
			'sender'  => 'NTSFDC',
			'route'   => 4,
			'sms'     => [ (object) $sms_object ],
		];

		$response = wp_remote_post(
			$this->api_endpoint,
			[
				'headers' => [
					'authkey'      => $this->auth_token,
					'Content-Type' => 'application/json'
				],

				'body' => wp_json_encode( $data ),
			]
		);

		if( 200 !== wp_remote_retrieve_response_code( $response ) ) {

			return new \WP_Error( sprintf( 'Error code %d : Could not send the coupon code.', wp_remote_retrieve_response_code( $response ) ) );
		}
	}
}