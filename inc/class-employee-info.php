<?php
namespace NTSFOOD;

class Employee {

	public $employee_details = [];

	/**
	 * Employee constructor.
	 *
	 * @param $emp_id_email ID or email.
	 */
	function __construct( $emp_id_email ) {
		$user_id = null;

		if ( is_numeric( $emp_id_email ) ) {

			$user_id                = $this->get_employee_by_id( $emp_id_email );
			$this->employee_details = get_user_by( 'ID', $user_id );

		} elseif ( filter_var( $emp_id_email, FILTER_VALIDATE_EMAIL ) ) {

			$this->employee_details = get_user_by( 'ID', $user_id );
		}
	}

	function get_employee_by_id( $id ) {
		$user = get_users(
			[
				'meta_key'   => 'employee_id',
				'meta_value' => $id,
				'number'     => 1,
			]
		);

		return ! empty( $user ) ? $user[0]->ID : null;
	}

	public function get_mobile_number() {

		return get_field( 'phone_number', 'user_'. $this->employee_details->ID );
	}
}