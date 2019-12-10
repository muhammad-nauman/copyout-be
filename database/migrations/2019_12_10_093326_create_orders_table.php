<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->index('orders_user_id_foreign');
			$table->bigInteger('vendor_id')->unsigned()->index('orders_vendor_id_foreign');
			$table->bigInteger('rider_id')->unsigned()->nullable()->index('orders_rider_id_foreign');
			$table->integer('total_amount');
			$table->integer('amount_decimal')->default(0);
			$table->boolean('payment_type')->default(0)->comment('0 => cash on delivery, 1 => online');
			$table->boolean('status')->default(0)->comment('0 => pending, 1 => in-process, 2 => shipped, 3 => delivered, 4 => on-hold, 5 => payment due');
			$table->dateTime('due_at');
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
		Schema::drop('orders');
	}

}
