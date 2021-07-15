<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLevelBonusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('level_bonus', function(Blueprint $table)
		{
			$table->integer('id');
			$table->string('username', 250);
			$table->string('membershipid', 250);
			$table->string('stage', 250);
			$table->string('level', 250);
			$table->string('paid', 250);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('level_bonus');
	}

}
