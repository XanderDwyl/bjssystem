<?php

class SalaryRate extends Eloquent {

	public static $rules = array(
		'emp_id'    => 'required',
		'amount'    => 'required',
		'status'    => 'required'
	);

	public function updateSalaryRate( $id ) {
		// set status = 0 for current salary rates
		DB::table('salary_rates')->where( 'emp_id', '=', $id )->update(array('status' => 0));
	}

	public function employees( ) {
		return $this->belongsTo('employee', 'emp_id');
	}

	public function getEmployeeInfo( ) {
		return $this->employees->firstname . ' ' . $this->employees->lastname;
	}

}
