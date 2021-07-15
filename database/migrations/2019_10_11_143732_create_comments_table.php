<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ticket_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->text('comment', 65535);
			$table->integer('viewed_by_owner')->nullable()->default(0);
			$table->timestamps();
			$table->index(['ticket_id','user_id'], 'idx_comments1');
			$table->index(['ticket_id','viewed_by_owner'], 'ticket_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
