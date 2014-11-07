<?php

class Payroll extends Eloquent {

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	public static $rules = array(
		'employee_id' => 'required',
		'paystart'    => 'required',
		'payend'      => 'required',
		'salaryrate'  => 'required'
	);

	// public function contribution() {
	// 	return $this->has_many( 'Contribution' );
	// }

	// public function cadeduction() {
	// 	return $this->has_many( 'Creditdeduction' );
	// }

	// public function save(array $options = array()) {
	// 	var_dump($options);
	// 	parent::save($options);
	// 	// return Redirect::back()->with(array('message'=>' Payroll successfully.', 'status'=>'success'));
	// }
	//
	public function payrolls()
	{
		return $this->morphMany('CashFlow', 'source');
	}

	public function contributions()
	{
		return $this->hasMany( 'Contribution' );
	}

}
