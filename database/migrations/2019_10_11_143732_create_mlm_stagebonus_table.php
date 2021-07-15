<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMlmStagebonusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mlm_stagebonus', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('bonus', 200);
			$table->string('stage_number', 200);
			$table->string('name', 200);
			$table->string('noofdownlines', 200);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mlm_stagebonus');
	}

}
