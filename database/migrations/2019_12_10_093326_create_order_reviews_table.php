<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_reviews', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('user_id')->index('order_reviews_user_id_foreign');
			$table->bigInteger('vendor_id')->unsigned()->index('order_reviews_vendor_id_foreign');
			$table->bigInteger('order_id')->unsigned()->index('order_reviews_order_id_foreign');
			$table->string('comment');
			$table->boolean('should_display')->default(1)->comment('0 => false, 1 => true');
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
		Schema::drop('order_reviews');
	}

}
