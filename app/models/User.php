<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	// protected $table = 'bjs_users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden  = array('password', 'remember_token');

	public static $rules = array(
		'emp_id'                => 'required|alpha_num|min:2',
		'email'                 => 'required|email|unique:users',
		'password'              => 'required|alpha_num|between:6,12|confirmed',
		'password_confirmation' => 'required|alpha_num|between:6,12'
	);

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	public function getAuthUserName() {
		return $this->employees->firstname . ' ' . $this->employees->lastname;
	}

	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getReminderEmail()
	{
		return $this->email;
	}

	public function employees() {
		return $this->belongsTo('employee', 'emp_id');
	}

}
