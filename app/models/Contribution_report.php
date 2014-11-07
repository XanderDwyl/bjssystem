<?php

class Contribution_report extends Eloquent {

	public function contributions() {
		return $this->has_many( 'Creditdeduction' );
	}
}
