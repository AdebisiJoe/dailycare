<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFundedaccountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fundedaccount', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('customer_id', 250);
			$table->decimal('amount', 10, 0);
			$table->string('date_added', 250);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fundedaccount');
	}

}
