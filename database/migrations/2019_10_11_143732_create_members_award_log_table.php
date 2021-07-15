<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembersAwardLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members_award_log', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('member_id');
			$table->integer('frequency');
			$table->string('stage');
			$table->boolean('completed')->default(0);
			$table->integer('award_category_id');
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
		Schema::drop('members_award_log');
	}

}
