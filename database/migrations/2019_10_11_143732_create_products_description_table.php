<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsDescriptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products_description', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('productid');
			$table->decimal('price', 10, 0);
			$table->string('weight', 250);
			$table->integer('stock');
			$table->string('image', 250);
			$table->string('colour', 250);
			$table->text('description', 65535);
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
		Schema::drop('products_description');
	}

}
