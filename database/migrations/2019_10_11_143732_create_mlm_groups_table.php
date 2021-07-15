<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMlmGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mlm_groups', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('owner_id', 50)->index('grp_fir');
			$table->string('group_name');
			$table->string('country', 200)->default('Nigeria');
			$table->string('state', 200)->default('Lagos');
			$table->softDeletes();
			$table->dateTime('created_at');
			$table->index(['id','owner_id'], 'grrp_sec');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mlm_groups');
	}

}
