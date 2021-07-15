<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeneratepinforstagethreeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('generatepinforstagethree', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('pin', 250);
			$table->string('membershipid', 250)->unique('membershipid');
			$table->date('date_generated');
			$table->string('owner_id', 250);
			$table->integer('batch_id');
			$table->string('printed', 250);
			$table->integer('generated_by')->default(0);
			$table->integer('printed_by')->default(0);
			$table->date('date_printed');
			$table->string('printed_batch', 250);
			$table->integer('used');
			$table->index(['pin','printed','used'], 'idx_pin');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('generatepinforstagethree');
	}

}
