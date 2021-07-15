<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTreepathsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('treepaths', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('ancestor', 250);
			$table->string('descendant', 250)->index('descendant');
			$table->string('depth', 250);
			$table->index(['ancestor','descendant','depth'], 'tree_adl');
			$table->index(['descendant','depth'], 'tree_dl');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('treepaths');
	}

}
