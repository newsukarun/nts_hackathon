<?php

class Nts_Sms_Verify extends WP_REST_Controller {

	//The namespace and version for the REST SERVER
	var $my_namespace = 'sms/v';
	var $my_version = '1';

	public function register_routes() {
		$namespace = $this->my_namespace . $this->my_version;
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
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'add_post_to_category' ),
					'permission_callback' => array( $this, 'add_post_to_category_permission' ),
				),
			)
		);
	}

	// Register our REST Server
	public function hook_rest_server() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	public function get_latest_post_permission() {
		return true;
	}

	public function get_latest_post( WP_REST_Request $request ) {
		return new WP_REST_Response( get_option( 'sms_v1_verify' ), 200 );
	}

	public function add_post_to_category_permission() {
		return $this->get_latest_post_permission();
	}

	public function add_post_to_category( WP_REST_Request $request ) {
		update_option( 'sms_v1_verify', $request );

		return new WP_REST_Response( [ 'message' => 'Created' ], 200 );
	}
}

$my_rest_server = new Nts_Sms_Verify();
$my_rest_server->hook_rest_server();