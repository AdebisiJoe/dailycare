<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStageBonusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stage_bonus', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('level_number', 250);
			$table->string('stage_number', 250);
			$table->string('bonus', 250);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stage_bonus');
	}

}
