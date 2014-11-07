<?php

class AuthController extends Controller {

	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getDashboard', 'getEmployee', 'getCashadvance', 'getPayroll')));
	}

	public function postEmployee() {
		$validator = Validator::make(Input::all(), Employee::$rules);

		if ( !$validator->passes() ) {
			return Redirect::back()->withInput()->withErrors($validator);
		}

		$addEmployee = TransactionQuery::addEmployeeSalary( );

		return Redirect::back()->with(array('message'=>$addEmployee['message'], 'status'=>$addEmployee['type']));
	}

	public function postCashadvance() {
		$validator = Validator::make(Input::all(), Cashadvance::$rules);

		if (!$validator->passes()) {
			return Redirect::to('cashadvance')->withInput()->withErrors($validator);
		}

		$cash             = new Cashadvance;
		$cash->emp_id     = Input::get('employee_id');
		$cash->amount     = Input::get('amount');
		$cash->created_at = date("Y-m-d", strtotime(Input::get('releasedDate')));
		$cash->save();

		return Redirect::back()->with(array('message'=>'Cash Advance transaction is successfully save.', 'status'=>'success'));
	}

	public function postPayroll() {
		$validator = Validator::make(Input::all(), Payroll::$rules);

		if ( !$validator->passes() ) {
			return Redirect::to('payroll')->withInput()->withErrors($validator);
		}

		$rate = Input::has('salary_rate') ? Input::get('salary_rate') : '0';

		$payroll                   = new Payroll;
		$payroll->emp_id           = Input::get('employee_id');
		$payroll->pperiod_start    = date('Y-m-d', strtotime(Input::get('paystart')));
		$payroll->pperiod_end      = date('Y-m-d', strtotime(Input::get('payend')));
		$payroll->no_hours_worked  = Input::get('daysofwork') * 8;
		$payroll->no_hours_leaved  = Input::has('leavedhours') ? Input::get('leavedhours') : '0';
		$payroll->total_deductions = Input::get('totaldeductions');
		$payroll->salary_rate      = $rate;
		$payroll->created_at       = date('Y-m-d' );
		$payroll->updated_at       = date('Y-m-d' );
		$payroll->save();

		// update contributions
		$contributions = Input::get('contribution');
		foreach ( $contributions as $key => $amount ) {
			if ( $amount ) {
				$contribution         = new Contribution;
				$contribution->amount = $amount;
				$contribution->agency = $key;
				$contribution->payrolls()->associate($payroll)->save();
			}
		}

		// udpate cashflows
		$cashflow              = new CashFlow;
		$cashflow->user_id     = Auth::user()->getAuthIdentifier();
		$cashflow->amount      = (Input::get('daysofwork') * $rate) - Input::get('totaldeductions');
		$cashflow->description = '';
		$cashflow->source()->associate($payroll)->save();

		return Redirect::back()->with(array('message'=>'Payroll successfully.', 'status'=>'success'));
	}

	public function postRegister() {
		return 'alex';
	}

	public function postLogin()
	{
		if ( !Auth::attempt(array('email_address'=>Input::get('email'), 'password'=>Input::get('password')))) {
			return Redirect::back()
				->with(array('message'=>'Your username/password combination was incorrect!','status'=>'warning'))
				->withInput();
		}
		return Redirect::to('dashboard')->with(array('message'=>'You are now logged in!', 'status'=>'success'));
	}

	public function getLogout() {
		Auth::logout();
		return Redirect::to('login')->with(array('message'=>'You are now logged Out!', 'status'=>'warning'));
	}

}
