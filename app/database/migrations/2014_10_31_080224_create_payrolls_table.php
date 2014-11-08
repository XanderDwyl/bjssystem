<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payrolls', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('emp_id')->unsigned();
            $table->timestamp('pperiod_start');
            $table->timestamp('pperiod_end');
			$table->float('no_hours_worked');
			$table->float('no_hours_leaved');
			$table->float('salary_rate');
			$table->float('total_deductions');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payrolls');
	}

}
