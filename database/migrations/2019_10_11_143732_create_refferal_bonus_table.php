<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRefferalBonusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('refferal_bonus', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('username', 250);
			$table->string('membershipid', 250);
			$table->decimal('bonus', 18);
			$table->string('noofreffered', 250);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('refferal_bonus');
	}

}
