<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsrecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactionsrecords', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('userid', 250);
			$table->string('type', 250);
			$table->string('receiverid', 250)->nullable();
			$table->decimal('amount', 18);
			$table->date('created_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transactionsrecords');
	}

}
