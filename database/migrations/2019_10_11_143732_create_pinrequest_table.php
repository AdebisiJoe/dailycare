<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePinrequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pinrequest', function(Blueprint $table)
		{
			$table->increments('batch_id');
			$table->integer('user_id');
			$table->integer('no_of_pins');
			$table->integer('sent')->default(0);
			$table->integer('viewed_by_admin')->default(0);
			$table->integer('viewed_by_sub_admin')->default(0);
			$table->integer('no_remaining_for_batch')->default(0);
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
		Schema::drop('pinrequest');
	}

}
