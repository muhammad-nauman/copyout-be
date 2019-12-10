<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('first_name');
			$table->string('last_name')->nullable();
			$table->string('username')->nullable();
			$table->string('email')->unique('email');
			$table->string('password');
			$table->string('phone_number');
			$table->string('city')->nullable();
			$table->string('address')->nullable();
			$table->boolean('status')->nullable();
			$table->boolean('user_role')->default(0)->comment('0 => admin, 1 => vendor, 2 => rider, 3 => customer');
			$table->string('remember_token')->nullable();
			$table->dateTime('email_verified_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
