<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberTableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('member_table', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('membershipid', 200)->unique('membershipid');
			$table->string('username', 200)->index('username');
			$table->string('parentid', 200)->index('parentid_idx');
			$table->string('sponsorid', 200)->index('sponsorid_idx');
			$table->string('position', 200);
			$table->string('registrationpin', 200);
			$table->string('stage', 200)->index('stage');
			$table->string('children', 250);
			$table->bigInteger('downlines');
			$table->string('firstname', 250);
			$table->string('middlename', 250);
			$table->string('lastname', 250);
			$table->string('phonenumber', 250);
			$table->string('sex', 250);
			$table->string('dob', 250);
			$table->string('country', 200);
			$table->string('state', 200);
			$table->string('city', 200);
			$table->string('address', 250);
			$table->string('accountname', 250);
			$table->string('accountnumber', 250);
			$table->string('bankname', 250);
			$table->string('bankbranch', 250);
			$table->integer('numberofsubaccounts');
			$table->string('type', 250);
			$table->string('isownedby', 250);
			$table->date('joindate');
			$table->timestamps();
			$table->string('email');
			$table->string('password', 60);
			$table->string('role', 50);
			$table->string('profileimage', 250);
			$table->string('transactionpass', 250);
			$table->boolean('banned');
			$table->date('banned_date');
			$table->boolean('accepttermstatus')->default(0);
			$table->string('remember_token', 100);
			$table->index(['isownedby','type'], 'mem_ind01');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('member_table');
	}

}
