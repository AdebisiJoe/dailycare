<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMlmFoodcollectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mlm_foodcollection', function(Blueprint $table)
		{
			$table->integer('ID', true);
			$table->string('user_id', 150)->index('food_sec');
			$table->integer('group_leader_id')->nullable()->index('food_egt');
			$table->integer('product_id')->index('product_id');
			$table->integer('quantity');
			$table->decimal('amount', 18);
			$table->date('date_created')->index('food_first');
			$table->index(['ID','user_id'], 'food_third');
			$table->index(['ID','user_id','group_leader_id'], 'food_fth');
			$table->index(['user_id','group_leader_id'], 'food_sth');
			$table->index(['group_leader_id','user_id'], 'food_sev');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mlm_foodcollection');
	}

}
