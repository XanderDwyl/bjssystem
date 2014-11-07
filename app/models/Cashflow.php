<?php

class CashFlow extends Eloquent {

	public function source()
	{
		return $this->morphTo();
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

}
