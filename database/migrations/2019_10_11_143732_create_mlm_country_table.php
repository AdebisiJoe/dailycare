<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMlmCountryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mlm_country', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->char('iso', 2);
			$table->string('name', 80);
			$table->char('iso3', 3)->nullable();
			$table->string('currencyname', 200);
			$table->decimal('foodequ', 10, 0);
			$table->smallInteger('numcode')->nullable();
			$table->string('htmlcode', 200);
			$table->string('active', 200);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mlm_country');
	}

}
