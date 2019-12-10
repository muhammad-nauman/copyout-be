<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRiderRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('rider_ratings', function(Blueprint $table)
		{
			$table->foreign('rider_id')->references('id')->on('riders')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('rider_ratings', function(Blueprint $table)
		{
			$table->dropForeign('rider_ratings_rider_id_foreign');
			$table->dropForeign('rider_ratings_user_id_foreign');
		});
	}

}
