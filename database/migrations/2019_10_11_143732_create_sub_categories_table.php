<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_categories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cat_id')->index('cat_id');
			$table->string('sub_catname', 250);
			$table->string('description', 250);
			$table->string('meta_tag_title', 250);
			$table->string('meta_tag_description', 250);
			$table->string('meta_tag_keywords', 250);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sub_categories');
	}

}
