<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSubCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sub_categories', function(Blueprint $table)
		{
			$table->foreign('cat_id', 'sub_categories_ibfk_1')->references('id')->on('category')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sub_categories', function(Blueprint $table)
		{
			$table->dropForeign('sub_categories_ibfk_1');
		});
	}

}
