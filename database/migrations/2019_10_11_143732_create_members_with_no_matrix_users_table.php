<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembersWithNoMatrixUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members_with_no_matrix_users', function(Blueprint $table)
		{
			$table->increments('matrix_id');
			$table->bigInteger('type_id');
			$table->string('ownerid', 250);
			$table->string('count_users');
			$table->string('users_list');
			$table->string('filled');
			$table->string('alias_id');
			$table->string('created_at', 225)->nullable();
			$table->string('updated', 200)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('members_with_no_matrix_users');
	}

}
