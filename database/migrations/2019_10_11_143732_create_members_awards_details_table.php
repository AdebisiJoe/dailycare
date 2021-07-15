<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembersAwardsDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members_awards_details', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->string('membership_id');
			$table->integer('award_category_id');
			$table->text('order_details', 65535);
			$table->smallInteger('collected')->unsigned()->default(0);
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
		Schema::drop('members_awards_details');
	}

}
