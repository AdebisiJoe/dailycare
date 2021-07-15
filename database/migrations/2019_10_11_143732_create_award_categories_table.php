<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAwardCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('award_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('award_type_id');
			$table->string('name');
			$table->string('description');
			$table->integer('month_duration');
			$table->string('stage');
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
		Schema::drop('award_categories');
	}

}
