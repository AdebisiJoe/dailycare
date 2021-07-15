<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrentAmountInAccountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('current_amount_in_account', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('userid', 250);
			$table->decimal('amount', 18);
			$table->decimal('foodcash', 18);
			$table->decimal('payout', 18);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('current_amount_in_account');
	}

}
