<?php

class Employee extends Eloquent {

	public $timestamps = true;

	public static $rules = array(
		'firstName'   => 'required|alpha_spaces|min:2',
		'lastName'    => 'required|alpha_spaces|min:2',
		'homeAddress' => 'required',
		'birthDate'   => 'required',
		'hiredDate'   => 'required',
		'gender'      => 'required|alpha|min:4',
		'salary'      => 'required'
	);

	public function salary_rates() {
		return $this->hasMany('salaryrate','emp_id')->where( 'status', '=', 1);
	}

	public function rates() {
		return $this->belongsToMany('salaryrate');
	}

	public function users() {
		return $this->hasMany('user');
	}

}
