<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMlmMembersrecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mlm_membersrecords', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('firstname', 250);
			$table->string('lastname', 250);
			$table->string('phonenumber', 250);
			$table->string('sex', 250);
			$table->string('dob', 250);
			$table->string('country', 200);
			$table->string('state', 200);
			$table->string('city', 200);
			$table->string('address', 250);
			$table->string('nameofkin', 250);
			$table->string('nextofkinaddress', 250);
			$table->string('kinrelationship', 250);
			$table->string('phonenumberofkin', 250);
			$table->string('accountname', 250);
			$table->string('accountnumber', 250);
			$table->string('bankname', 250);
			$table->string('bankbranch', 250);
			$table->string('username', 250);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mlm_membersrecords');
	}

}
