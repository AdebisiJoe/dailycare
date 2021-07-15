<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMlmOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mlm_orders', function(Blueprint $table)
		{
			$table->integer('ID', true);
			$table->string('ProductID', 64)->nullable()->index('ProductID');
			$table->string('CustomerID', 64)->nullable()->index('CustomerID');
			$table->string('ProductQty', 500)->nullable();
			$table->string('ProductAmt', 300);
			$table->string('OrderAmount', 64)->nullable();
			$table->text('shippingAdd', 65535);
			$table->text('CreatedAt', 65535)->nullable();
			$table->string('CreatedBy', 64)->nullable()->index('CreatedBy');
			$table->text('UpdatedAt', 65535)->nullable();
			$table->string('UpdatedBy', 64)->nullable()->index('UpdatedBy');
			$table->integer('status')->default(0);
			$table->integer('deleted')->default(0);
			$table->integer('transfered')->nullable()->default(2);
			$table->string('transfered_by', 50)->nullable();
			$table->text('transfered_at', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mlm_orders');
	}

}
