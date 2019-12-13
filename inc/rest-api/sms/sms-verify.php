<?php

class Nts_Sms_Verify{

	public $name_space = 'sms/v1/';
	public $endpoint = 'verify';
	public function __construct() {
		add_action('rest_api_init', [ $this, 'rest_route' ] );
	}

	public function rest_route() {
		register_rest_route(
			$this->name_space,
			$this->endpoint,
			[
				'methods'  => 'GET',
				'callback' => [ $this, 'process_verify' ],
			]
		);
	}

	public function process_verify( WP_REST_Request $request ) {
		print_r( $request );
	}
}

new Nts_Sms_Verify();