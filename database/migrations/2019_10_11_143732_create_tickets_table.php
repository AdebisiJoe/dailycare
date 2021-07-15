<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->string('ticket_id', 191)->unique();
			$table->string('title', 191);
			$table->string('priority', 191);
			$table->text('message', 65535);
			$table->string('status', 191);
			$table->timestamps();
			$table->index(['user_id','ticket_id'], 'idx_tickets1');
			$table->index(['user_id','category_id'], 'idx-tickets2');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tickets');
	}

}
