<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMlmAccountdeductionLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mlm_accountdeduction_log', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('membershipid', 100);
			$table->decimal('amount', 18);
			$table->string('adminid', 100);
			$table->string('action', 50);
			$table->timestamp('date_deducted')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mlm_accountdeduction_log');
	}

}
