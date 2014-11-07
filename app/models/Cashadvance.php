<?php

class CashAdvance extends Eloquent {

	public static $rules = array(
		'employee_id'  => 'required|numeric|not_in:0',
		'amount'       => 'required|numeric',
		'releasedDate' => 'required'
	);

}
