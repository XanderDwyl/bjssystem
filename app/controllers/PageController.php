<?php

class PageController extends BaseController {
	protected $layout = "layouts.main";

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('showDashboard', 'showRegisterForm', 'showEmployeeForm', 'showPayrollForm', 'showCashadvanceForm')));
	}
	public function showIndex() {
		return Redirect::to('login');
	}
	public function showDashboard() {
		$this->layout->content = View::make('pages.dashboard');
	}

	public function showLoginForm()
	{
		if(Auth::check())
			return Redirect::to('dashboard');
		else
			$this->layout->content = View::make('pages.login');
	}

	public function showRegisterForm() {
	    $this->layout->content = View::make('pages.register');
	}

	public function showEmployeeForm() {
    	$this->layout->content = View::make('pages.employee')->with( 'employees', TransactionQuery::getEmployeeCurrentSalary(''));
	}

	public function showSalary() {
    	$this->layout->content = View::make('pages.salary');
	}

	public function showPayrollForm() {
    	$this->layout->content = View::make('pages.payroll')
    							->with( array(
										'employees'        => TransactionQuery::getEmployeeCurrentSalary(''),
										'payrolls'         => TransactionQuery::getCashAdvances()
										)
    								);
    }
    public function showCashadvanceForm() {
    	$this->layout->content = View::make('pages.cashadvance')
    							->with( array(
										'employees'        => TransactionQuery::getEmployeeCurrentSalary(''),
										'cashtransactions' => TransactionQuery::getCashAdvances(),
										'totalCA'          => TransactionQuery::getTotalCashAdvances(),
										'totalCollectable' => TransactionQuery::getTotalCACollectables()
										)
    								);
    }
}
