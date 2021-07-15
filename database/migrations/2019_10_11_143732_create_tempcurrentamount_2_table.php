<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTempcurrentamount2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tempcurrentamount_2', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->string('userid', 250)->index('userid');
			$table->decimal('amount', 18);
			$table->decimal('paid', 18)->default(0.00);
			$table->integer('regpack')->default(0);
			$table->decimal('foodcash', 18);
			$table->decimal('payoutcash', 18);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tempcurrentamount_2');
	}

}
