<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayoutcashTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payoutcash', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('userid', 250);
			$table->string('status', 250);
			$table->decimal('amount', 10, 0);
			$table->date('created');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payoutcash');
	}

}
