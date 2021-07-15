<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatrixTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matrix_type', function(Blueprint $table)
		{
			$table->increments('type_id');
			$table->string('name');
			$table->string('completion_bonus');
			$table->string('price_to_enter');
			$table->string('levels');
			$table->string('views');
			$table->string('expected_downlines', 250);
			$table->string('stage', 250);
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
		Schema::drop('matrix_type');
	}

}
