<?php

use NTSFOOD\SMS_Sender;

class NTS_FOOD_Coupon extends WP_REST_Controller {

	//The namespace and version for the REST SERVER
	var $ntsfood_namespacce = 'sms/v';
	var $ntsfood_version = '1';

	public function register_routes() {
		$namespace = $this->ntsfood_namespacce . $this->ntsfood_version;
		$base      = 'nofood';
		register_rest_route(
			$namespace,
			'/' . $base,
			array(
				array(
					'methods'  => WP_REST_Server::CREATABLE,
					'callback' => array( $this, 'food_opt_out' ),
				),
			)
		);
	}

	// Register our REST Server
	public function hook_rest_server() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	public function food_opt_out( WP_REST_Request $request ) {
		$keyword       = filter_input( INPUT_POST, 'keyword', FILTER_SANITIZE_STRING );
		$message       = filter_input( INPUT_POST, 'message', FILTER_SANITIZE_STRING );
		$msg_fragments = explode( ' ', $message );
		$msg_fragments = array_map( 'trim', $msg_fragments );

		if( 2 < count( $msg_fragments ) ) {
			return new WP_REST_Response( [ 'message' => __( 'Invalid SMS!' ) ], 403 );
		}

		$sms_handler = new NTSFOOD\SMS_Sender( [ 'employee' => $message ] );
		$send_sms = $sms_handler->send_sms();

		if( is_wp_error( $send_sms ) ) {

			return new WP_REST_Response( [ 'message' => $send_sms->get_error_message() ], 403 );
		}

		return new WP_REST_Response( [ 'message' => __( 'Coupon sent successfully' ) ], 200 );
	}
}

$my_rest_server = new NTS_FOOD_Coupon();
$my_rest_server->hook_rest_server();
