<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatrixbonuspaidTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matrixbonuspaid', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('userid', 250);
			$table->string('matrixid', 200);
			$table->decimal('amount', 10, 0);
			$table->date('datepaid');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matrixbonuspaid');
	}

}
