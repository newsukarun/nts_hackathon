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

	private $api_endpoint = 'http://api.msg91.com/api/sendhttp.php';

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
		if ( ! property_exists( $this, 'employee' ) ) {
			return new \WP_Error( 'sms_failed', __( 'Cannot send SMS. Employee not found.' ) );
		}
	}
}