<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('sku', 250);
			$table->string('item_name', 250);
			$table->string('brand_name', 250);
			$table->string('quantity', 150);
			$table->decimal('price', 20);
			$table->string('country', 50)->default('Nigeria');
			$table->text('weight', 65535);
			$table->text('stock', 65535);
			$table->text('image', 65535);
			$table->text('colour', 65535);
			$table->text('description', 65535);
			$table->integer('categoryid')->index('categoryid');
			$table->integer('subcategoryid')->index('subcategoryid');
			$table->string('dateadded', 250);
			$table->index(['price','item_name'], 'prod_first');
			$table->index(['item_name','price'], 'prod_sec');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product');
	}

}
