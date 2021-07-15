<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatrixUsersBkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matrix_users_bk', function(Blueprint $table)
		{
			$table->increments('matrix_users_id');
			$table->integer('matrix_id');
			$table->string('user_id');
			$table->string('parentid');
			$table->string('position', 250);
			$table->string('place', 250);
			$table->string('trpos', 200)->index('dtree_idx2');
			$table->string('trchildrenp', 250);
			$table->string('tparent', 200);
			$table->string('children', 200);
			$table->string('stage');
			$table->string('level');
			$table->string('matrix_number');
			$table->timestamps();
			$table->index(['matrix_id','tparent'], 'dtree_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matrix_users_bk');
	}

}
