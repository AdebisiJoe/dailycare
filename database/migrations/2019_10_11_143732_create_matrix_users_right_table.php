<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatrixUsersRightTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matrix_users_right', function(Blueprint $table)
		{
			$table->increments('matrix_users_id');
			$table->string('matrix_id');
			$table->string('user_id');
			$table->string('parentid');
			$table->string('position', 250);
			$table->string('children', 200);
			$table->string('stage');
			$table->string('level');
			$table->string('matrix_number');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matrix_users_right');
	}

}
