<?php

class Nts_Sms_Verify extends WP_REST_Controller{

	public $name_space = 'sms/v1';
	public $endpoint = '/verify';

	public function register_route() {
		register_rest_route(
			$this->name_space,
			$this->endpoint,
			[
				'methods'             => 'GET',
				'callback'            => [ $this, 'get_items' ],
				'permission_callback' => [ $this, 'get_items_permissions_check' ],
			]
		);
	}

	public function get_items( $request ) {
		return new WP_REST_Response( $request, 200 );
	}

	public function get_items_permissions_check($request) {
		return true;
	}
}


add_action('rest_api_init', [ $this, 'register_route' ] );
add_action( 'rest_api_init',
	function() {
		$latest_posts_controller = new Nts_Sms_Verify();
		$latest_posts_controller->register_routes();
	}
);