<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSliderImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('slider_images', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('file_name', 200);
			$table->string('file_size', 200);
			$table->string('file_mime', 200);
			$table->string('file_path', 200);
			$table->text('caption', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('slider_images');
	}

}
