<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContributionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contributions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('payroll_id')->unsigned();
			$table->decimal('amount', 10, 2);
			$table->string('agency', 20);
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
		Schema::drop('contributions');
	}

}
