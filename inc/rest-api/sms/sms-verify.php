<?php

class NTS_FOOD_Coupon extends WP_REST_Controller {

	//The namespace and version for the REST SERVER
	var $ntsfood_namespacce = 'sms/v';
	var $ntsfood_version = '1';

	public function register_routes() {
		$namespace = $this->ntsfood_namespacce . $this->ntsfood_version;
		$base      = 'verify';
		register_rest_route(
			$namespace,
			'/' . $base,
			array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_latest_post' ),
					'permission_callback' => array( $this, 'get_latest_post_permission' ),
				),
				array(
					'methods'  => WP_REST_Server::CREATABLE,
					'callback' => array( $this, 'foodcoupon_sms' ),
				),
			)
		);
	}

	// Register our REST Server
	public function hook_rest_server() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	public function get_latest_post( WP_REST_Request $request ) {
		return new WP_REST_Response( get_option( 'sms_v1_verify' ), 200 );
	}

	public function foodcoupon_sms( WP_REST_Request $request ) {
		$keyword = filter_input( INPUT_POST, 'keyword', FILTER_SANITIZE_STRING );
		$message = filter_input( INPUT_POST, 'message', FILTER_SANITIZE_STRING );

		$sms_handler = new NTSFOOD\SMS_Sender( [ 'employee' => (int) $message ] );
		$send_sms = $sms_handler->send_sms();

		update_option( 'sms_v1_verify', [ $send_sms, $sms_handler, $keyword, $message ] );

		if( is_wp_error( $send_sms ) ) {

			return new WP_REST_Response( [ 'message' => $send_sms->get_error_message() ], 403 );
		}

		return new WP_REST_Response( [ 'message' => __( 'Coupon sent successfully' ) ], 200 );
	}
}

$my_rest_server = new NTS_FOOD_Coupon();
$my_rest_server->hook_rest_server();