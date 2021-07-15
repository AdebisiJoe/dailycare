<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePortalManagementLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('portal-management-log', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('country_id');
			$table->dateTime('date_opened')->nullable();
			$table->dateTime('date_closed')->nullable();
			$table->integer('opened_by')->nullable();
			$table->integer('closed_by')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('portal-management-log');
	}

}
