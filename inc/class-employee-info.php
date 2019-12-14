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

			$user_id = $this->get_employee_by_id( $emp_id_email );

		} elseif ( filter_var( $emp_id_email, FILTER_VALIDATE_EMAIL ) ) {

			$user_id = $this->get_employee_by_email( $emp_id_email );
		}

		if( $user_id ) {
			$this->employee_details = get_user_by( 'ID', $user_id );
		}
	}

	function get_employee_by_id() {


	}

	function get_employee_by_email() {

	}


}