<?php
class TransactionQuery {

	public static function addEmployee() {
		$validator = Validator::make(Input::all(), Employee::$rules);

		$flashMessage = array(
			'type'    => 'error',
			'message' => 'Invalid input!',
			'errors'  => $validator->errors()
		);

		if ( !$validator->passes() ) {
			return $flashMessage;
		}

		$employee               = new Employee;
		$employee->firstname    = Input::get('firstName');
		$employee->lastname     = Input::get('lastName');
		$employee->birth_date   = date("Y-m-d", strtotime(Input::get('birthDate')));
		$employee->gender       = Input::get('gender');
		$employee->home_address = Input::get('homeAddress');
		$employee->hired_date   = date("Y-m-d", strtotime(Input::get('hiredDate')));
		$employee->updated_at   = date("Y-m-d");
		$employee->created_at   = date("Y-m-d");
		$employee->save();

		self::addSalary( $employee->id );

		$flashMessage = array(
			'type'    => 'success',
			'message' => 'Employee is successfully added.'
		);

		return $flashMessage;
	}

	public static function addSalary( $id ) {
		$salaryrate = new SalaryRate;
		$salaryrate->updateSalaryRate( $id );				// update status of the current salary rate

		$salaryrate->amount     = Input::get('salary');
		$salaryrate->status     = 1;
		$salaryrate->updated_at = date("Y-m-d");
		$salaryrate->created_at = date("Y-m-d");
		$salaryrate->emp_id     = $id;
		$salaryrate->save();
	}

	public static function getEmployeeCurrentSalary( $emp_id ) {

		if ( isset($emp_id ) && $emp_id > 0 ) {
			$salaryQuery = Employee::with('salary_rates')->where('id', '=', $emp_id)->first();
		} else {
			$salaryQuery = Employee::with('salary_rates')->get();
		}
		return $salaryQuery;
	}

	public static function getCashAdvances() {
		return CashAdvance::leftJoin('employees', 'cash_advances.emp_id', '=', 'employees.id')
							->select('cash_advances.emp_id', 'employees.firstname', 'employees.lastname', 'cash_advances.amount', 'cash_advances.created_at')
							->orderBy( 'cash_advances.created_at', 'asc' )
							->get();
	}

	public static function getTotalCashAdvances() {
		return self::getCashAdvances()->sum('amount');
	}

	public static function getTotalCAPayments() {
		$queryAllCAPayment  = CashAdvance::leftJoin('employees', 'cash_advances.emp_id', '=', 'employees.id')
											->leftJoin('creditdeductions', 'cash_advances.emp_id', '=', 'creditdeductions.emp_id')
											->select('cash_advances.emp_id', 'employees.firstname', 'employees.lastname', 'cash_advances.amount')
											->get();

		$totalAllCAPayment = $queryAllCAPayment->sum('amount');

		return $totalAllCAPayment;
	}

	public static function getTotalCACollectables() {
		return self::getTotalCashAdvances();
	}
}
