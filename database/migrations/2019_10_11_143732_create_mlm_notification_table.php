<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMlmNotificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mlm_notification', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 250)->unique('title');
			$table->text('content', 65535);
			$table->string('created_by', 50)->nullable();
			$table->string('created_at', 50)->nullable();
			$table->string('updated_at', 50)->nullable();
			$table->string('updated_by', 50)->nullable();
			$table->string('deleted_at', 50)->nullable();
			$table->string('deleted_by', 50)->nullable();
			$table->integer('published')->default(0);
			$table->integer('deleted')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mlm_notification');
	}

}
