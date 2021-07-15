<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStagecompletionamountTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stagecompletionamount', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('stage');
			$table->decimal('amount', 18);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stagecompletionamount');
	}

}
