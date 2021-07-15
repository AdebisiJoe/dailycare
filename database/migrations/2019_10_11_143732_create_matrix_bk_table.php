<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatrixBkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matrix_bk', function(Blueprint $table)
		{
			$table->integer('matrix_id')->unsigned();
			$table->bigInteger('type_id');
			$table->string('ownerid', 250);
			$table->string('count_users');
			$table->string('users_list');
			$table->string('filled');
			$table->string('alias_id');
			$table->string('created_at', 225)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matrix_bk');
	}

}
