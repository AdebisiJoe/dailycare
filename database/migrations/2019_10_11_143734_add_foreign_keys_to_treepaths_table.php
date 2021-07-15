<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTreepathsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('treepaths', function(Blueprint $table)
		{
			$table->foreign('ancestor', 'tree_ibfk_1')->references('membershipid')->on('member_table')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('descendant', 'tree_ibfk_2')->references('membershipid')->on('member_table')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('treepaths', function(Blueprint $table)
		{
			$table->dropForeign('tree_ibfk_1');
			$table->dropForeign('tree_ibfk_2');
		});
	}

}
