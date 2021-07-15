<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTempcurrentamountOdTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tempcurrentamount_od', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('userid', 250)->index('userid');
			$table->decimal('amount', 18);
			$table->decimal('paid', 18)->default(0.00);
			$table->integer('regpack')->default(0);
			$table->decimal('foodcash', 18);
			$table->decimal('payoutcash', 18);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tempcurrentamount_od');
	}

}
