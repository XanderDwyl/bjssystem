<?php

class PayrollTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('payrolls')->delete();

		$payroll                   = new Payroll;
		$payroll->emp_id           = 1;
		$payroll->pperiod_start    = date("Y-m-d H:i:s", strtotime('11/06/2013'));
		$payroll->pperiod_end      = date("Y-m-d H:i:s", strtotime('11/08/2013'));
		$payroll->no_hours_worked  = 16;
		$payroll->no_hours_leaved  = 8;
		$payroll->salary_rate      = 342.23;
		$payroll->total_deductions = 342.23;
		$payroll->save();

		$contribution         = new Contribution;
		$contribution->amount = 82.50;
		$contribution->agency = 'SSS';
		$contribution->payrolls()->associate($payroll)->save();

		$cashflow              = new CashFlow;
		$cashflow->user_id     = 1;
		$cashflow->amount      = 342.23;
		$cashflow->description = 'This is a test for polymorphic relationship.';
		$cashflow->source()->associate($payroll)->save();

	}

}
