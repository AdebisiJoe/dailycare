<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMlmGoodscollectionlogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mlm_goodscollectionlog', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('user_id', 50)->index('user_id');
			$table->decimal('prev_amount', 18);
			$table->decimal('amount_deducted', 18);
			$table->string('trans_date', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mlm_goodscollectionlog');
	}

}
