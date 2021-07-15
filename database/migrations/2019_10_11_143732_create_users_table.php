<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('password', 60);
			$table->string('role', 50);
			$table->string('username', 200)->unique('username');
			$table->string('profileimage', 250);
			$table->string('transactionpass', 250);
			$table->boolean('banned');
			$table->date('banned_date');
			$table->integer('fraud_banned');
			$table->date('fraud_banned_date');
			$table->integer('food_banned')->nullable();
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}
