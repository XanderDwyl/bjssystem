<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryratesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('salary_rates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('emp_id')->unsigned();
			$table->decimal('amount', 10, 2);
			$table->tinyInteger('status');
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
		Schema::drop('salary_rates');
	}

}
