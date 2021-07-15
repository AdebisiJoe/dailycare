<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMlmUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mlm_users', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('user_id')->comment('foreign key of the users table');
			$table->string('username', 60)->unique('username');
			$table->string('user_key', 15)->index('index_user_key');
			$table->string('parent_key', 15)->index('index_parent_key');
			$table->string('sponsor_key', 15)->index('index_sponsor_key');
			$table->enum('leg', array('1','0'))->comment('1 indicate right leg and 0 indicate left leg');
			$table->enum('payment_status', array('1','0'))->default('0')->comment('1 indicate paid and 0 indicate unpaid');
			$table->enum('banned', array('1','0'))->default('0');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mlm_users');
	}

}
