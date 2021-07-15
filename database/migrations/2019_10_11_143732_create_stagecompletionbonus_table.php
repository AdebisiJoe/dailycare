<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStagecompletionbonusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stagecompletionbonus', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('userid', 250);
			$table->string('matrixid', 225);
			$table->string('stage', 100);
			$table->decimal('amount', 18);
			$table->decimal('paid', 18);
			$table->integer('sum');
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
		Schema::drop('stagecompletionbonus');
	}

}
