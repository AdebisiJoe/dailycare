<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatrixOldBkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matrix_old_bk', function(Blueprint $table)
		{
			$table->increments('matrix_id');
			$table->bigInteger('type_id')->index('type_id');
			$table->string('ownerid', 250);
			$table->string('count_users');
			$table->string('users_list');
			$table->string('filled');
			$table->string('alias_id');
			$table->string('created_at', 225)->nullable();
			$table->index(['type_id','ownerid'], 'type_id_2');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('matrix_old_bk');
	}

}
