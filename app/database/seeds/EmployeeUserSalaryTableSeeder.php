<?php

class EmployeeUserSalaryTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('employees')->delete();
		$employee               = new Employee;
		$employee->firstname    = 'Alexjander';
		$employee->lastname     = 'Bacalso';
		$employee->birth_date   = date("Y-m-d", strtotime('07/12/1985'));
		$employee->gender       = 'M';
		$employee->home_address = 'Tungkop South Minglanilla, Cebu';
		$employee->hired_date   = date("Y-m-d H:i:s", strtotime('11/08/2013'));
		$employee->save();

		DB::table('users')->delete();
		$user                = new User;
		$user->email_address = 'janderbacalso@gmail.com';
		$user->password      = Hash::make('test');
		$user->status        = 1;
		$user->employees()->associate($employee)->save();

		DB::table('salary_rates')->delete();
		$salaryrate             = new SalaryRate;
		$salaryrate->amount     = 342.23;
		$salaryrate->status     = 1;
		$salaryrate->employees( $employee->id )->associate($employee);				// update status of the current salary rate
		$salaryrate->save();

		$salaryrate             = new SalaryRate;
		$salaryrate->amount     = 150;
		$salaryrate->status     = 1;
		$salaryrate->employees( $employee->id )->associate($employee);				// update status of the current salary rate
		$salaryrate->save();

	}

}
