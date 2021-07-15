<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAwardCategoryContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('award_category_contents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('product_id');
			$table->integer('quantity');
			$table->string('good_type');
			$table->string('award_category_id');
			$table->boolean('visible')->default(0);
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
		Schema::drop('award_category_contents');
	}

}
