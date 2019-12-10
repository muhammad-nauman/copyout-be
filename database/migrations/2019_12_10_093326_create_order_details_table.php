<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('order_id')->unsigned()->index('order_details_order_id_foreign');
			$table->string('file_name');
			$table->string('file_type');
			$table->integer('no_of_sets')->unsigned()->default(1);
			$table->integer('no_of_pages')->unsigned()->default(1);
			$table->integer('amount');
			$table->integer('amount_decimal')->default(0);
			$table->boolean('status')->default(0)->comment('0 => confirmed, 1 => canceled ');
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
		Schema::drop('order_details');
	}

}
